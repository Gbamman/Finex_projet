<?php 

$app->get('/getPrestationSinistre',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $sql='etat.idetat,etat.libelle as libelleetat,pres.idprestation,pres.libelle';
     $table='prestation as pres INNER JOIN etatcontrat as etat ON pres.idetat=etat.idetat';
     $prestation = $db->select($table,$sql,$condition);
     
     echoResponse(200, $prestation);
});
$app->get('/ensemblepices',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $pieces = $db->select('piece','id,libelle',$condition);
     
     echoResponse(200, $pieces);
});
$app->get('/GetSinistre',function() use ($app){
    $sql='sini.idsinistre,sini.datedeclaration,sini.nomdeclarant,sini.montantattendu,sini.montantregle,sini.datereglement,sini.capital,sini.primeassurance,sini.numerocontrat,sini.dateeffet,sini.dateecheance,sini.datesurvenance,sini.identifiant as identifiantassure,sini.pieces as piecesCoches,sini.observations,sini.assureur_name as coassureur,pres.idprestation,pres.libelle';
    $table='sinistre as sini INNER JOIN prestation as pres ON sini.idprestation=pres.idprestation';
       $data = json_decode($app->request->getBody());
      $condition = array();
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $donneesinistre = $db->select($table,$sql,$condition);
     
     echoResponse(200, $donneesinistre);
});
$app->get('/piecesAfournir/:id',function($id) use ($app){
    $sql='prespiece.id,prespiece.etat,prespiece.idprestation,piece.libelle as libellepiece,piece.id as idpiece';
    $table='pieceprestation as prespiece  INNER JOIN piece as piece ON prespiece.idpiece=piece.id';
       $data = json_decode($app->request->getBody());
      $condition = array();
      $response = array();
      $condition = array();
      $order='AND prespiece.etat=1 AND prespiece.idprestation='.$id;
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $sinistrePiece = $db->selectdistinct($table, $sql,$condition,$order);
     
     echoResponse(200, $sinistrePiece);
});

$app->put('/sinistreModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idsinistre'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
        $data->dateeffet=dateFR2US($data->dateeffet);
        $data->dateecheance=dateFR2US($data->dateecheance);
        $data->datesurvenance=dateFR2US($data->datesurvenance);
        $data->datereglement=isset($data->datereglement)?dateFR2US($data->datereglement):null;
        $data->datedeclaration=isset($data->datedeclaration)?dateFR2US($data->datedeclaration):null;
        $data->observations=isset($data->observations)?htmlspecialchars($data->observations):null;
        $data->numeropret=isset($data->numeropret)?htmlspecialchars($data->numeropret):null;
        $data->montantregle=isset($data->montantregle)?htmlspecialchars($data->montantregle):null;
        $data->montantattendu=isset($data->montantattendu)?htmlspecialchars($data->montantattendu):null;
        $data->piecesCoches=isset($data->piecesCoches)?htmlspecialchars($data->piecesCoches):null;
         $dataArray = array('idprestation'=>$data->idprestation,'datedeclaration'=>$data->datedeclaration,'nomdeclarant'=> htmlspecialchars($data->nomdeclarant),'montantattendu'=>  $data->montantattendu,'montantregle'=>$data->montantregle,'numerocontrat'=>$data->numerocontrat,'datereglement'=>  $data->datereglement,'idbanque'=>  $_SESSION['idbanque'],'idagence'=>  $_SESSION['idagence'],
           'assureur_name'=>$data->coassureur,'dateeffet'=>  $data->dateeffet,'dateecheance'=>  $data->dateecheance,'datesurvenance'=>  $data->datesurvenance,'capital'=>  $data->capital,'primeassurance'=>  $data->primeassurance,'identifiant'=>  $data->identifiantassure,'pieces'=>  $data->piecesCoches,'observations'=>$data->observations);
        $mandatory = array();
         $prestationmodif = $db->update("sinistre",$dataArray,$condition,$mandatory);
       if($prestationmodif["status"]=="success"){
           $Niveaucontrat = array('niveau'=> $data->idetat);
           $conditionContrat=array('numeropret' => $data->numerocontrat);
          $contratModif = $db->update("contrat",$Niveaucontrat,$conditionContrat,$mandatory);
          if($contratModif=="success"){
                  $prestationmodif["status"]="success";
                  $prestationmodif["message"] = "prestation modifiée.";
          }else{
                $prestationmodif= $contratModif;
                 
          }
        
       }else{
             $prestationmodif;
             $prestationmodif["monde"] = $data;
       }
         
  			 echoResponse(200,  $prestationmodif);
  
    });
  $app->post('/sinistreInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY numerocontrat LIMIT 1';
       
        $data->dateeffet=dateFR2US($data->dateeffet);
        $data->dateecheance=dateFR2US($data->dateecheance);
        $data->datesurvenance=dateFR2US($data->datesurvenance);
        $data->datereglement=isset($data->datereglement)?dateFR2US($data->datereglement):null;
        $data->datedeclaration=isset($data->datedeclaration)?dateFR2US($data->datedeclaration):null;
        $data->observations=isset($data->observations)?htmlspecialchars($data->observations):null;
        $data->numeropret=isset($data->numeropret)?htmlspecialchars($data->numeropret):null;
        $data->montantregle=isset($data->montantregle)?htmlspecialchars($data->montantregle):null;
        $data->montantattendu=isset($data->montantattendu)?htmlspecialchars($data->montantattendu):null;
        $data->piecesCoches=isset($data->piecesCoches)?htmlspecialchars($data->piecesCoches):null;
      //$conditionverif = array('idprestation'=>$data->idprestation,'datedeclaration'=>  $data->datedeclaration,'nomdeclarant'=> htmlspecialchars($data->nomdeclarant),'montantattendu'=>  $data->montantattendu,'montantregle'=>  $data->montantregle,'datereglement'=>  $data->datereglement,'numerocontrat'=>  $data->numerocontrat);
      $conditionverif = array('numerocontrat'=>  $data->numerocontrat);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $prestationVerif = $db->select2("sinistre","numerocontrat",$conditionverif,$order);
    if ($prestationVerif["status"]!="success") {
       $dataArray = array('idprestation'=>$data->idprestation,'datedeclaration'=>  $data->datedeclaration,'nomdeclarant'=>htmlspecialchars($data->nomdeclarant),'montantattendu'=>  $data->montantattendu,'montantregle'=>$data->montantregle,'numerocontrat'=>$data->numerocontrat,'datereglement'=>  $data->datereglement,'idbanque'=>  $_SESSION['idbanque'],'idagence'=>  $_SESSION['idagence'],
        'assureur_name'=>$data->coassureur, 'dateeffet'=>  $data->dateeffet,'dateecheance'=>  $data->dateecheance,'datesurvenance'=>  $data->datesurvenance,'capital'=>  $data->capital,'primeassurance'=>  $data->primeassurance,'identifiant'=>  $data->identifiantassure,'pieces'=>  $data->piecesCoches,'observations'=>$data->observations);
       $mandatory = array();
        $condition = array();
      $sinistreInsert = $db->insert("sinistre",$dataArray,$condition,$mandatory);
         if($sinistreInsert["status"]=="success"){
                 $Niveaucontrat = array('niveau'=> $data->idetat);
                   $conditionContrat=array('numeropret' => $data->numerocontrat);
                  $contratModif = $db->update("contrat",$Niveaucontrat,$conditionContrat,$mandatory);
               if($contratModif=="success"){
                        $sinistreInsert["status"]="success";
                        $sinistreInsert["message"] = "Le prestation a été bien enrégistrée";
                }else{
                      $prestationmodif= $contratModif;  
                }
         
         }else{
         	    $sinistreInsert;
         }
        
    }else{
            $sinistreInsert["status"]="error";
            $sinistreInsert["message"] = "Désolé une prestation existe déjà pour ce contrat.";
          
          
    } 
    echoResponse(200, $sinistreInsert);/*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });
// Recherche des Sinistres
$app->post('/SearchSinistrePath',function() use ($app) { 
 $data = json_decode($app->request->getBody());
    $criteres= htmlspecialchars($data->criteres);
    if (strlen($criteres) >'3') {
    $sql='sini.idsinistre,sini.datedeclaration,sini.nomdeclarant,sini.montantattendu,sini.montantregle,sini.datereglement,sini.capital,sini.primeassurance,sini.numerocontrat,sini.dateeffet,sini.dateecheance,sini.datesurvenance,sini.identifiant as identifiantassure,sini.pieces,sini.observations,sini.assureur_name as coassureur,pres.idprestation,pres.libelle';
    $table='sinistre as sini INNER JOIN prestation as pres ON sini.idprestation=pres.idprestation';
       $data = json_decode($app->request->getBody());
      $condition = array();
      $order="AND (sini.nomdeclarant LIKE '%".$criteres."%' OR sini.identifiant LIKE '%".$criteres."%' OR sini.numerocontrat LIKE '%".$criteres."%') ";
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $donneesinistre = $db->select2($table,$sql,$condition, $order);
     if($donneesinistre['status'] != 'success'){
      $rechercheGlobale = $db->select($table,$sql,$condition);
      $donneesinistre["status"]=="warning";
      $donneesinistre["message"] = "Aucune donnée n'a été retrouvée pour cette recherche!";
      $donneesinistre["data"] =  $rechercheGlobale['data'];
     } 
   }else{
    $donneesinistre["status"]="error";
      $donneesinistre["message"] = "Veuillez entrer un mot clé";
   }
      echoResponse(200, $donneesinistre);
     
  });

$app->post('/assuresinistrePath',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $condition = array('numeropret'=>$data->numeropret);
 			require_once 'dbHelper.php';
    			$db = new dbHelper();
     $identification = $db->select("contrat","nom,prenom,dateeffet,dateecheance,capital,primeassurance",$condition);
    echoResponse(200,$identification);
 });
	  $app->delete('/deleteSinistre/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows = $db->delete("sinistre", array('idsinistre'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "La prestation a été supprimée de la liste!";
     
       echoResponse(200, $rows);
   
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 ?>