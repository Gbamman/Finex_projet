<?php
function Primo
(
	$capital,
	 $x,
	 $taux_banque,
	 $per,
	 $Duree,   
     $fg,
     $fa,
     $diff,
     $PE
)

{


     $tx_i =0.035;
     $v=1/(1+$tx_i);
     $PA=0;


	  global $db;

	$condition= array();

    $user = $db->select("tablemortalite","lx",$condition);


    $L=array();

// Génération de la ligne des lx
    foreach ($user['data'] as $key => $value) 
    {
    	
    	$L[]=$value['lx'];
    }
    
    // print_r($L[40]);

     $tx_p = pow((1+$taux_banque),(1/$per))-1;

     $Bs = array();

     $Bs[0]=$capital;


     // calcul du solde restant du périodique
          $i=0;
     $j=0;
   

     for ($i=1; $i <=($per*$Duree); $i++) 
     { 
     	# code...
     	if ($i<= $diff) 
     	{
     		$Bs[$i]=$capital;
     	}
     	else
     	{
     		$Bs[$i] =  $Bs[$i-1] - ($capital * $tx_p  / (1 - pow((1 + $tx_p),(-$Duree * $per))) - $tx_p * $Bs[$i-1]);
     	}
     }

  	// calcul du solde restant moyen annuel
     $i=0;
     $j=0;

     $St= array();
     //$St[0]=0;


     for ($i=0; $i <= ($Duree-1); $i++) 
     { 
     	# code...
     	$St[$i]=0;
     	for ($j=($i*$per); $j <= ($per*(1+$i)-1); $j++) 
     	{ 
     		# code...
     		$St[$i]=$St[$i]+$Bs[$j]/$per;
     	}
     }


     $i=0;
     $j=0;
     $PrPE=0;

     // Calcul de la prime annuelle
     for ($i=0; $i <=($Duree-1) ; $i++) 
     { 
     	# code...
     	 $PrPE= $PrPE+$St[$i] *$PE;

     	$PA = $PA + $St[$i] * pow($v,($i + 0.5)) * ($L[$x + $i ] - $L[$x + $i + 1]) / $L[$x] + $St[$i] * $fg * pow($v,$i) * $L[$x + $i ] / $L[$x] ;

     }

     $Primeannuel= array('PrDeces'=>$PA/(1-$fa) , 'PrimePE'=>$PrPE/(1-$fa));

    return $Primeannuel;
     //print_r($St);

 

}
   

/*echo json_encode(Primo(1000000,40,0.12,12,1,0.001,0.15,0,0)) ;
*/

function Prime
(
	$Capital,
	$Duree,
	$nai,
	$effet,
	$periodicite,
	$taux_banque,
	$PE,
	$idbanque,
	$typepret,
	$Rbt,
	$diff,
	$tauxSurprime
)
{
/*	$Capital=1000000;
	$Duree=12;
	$nai= '1976-10-10';
	$effet='2016-01-01';
	$per=12;
	$taux_banque=0.12;
	$fg=0.001;
	$fa=0.15;
	$PE=0;
	$acc=0;
	$diff=0;
	$Rbt=0;	*/	


	/*require_once '../api/v1/config.php';
   	require_once '../api/v1/dbHelper.php';
    $db = new dbHelper();*/
      global $db;
	$condition= array('idbanque'=>$idbanque,'idtypepret'=>$typepret);
    $user = $db->select("parametres","idbanque,fraisgestion,fraisacquisition,capitalmax,primeplanchet,accessoires,tauxprime,tauxperteemploi",$condition);

/*print_r( $user);*/
$txPE=0;
     

// Recupération des parametres
    foreach ($user['data'] as $key => $value) 
    {
    	$fg=$value['fraisgestion'];
    	$fa=$value['fraisacquisition'];
    	$capitalmax=$value['capitalmax'];
    	$primeplanchet=$value['primeplanchet'];
    	$acc=$value['accessoires'];
    	$tauxprime=$value['tauxprime'];
    	$txPE=$value['tauxperteemploi'];
    }


// gestion de la périodicite du contrat
switch ($periodicite) 
{
		case 'mensuelle':  
		$per=12;
		break;

		case 'trimestrielle': 
		$per=4;
		break;

		case 'annuelle': 
		$per=1;
		break;

		case 'semestrielle': 
		$per=2;
		break;

		case 'bimestrielle': 
		$per=6;
		break;
}
	


	$type_remb = ($Rbt=="PERIODIQUE") ? 0 : 1 ;
 
	//Calcul du taux de prime perte emploi
	$txPE = ($PE=="oui") ? $txPE : 0 ;


	$PRn1=array();
	$PRn2=array();
	



	
	$d=$diff;

	if ($diff>=$Duree || ($type_remb==1 || $Capital>100000000)) 
	{
		# code...
		$d=99999999;
	}


	list($annee1, $mois1, $jour1) = explode('-', $nai);
	list($annee2, $mois2, $jour2) = explode('-', $effet);

	// age de l'assuré
	$age= $annee2-$annee1;

	$n1= intval($Duree/12);

	if ($n1==($Duree/12)) 
	{
		# code...
		$n2=$n1;
	} 
	else 
	{
		# code...
		$n2=$n1+1;
	}

// Calcul des frais accessoires

if ($acc==0) 
		{
	


			switch ($Capital) 
			{
				case ($Capital<500000):
					# code...
					$ac=1000;
				break;
				case ($Capital<1000000):
					# code...
					$ac=1500;
				break;
				case ($Capital<3000000):
					# code...
					$ac=2000;
				break;
				case ($Capital<5000000):
					# code...
					$ac=2500;
				break;
				
				default:
					# code...
					$ac=3000;
					break;
			} 
		}
else 
		{
			$ac=$acc; // Si de la base un montant accessoires est renseigné alors c'est ce montant qui est pris en compte
				# code...
		}

	
// facteur d'interpolation entre deux annees	
	$alpha=1-($n2*12-$Duree)/12;


if ($Duree>0) 
{
	$PRn1=  Primo($Capital,$age,$taux_banque,$per,$n1,$fg,$fa,$d,$txPE);
	$PRn2=  Primo($Capital,$age,$taux_banque,$per,$n2,$fg,$fa,$d,$txPE);

	
} 


$PRD = $PRn1['PrDeces'] + ($PRn2['PrDeces']-$PRn1['PrDeces'])*$alpha;


$PRP = $PRn1['PrimePE'] + ($PRn2['PrimePE']-$PRn1['PrimePE'])*$alpha;
$prsurprime=($tauxSurprime * ($PRD+$PRP))/100;

$PR= $PRD+$PRP+$ac+$prsurprime;

$nbprnull=1;

if ($PR<$primeplanchet) 
{
	
	if ($PRP>0) {
		$nbprnull+= 1;
	}
	if ($prsurprime>0) {
		$nbprnull+= 1;
	}

$PRD+= ($primeplanchet-$PR)/$nbprnull;

if ($PRP>0) 
{
	$PRP+= ($primeplanchet-$PR)/$nbprnull;
}

if ($prsurprime>0) 
{
	$prsurprime+= ($primeplanchet-$PR)/$nbprnull;
}
} 

$PR= $PRD+$PRP+$ac+$prsurprime;


$Prime=array('Primetotale'=>round($PR,0),'Primedeces'=>round($PRD,0),'PrimePE'=>round($PRP,0),'Accessoires'=>$ac,'surprime'=>round($prsurprime,0));

return $Prime;

}



?>