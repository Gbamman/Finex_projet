<?php
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
                  
    $data=$_GET['idcontrat'];
    $idtypepret=$_GET['idtypepret'];
    $iduser=$_SESSION['uid']; 
    $nom=$_SESSION['name']; 
    $prenom=$_SESSION['surname'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    $condition="AND 1=2";
    if($droit=='agence'){
        $where =array('co.idbanque'=> $idbanque,'idagence'=> $idagence);
         $condition='AND co.idbanque='.$idbanque.' AND co.idagence='.$idagence.'AND co.idcontrat='.$data;
    }
    if($droit=='banque'){
       $where = array('co.idbanque'=> $idbanque);
       $condition='AND co.idbanque= '.$idbanque.' AND co.idcontrat='.$data;
    }
     $db = new dbHelper();
  $sql = " co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,
  co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,
  co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,
  co.primedeces,co.iduser,co.primeperte,co.accessoires,co.totalesupprime,co.montantsupprime,co.niveau,co.save,ban.id as idbanque,
  agen.idagence,agen.libelle as libelleagence,agen.ville,ban.libelle as banquelibelle,ban.logo";
  $table="contrat as co INNER JOIN banque as ban 
        ON co.idbanque=ban.id INNER JOIN agence as agen
             ON co.idagence=agen.idagence";

    $contratAlerteListe = $db->select2($table,$sql,array(),$condition);
      if ($contratAlerteListe != NULL) 
          {
               $responseContrat=$contratAlerteListe['data'];
          };
          // Co-Assureurs Actif
          $response = array();
      $condition = array('etat'=>'0');//'etat'=>'Actif'
     
    $order='ORDER BY nomcoassureur';

     $coassureur = $db->select2("coassureur","idcoass,nomcoassureur,logo,part,etat",$condition,$order);
      if ($coassureur != NULL) 
          {
              $coassureurList=$coassureur['data'];
          };

          //Questionaire medicale
           $question = $db->select("questions_medicales","idm,libelle,tauxsup,etat",array('etat'=>'Actif'));
           if ($question != NULL) 
          {
               $Listesquestions=$question['data'];
          };

		  
	
         // Requete pour recuperer les informations au niveau de parametre prime
                $condition = array('idbanque'=>$idbanque,'idtypepret'=> $idtypepret);
           $doneesparametres = $db->select("parametres","idparam,idbanque,fraisgestion,agemaxi,agemini,fraisacquisition,capitalmax,idtypepret,tauxprime,commission,quotepartaccessoires,fraisaperition,tauxperteemploi,accessoires,primeplanchet",$condition);
          
          if ( $doneesparametres != NULL) 
          {
             $parametreList= $doneesparametres['data'];
            
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }	  
         
   }
 ?>