<?php 
$app->get('/getEducPlusPath',function() use ($app) { 
    $condition = array();
    require_once 'dbHelper.php';
    $db = new dbHelper();
      $mandatory = array();
      $condition = array();
      $sql="edu.idproduit,edu.numproduit,edu.libelleproduit,edu.statut,edu.datesignature,edu.dateeffet,edu.dureecontrat,edu.dateecheance,edu.codeagence,edu.apporteur,edu.typebeneficiaire,edu.civilite,edu.actenaissance,edu.nom,edu.prenom,edu.nom1,edu.prenom1,edu.nomAssure,edu.prenomAssure,edu.datenaissanceAssure,edu.emailAssure,edu.civiliteAssure,edu.numpieceAssure,edu.telephoneAssure,edu.boitepostalAssure,
      edu.datenaissance,edu.telephone,edu.profession,edu.boitepostal,edu.email,edu.typeprelevement,edu.idbanque,edu.idagence,edu.numerocompte,edu.matricule,edu.rib,edu.intitulecompte,edu.ville,edu.numpiece,edu.cumulcapitaux,edu.periodicite,edu.dureerente,edu.pourcentagerente,edu.prime,edu.renteannuelle,edu.questionnairemedical,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
        $table="produitbanque as edu INNER JOIN banque as ban ON edu.idbanque=ban.id INNER JOIN agence as agen ON edu.idagence=agen.idagence ";
      $order ='order by edu.idproduit DESC LIMIT 50';
       $user = $db->select2($table,$sql,$condition,$order);
        echoResponse(200, $user);
});
// EdUCPLUS synchronisation numcontratauto
$app->get('/numeducplusauto', function() use ($app){ 
    $condition = array();
            global $db;
            $numcontrat = $db->select("synchronisationnum","numeducplus",$condition);
            echoResponse(200,$numcontrat);
});
$app->put('/updateProduit/:id',function($id) use ($app) { 
       /*  $dataArray = array('libelleproduit'=>$data->libelleproduit,'statut'=>$data->statut,'dateeffet'=>$data->dateeffet,
          'dureediffere'=>$data->dureediffere,
          'dateecheance'=>$data->dateecheance,'codeagence'=>$data->codeagence,'statut'=>$data->statut,
          'datesignature'=>$data->datesignature,'dureecontrat'=>$data->cdureecontrat,'numpiece'=>$data->numpiece,'nom'=>$data->nom,'telephone'=>$data->telephone,'boitepostal'=>$data->boitepostal
         ,'codeagence'=>$data->codeagence,'matricule'=>$data->matricule,'rib'=>$data->rib,'idagence'=>$data->idagence,'intitulecompte'=>$data->intitulecompte,'civilite'=>$data->civilite 'datenaissance'=>$data->datenaissance,'email'=>$data->email,'idbanque'=>$data->idbanque
          ,'nomSous'=>$data->nomSous,'prenomSous'=>$data->prenomSous,'cumulcapitaux'=>$data->cumulcapitaux,'emailSous'=>$data->emailSous,'civiliteSous'=>$data->civiliteSous,'numpiecesSous'=>$data->numpiecesSous,'datenaissanceSous'=>$data->datenaissanceSous,'telephoneSous'=>$data->telephoneSous,,'typebeneficiaire'=>$data->typebeneficiaire,'nom1'=>$data->nom1,'prenom1'=>$data->prenom1,'periodicite'=>$data->periodicite,'prime'=>$data->prime,'pourcentagerente'=>$data->pourcentagerente,'renteannuelle'=>$data->renteannuelle
          ); */
          $data = json_decode($app->request->getBody());
          $data->datesignature=dateFR2US($data->datesignature);
          $data->dateeffet=dateFR2US($data->dateeffet);
          $data->dateecheance=dateFR2US($data->dateecheance);
          $data->datenaissance=dateFR2US($data->datenaissance);
           $data->datenaissanceAssure=isset($data->datenaissanceAssure) ? $data->datenaissanceAssure : null;
          $data->datenaissanceAssure=dateFR2US($data->datenaissanceAssure);
          $data->nom1=isset($data->nom1) ? $data->nom1 : null;
          $data->nom1=isset($data->prenom1) ? $data->prenom1 : null;
          $data->codeagence=isset($data->codeagence) ? $data->codeagence : null;
           $data->cumulcapitaux=isset($data->cumulcapitaux) ? $data->cumulcapitaux : null;
           $data->typebeneficiaire=isset($data->typebeneficiaire) ? $data->typebeneficiaire : null;
            $data->questionnairemedical=isset($data->questionnairemedical) ? $data->questionnairemedical : null;
            $data->nomAssure=isset($data->nomAssure) ? $data->nomAssure : null;
            $data->prenomAssure=isset($data->prenomAssure) ? $data->prenomAssure : null;
            $data->emailAssure=isset($data->emailAssure) ? $data->emailAssure : null;
            $data->civiliteAssure=isset($data->civiliteAssure) ? $data->civiliteAssure : null;
            $data->numpieceAssure=isset($data->numpieceAssure) ? $data->numpieceAssure : null;
            $data->telephoneAssure=isset($data->telephoneAssure) ? $data->telephoneAssure : null;
            $data->boitepostalAssure=isset($data->boitepostalAssure) ? $data->boitepostalAssure : null;
           $dataArray = array('libelleproduit'=>$data->libelleproduit,'statut'=>$data->statut,'dateeffet'=>$data->dateeffet,'dureecontrat'=>$data->dureecontrat,'dateecheance'=>$data->dateecheance,'codeagence'=>$data->codeagence,
            'statut'=>$data->statut,'datesignature'=>$data->datesignature,'dureecontrat'=>$data->dureecontrat,'numpiece'=>$data->numpiece,'nom'=>$data->nom,'prenom'=>$data->prenom,'telephone'=>$data->telephone,'boitepostal'=>$data->boitepostal,
            'codeagence'=>$data->codeagence,'matricule'=>$data->matricule,'rib'=>$data->rib,'idagence'=>$data->idagence,'iduser'=>$_SESSION['uid'],
            'intitulecompte'=>$data->intitulecompte,'civilite'=>$data->civilite,'datenaissance'=>$data->datenaissance,'email'=>$data->email,
            'idbanque'=>$data->idbanque,'cumulcapitaux'=>$data->cumulcapitaux,'typebeneficiaire'=>$data->typebeneficiaire,'nom1'=>$data->nom1,
            'prenom1'=>$data->prenom1,'nomAssure'=>$data->nomAssure,'prenomAssure'=>$data->prenomAssure,'datenaissanceAssure'=>$data->datenaissanceAssure,'emailAssure'=>$data->emailAssure,'civiliteAssure'=>$data->civiliteAssure,'numpieceAssure'=>$data->numpieceAssure,'telephoneAssure'=>$data->telephoneAssure,'boitepostalAssure'=>$data->boitepostalAssure,
            'periodicite'=>$data->periodicite,'prime'=>$data->prime,'pourcentagerente'=>$data->pourcentagerente,'renteannuelle'=>$data->renteannuelle,'questionnairemedical'=>$data->questionnairemedical);
            require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
           $mandatory = array();
          $condition = array('idproduit'=>$data->idproduit);
        $db = new dbHelper();
        $user = $db->update("produitbanque",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
          $user["message"] = "Produit modifié.";
        }else{
           $user;
        }
         echoResponse(200, $user);
  
    });
  $app->post('/insertProduit',function() use ($app) { 
    $data = json_decode($app->request->getBody());
          $data->datesignature=dateFR2US($data->datesignature);
          $data->dateeffet=dateFR2US($data->dateeffet);
          $data->dateecheance=dateFR2US($data->dateecheance);
          $data->datenaissance=dateFR2US($data->datenaissance);
          $data->datenaissanceAssure=isset($data->datenaissanceAssure) ? $data->datenaissanceAssure : null;
          $data->datenaissanceAssure=dateFR2US($data->datenaissanceAssure);
          $data->nom1=isset($data->nom1) ? $data->nom1 : null;
          $data->nom1=isset($data->prenom1) ? $data->prenom1 : null;
          $data->codeagence=isset($data->codeagence) ? $data->codeagence : null;
           $data->cumulcapitaux=isset($data->cumulcapitaux) ? $data->cumulcapitaux : null;
           $data->typebeneficiaire=isset($data->typebeneficiaire) ? $data->typebeneficiaire : null;
           $data->questionnairemedical=isset($data->questionnairemedical) ? $data->questionnairemedical : null;
           $data->nomAssure=isset($data->nomAssure) ? $data->nomAssure : null;
            $data->prenomAssure=isset($data->prenomAssure) ? $data->prenomAssure : null;
            $data->emailAssure=isset($data->emailAssure) ? $data->emailAssure : null;
            $data->civiliteAssure=isset($data->civiliteAssure) ? $data->civiliteAssure : null;
            $data->numpieceAssure=isset($data->numpieceAssure) ? $data->numpieceAssure : null;
            $data->telephoneAssure=isset($data->telephoneAssure) ? $data->telephoneAssure : null;
              $data->boitepostalAssure=isset($data->boitepostalAssure) ? $data->boitepostalAssure : null;
               require_once 'dbHelper.php';
              $db = new dbHelper();
               $order ='ORDER BY idproduit LIMIT 1';
              $conditionverif = array('numproduit'=>$data->numproduit);
              /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
              $user1 = $db->select2("produitbanque","numproduit",$conditionverif,$order);
              if ($user1["status"]=="success") {
                  $condition = array();
                  $num = $db->select("synchronisationnum","numeducplus",$condition);
                  $numero = $num['data'][0]['numeducplus'];
                  $numcontrat=$numero+1;
                  $numeroActualise= $numcontrat;
                   $year=date('Y');
                  $numeropret='SAHBEN/EDUCPLUS/'.$year.'/'.$numcontrat;
                
              }else{
                  $numeropret=$data->numproduit;
                  $numeroActualise=$data->numsynchro;

              }
           $dataArray = array('numproduit'=>$numeropret,'libelleproduit'=>$data->libelleproduit,'statut'=>$data->statut,'dateeffet'=>$data->dateeffet,'dureecontrat'=>$data->dureecontrat,'dateecheance'=>$data->dateecheance,'codeagence'=>$data->codeagence,
            'statut'=>$data->statut,'datesignature'=>$data->datesignature,'dureecontrat'=>$data->dureecontrat,'numpiece'=>$data->numpiece,'nom'=>$data->nom,'prenom'=>$data->prenom,'telephone'=>$data->telephone,'boitepostal'=>$data->boitepostal,
            'codeagence'=>$data->codeagence,'matricule'=>$data->matricule,'rib'=>$data->rib,'idagence'=>$data->idagence,'iduser'=>$_SESSION['uid'],
            'intitulecompte'=>$data->intitulecompte,'civilite'=>$data->civilite,'datenaissance'=>$data->datenaissance,'email'=>$data->email,
            'idbanque'=>$data->idbanque,'cumulcapitaux'=>$data->cumulcapitaux,'typebeneficiaire'=>$data->typebeneficiaire,'nom1'=>$data->nom1,
            'prenom1'=>$data->prenom1,'nomAssure'=>$data->nomAssure,'prenomAssure'=>$data->prenomAssure,'datenaissanceAssure'=>$data->datenaissanceAssure,'emailAssure'=>$data->emailAssure,'civiliteAssure'=>$data->civiliteAssure,'numpieceAssure'=>$data->numpieceAssure,'telephoneAssure'=>$data->telephoneAssure,'boitepostalAssure'=>$data->boitepostalAssure,

            'periodicite'=>$data->periodicite,'prime'=>$data->prime,'pourcentagerente'=>$data->pourcentagerente,'renteannuelle'=>$data->renteannuelle,'questionnairemedical'=>$data->questionnairemedical,'created'=>date('Y-m-d H:i:s'));
           $mandatory = array();
           $condition = array();
          $user = $db->insert("produitbanque",$dataArray,$condition,$mandatory);
          if( $user["status"]=="success"){
                 $user["status"]="success";
                  $user["message"] = "Produit enrégistré";
                $contratnum =array('numeducplus'=> $numeroActualise);
                $condition=array();
                 $synchro = $db->update("synchronisationnum", $contratnum, $condition, $mandatory);
          }
         
    echoResponse(200, $user);/*,$data->myFile 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });
    // Statut du contrat
      
       $app->put('/educplusStatut/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idproduit'=>$id);
    if(isset($data->statut)){
    global $db;
    $dataArray = array('statut' => $data->statut);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le statut a été correctement modifié.";
    }
    echoResponse(200, $user);
});   
       // Recherche de produit educplus
       $app->post('/SearchProduitPath', function() use ($app) { 
     $data = json_decode($app->request->getBody());
     if (isset($_SESSION['uid'], $data) AND $_SESSION['uid'] >0) {
    $criteres= htmlspecialchars($data->criteres);
    $iduser=$_SESSION['uid'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    $order="AND 1=2";
    if($droit=='agence'){
        $where =array('edu.idbanque'=> $idbanque,'idagence'=> $idagence);
         $order='AND edu.idbanque='.$idbanque.'AND edu.idagence='.$idagence;
    }
    if($droit=='banque'){
       $where = array('edu.idbanque'=> $idbanque);
       $order='AND edu.idbanque= '.$idbanque;
    }
}
    if (isset($criteres) AND strlen($criteres)>='2' ) {
   $sql="edu.idproduit,edu.numproduit,edu.libelleproduit,edu.statut,edu.datesignature,edu.dateeffet,edu.dureecontrat,edu.dateecheance,edu.codeagence,edu.apporteur,edu.typebeneficiaire,edu.civilite,edu.actenaissance,edu.nom,edu.prenom,edu.nom1,edu.prenom1,edu.nomAssure,edu.prenomAssure,edu.datenaissanceAssure,edu.emailAssure,edu.civiliteAssure,edu.numpieceAssure,edu.telephoneAssure,edu.boitepostalAssure,
      edu.datenaissance,edu.telephone,edu.profession,edu.boitepostal,edu.email,edu.typeprelevement,edu.idbanque,edu.idagence,edu.numerocompte,edu.matricule,edu.rib,edu.intitulecompte,edu.ville,edu.numpiece,edu.cumulcapitaux,edu.periodicite,edu.dureerente,edu.pourcentagerente,edu.prime,edu.renteannuelle,edu.questionnairemedical,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
        $table="produitbanque as edu INNER JOIN banque as ban ON edu.idbanque=ban.id INNER JOIN agence as agen ON edu.idagence=agen.idagence AND
             (edu.nom LIKE '%".$criteres."%' OR edu.prenom LIKE '%".$criteres."%' OR edu.prime LIKE '%".$criteres."%') ".$order;
    global $db;
    $rows = $db->select($table,$sql,array());
        if ($rows['status'] != 'success') {
                    $iduser=$_SESSION['uid'];
                        $idbanque=$_SESSION['idbanque'];
                        $idagence=$_SESSION['idagence'];
                        $droit=$_SESSION['droit'];
                        $variable=$droit;
                if($droit=='agence'){
                    $where =array('idbanque'=> $idbanque,'idagence'=> $idagence);
                }
                if($droit=='banque'){
                            $where = array('idbanque'=> $idbanque);
                }
                    $table1="produitbanque as edu INNER JOIN banque as ban ON edu.idbanque=ban.id INNER JOIN agence as agen ON edu.idagence=agen.idagence"; 
                     $rehercherGlobale = $db->select2($table1,$sql,array(),$order);
                    if ($rehercherGlobale['data']==='success') {
                        $rows["status"]="error";
                        $rows["message"] = "Aucune donnée n'a été retrouvée.";
                        $rows["data"] =  $rehercherGlobale['data'];
                    }
                   
                }
     }else{
        $rows["status"]="error";
        $rows["message"] = "Veuillez entrer une mot clé.";
           
     }
    echoResponse(200,$rows);
});
 ?>