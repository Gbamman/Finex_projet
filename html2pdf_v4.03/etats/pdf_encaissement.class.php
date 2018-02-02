<?php
	ini_set('memory_limit', '-1'); 
	session_start();
	extract($_POST); 
	require_once("connect_d_emprunt1.php");
	$Connex1= new Connexion1();
	$con1=$Connex1->connect_d();
	$psd=$_SESSION['pseudo'];
	$ag=$_SESSION['agence'];
	$date=date("d/m/Y"); 
	
	$dat=date("y"); 
	$sql = oci_parse($con1, 'SELECT MAX(TO_NUMBER(NUMBORD)) FROM CONTRAT'); 
	oci_execute($sql); 
	if (($arrnumbord = oci_fetch_row($sql)) != false){
	   $res=$arrnumbord[0];
	   $chaine=str_pad($res+1, 5, "0", STR_PAD_LEFT);   
	}
	else{
	   $chaine = $dat."00001";
	} 
	 
?>


<style type="text/css">
<!-- 
	table .first td
	{
		border-top:0.5px black;
		border-bottom:0.5px black;
		border-right:0.5px black;
		border-left:0.5px black;
		text-align:center;
		font-weight:bold;
		font-size:8px;
		vertical-align:middle;
	}
	table
	{
		border-collapse:collapse;
	}  
    page_footer 
	{
		width: 100%; 
		border: none; 
		background-color: #DDDDFF; 
		border-top: solid 1mm #AAAADD; 
		padding-top: 80mm
	} 
    div.note 
	{
		border: solid 1mm #DDDDDD;background-color: #EEEEEE; 
		
		border-radius: 2mm; 
		width: 100%; 
	}     		
	.main
	{
		width: 98%; border-top:0.5px black;
		border-right:0.5px black;
		border-left:0.5px black;
	}
	table tr td 
	{
		width: 9.28%;
		height:8px;
	}
	
	table .lg td
	{
		border-bottom:0.5px ;
		border-top:0.5px ;
		font-size: 7px;
	}

		
	}
	
	table .middle td
	{
		border-right:0.5px black;
		border-left:0.5px black;
		text-align:center;
	}
	.intitulle 
	{
		text-align:left;
	}
	.totalLigne 
	{ 		 
		background-color: #6B8E23;
		color: white;
	}
	table .tableau 
	{ 
		height: 80%;
	}


-->
</style>
<page backtop="5mm" backbottom="5mm" backleft="1.5mm" backright="1.5mm" style="font-size: 10.5px">
 
<page_footer >
	<table style="width: 100%;font-size: 5px; margin-top:30px;">
		<tr>
			<td style="text-align: left;    width: 95%"><span> <i>[SAHGES PRESTATION] Edit&eacute; par <?php echo $psd; ?> le <?php echo date('d/m/Y').' A '. date('H').'H'.date('i'); ?> </i></span></td>
		</tr>
	</table>
</page_footer>   
<table>
	<thead class="first">	 
		<tr>
			<td colspan="2"  > <img src="assets/img/logo_saham.jpg" alt="Logo Saham ASSURANCE" width="150" height="35" /> </td>
			<td colspan="7" >ETAT DE PRODUCTION N° <?php echo $chaine;?> </td>
			<td style="text-align: right; ">Page : [[page_cu]]/[[page_nb]]</td>
		</tr>
		<tr> 
			<td ><?php echo ('NUMERO') ;?></td>
			<td ><?php echo ('AGENCE');?></td>
			<td> <?php echo ('STATUT') ;?></td>
			<td ><?php echo ('NOM');?></td> 
			<td ><?php echo ('PRENOM');?></td>
			<td ><?php echo(' CAPITAL');?></td>
			<td ><?php echo ('DATE EFFET');?></td>
			<td ><?php echo ('DUREE');?></td>
			<td ><?php echo ('PRIME');?></td>			
			<td ><?php echo ('COMMISSION');?></td>
		</tr>				
		 		
	</thead>
	<tbody> 
		<?php
		
			//initialiastion des totaux
			$totalCapitaux = 0;
			$totalPrime = 0;
			$totalCommission = 0;			
			
			
	
			
			if(!empty($regular2)) $reg='%'.$regular2.'%';else $reg= '%';
			if(!empty($regular3)) $reg1='%'.$regular3.'%';else $reg1= '%';
			$s = oci_parse($con1, "select NUMCON,NUMPRET,STATUT,NOM,PRENOM,TO_CHAR(DATENAIS,'DD/MM/YYYY'),SEXE,CAPITAL, PERTEMP ,TO_CHAR(DATEEFFET,'DD/MM/YYYY') , DUREE , TAUXEMPR , NATURE ,PERIODE , TYPREMB ,DIFFERE ,PRIMASSUR ,TAUX ,LOGIN ,CODAG , CODPROFES,PRIME_ESSAI,PRIME_PE,ACCESSOIRE  
			from CONTRAT where  DATEENV BETWEEN TO_DATE(:1) AND TO_DATE(:2) AND LOGIN LIKE :3 AND CODAG LIKE :4 AND NUMBORD IS  NULL AND STATUT!=2 AND ETATPAIEMENT='PAYE'");

			if($typePret!='2')
			{
				$s = oci_parse($con1, "select NUMCON,NUMPRET,STATUT,NOM,PRENOM,TO_CHAR(DATENAIS,'DD/MM/YYYY'),SEXE,CAPITAL, PERTEMP ,TO_CHAR(DATEEFFET,'DD/MM/YYYY') , DUREE , TAUXEMPR , NATURE ,PERIODE , TYPREMB ,DIFFERE ,PRIMASSUR ,TAUX ,LOGIN ,CODAG , CODPROFES,PRIME_ESSAI,PRIME_PE,ACCESSOIRE  
				from CONTRAT where  nature=:5 AND (DATEENV BETWEEN TO_DATE(:1) AND TO_DATE(:2)) AND LOGIN LIKE :3 AND CODAG LIKE :4 AND NUMBORD IS  NULL AND STATUT!=2 AND ETATPAIEMENT='PAYE'");
				oci_bind_by_name($s, ":5", $typePret);
			}
			 
			oci_bind_by_name($s, ":1", $regular0);
			oci_bind_by_name($s, ":2", $regular1); 
			oci_bind_by_name($s, ":3", $reg);
			oci_bind_by_name($s, ":4", $reg1); 
			oci_execute($s); 
			while (($arr = oci_fetch_row($s)) != false) { 
				$requete = oci_parse($con1, " Update CONTRAT SET NUMBORD =:1 WHERE NUMCON =:2");
				oci_bind_by_name($requete, ":1", $chaine);
				oci_bind_by_name($requete, ":2", $arr[0]);
				oci_execute($requete); 	 
		?>
		<tr class="middle lg ">
			<td><?php echo $arr[0]; ?></td>
			<td><?php 
						$nomtable ='agence';
						$codeee='CODAG';
						$code=$arr[19];
						$s1 = oci_parse($con1, 'call listtablecrit1(:nomtable,:codeee,:code,:resu1)');
						oci_bind_by_name($s1, ":nomtable", $nomtable);
						oci_bind_by_name($s1, ":codeee", $codeee); 
						oci_bind_by_name($s1, ":code", $code); 
						$resu1 = oci_new_cursor($con1);						
						oci_bind_by_name($s1, ":resu1", $resu1,-1,OCI_B_CURSOR);
						oci_execute($s1);
						oci_execute($resu1);
						if (($arr2 = oci_fetch_row($resu1)) != false) $lib = $arr2[1]; 
			echo $lib; ?></td>
			<td><?php if($arr[2]==2) $st= 'ANNULATION';else $st= 'SOUSCRIPTION'; echo $st; ?></td>
			<td><?php echo $arr[3]; ?></td>
			<td><?php echo $arr[4]; ?></td>
			<td><?php $totalCapitaux = $totalCapitaux + $arr[7];
					echo number_format($arr[7],0,'.',' ');  ?></td>
			<td><?php echo $arr[9]; ?></td>
			<td><?php echo $arr[10]; ?></td>
			<td><?php 
					$totalPrime = $totalPrime + $arr[16];
			echo number_format($arr[16],0,'.',' '); ?></td>
			<td><?php 
				$totalCommission = $totalCommission + $arr[16]*0.15;
			echo number_format($arr[16]*0.15,0,'.',' '); ?></td>			 			
		</tr> 
		<?php
			}
		?>
		<tr class="middle lg ">
			<td><?php   ?></td>
			<td><?php  ?></td>
			<td><?php  ?></td>
			<td><?php echo ('TOTAUX'); ?></td>
			<td><?php echo ('-'); ?></td>
			<td><?php echo number_format($totalCapitaux,0,'.',' '); ?></td>
			
			<td><?php echo ('-');?></td>
			<td><?php echo number_format($totalPrime,0,'.',' '); ?></td>
			<td><?php echo ('-');  ?></td>
			<td><?php echo number_format($totalCommission,0,'.',' '); ?></td>			 			
		</tr> 
	</tbody> 
</table> 
</page> 
 



