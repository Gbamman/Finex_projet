<?php
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
                  //;
    $data=$_GET['idproduit'];
    $iduser=$_SESSION['uid']; 
    $nom=$_SESSION['name']; 
    $prenom=$_SESSION['surname'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    $condition="AND 1=2";
    if($droit=='agence'){
        $where =array('edu.idbanque'=> $idbanque,'edu.idagence'=> $idagence);
         $condition='AND edu.idbanque='.$idbanque.' AND edu.idagence='.$idagence.'AND edu.idproduit='.$data;
    }
    if($droit=='banque'){
       $where = array('edu.idbanque'=> $idbanque);
       $condition='AND edu.idbanque= '.$idbanque.' AND edu.idproduit='.$data;
    }
    // Récupération des données pour faire ressortir le BIA
        $db = new dbHelper();
        $sql="edu.idproduit,edu.numproduit,edu.libelleproduit,edu.statut,edu.datesignature,edu.dateeffet,edu.dureecontrat,edu.dateecheance,edu.codeagence,edu.apporteur,edu.typebeneficiaire,edu.civilite,edu.actenaissance,edu.nom,edu.prenom,edu.nom1,edu.prenom1,edu.nomAssure,edu.prenomAssure,edu.datenaissanceAssure,edu.emailAssure,edu.civiliteAssure,edu.numpieceAssure,edu.telephoneAssure,edu.boitepostalAssure,
        edu.datenaissance,edu.telephone,edu.profession,edu.boitepostal,edu.email,edu.typeprelevement,edu.idbanque,edu.idagence,edu.numerocompte,edu.matricule,edu.rib,edu.intitulecompte,edu.ville,edu.numpiece,edu.cumulcapitaux,edu.periodicite,edu.dureerente,edu.pourcentagerente,edu.prime,edu.renteannuelle,edu.questionnairemedical,ban.id as idbanque,ban.logo,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
        $table="produitbanque as edu INNER JOIN banque as ban ON edu.idbanque=ban.id INNER JOIN agence as agen ON edu.idagence=agen.idagence ";
      
    $contratEduc = $db->select2($table,$sql,array(),$condition);
      if ($contratEduc != NULL) 
          {
               $responseContrat=$contratEduc['data'];
               //print_r($responseContrat);
          };
          // Co-Assureurs Actif
          $response = array();
      $condition = array('etat'=>'0','idcoass'=>9);//'etat'=>'Actif'
     
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
                $condition = array('idbanque'=>$idbanque,'idtypepret'=> 13);
           $doneesparametres = $db->select("parametres","idparam,idbanque,fraisgestion,agemaxi,agemini,fraisacquisition,capitalmax,idtypepret,tauxprime,commission,quotepartaccessoires,fraisaperition,tauxperteemploi,accessoires,primeplanchet",$condition);
          
          if ( $doneesparametres != NULL) 
          {
             $parametreList= $doneesparametres['data'];
            
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }	  
         
   }
 ?>