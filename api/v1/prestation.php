<?php 
$app->get('/getPrestation',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
      $sql='pres.idprestation,pres.libelle,etat.idetat,etat.libelle as etatContratLibelle';
    $table='prestation as pres INNER JOIN etatcontrat as etat ON pres.idetat=etat.idetat';
    $db = new dbHelper();
     $prestation = $db->select($table,$sql,$condition);
     
     echoResponse(200, $prestation);
});
//Eta contrat
$app->get('/getEtat',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $etatcontrat = $db->select('etatcontrat','idetat,libelle',$condition);
     
     echoResponse(200, $etatcontrat);
});
$app->get('/gestionPestationAdim/:id',function($id) use ($app){
    $sql='prespiece.id,prespiece.etat,prespiece.idprestation,piece.libelle as libellepiece,piece.id as idpiece,pres.idprestation,pres.libelle';
    $table='prestation as pres INNER JOIN pieceprestation as prespiece ON pres.idprestation=prespiece.idprestation INNER JOIN piece as piece ON prespiece.idpiece=piece.id';
       $data = json_decode($app->request->getBody());
      $condition = array();
      $response = array();
      $condition = array();
      $order='AND pres.idprestation='.$id;
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $prestationPiece = $db->selectdistinct($table, $sql,$condition,$order);
     
     echoResponse(200, $prestationPiece);
});
$app->put('/AffectationPiece/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('etat'=> $data->etat);
        $mandatory = array();
        $user = $db->update("pieceprestation",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
         $user["message"] = "Etat modifié.";
       }else{
        $user;
       }
         
         echoResponse(200, $user);
  
    });
$app->put('/prestationModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idprestation'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
    $libelle=htmlspecialchars($data->libelle);
         $dataArray = array('libelle'=>$libelle,'idetat'=>$data->idetat);
        $mandatory = array();
         $prestationmodif = $db->update("prestation",$dataArray,$condition,$mandatory);
       if($prestationmodif["status"]=="success"){
        $prestationmodif["status"]="success";
         $prestationmodif["message"] = "prestation modifiée.";
       }else{
             $prestationmodif;
             $prestationmodif["monde"] = $data;
       }
         
  			 echoResponse(200,  $prestationmodif);
  
    });
  $app->post('/prestationInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->libelle);
      $conditionverif = array('libelle'=>$libelle,'idetat'=>$data->idetat);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $prestationVerif = $db->select2("prestation","libelle",$conditionverif,$order);
    if ($prestationVerif["status"]!="success") {
         $dataArray = array('libelle'=>$libelle,'idetat'=>$data->idetat);
       $mandatory = array();
        $condition = array();
      $prestationInsert = $db->insert("prestation",$dataArray,$condition,$mandatory);
         $prestationInsert["status"]="success";
         $prestationInsert["message"] = "La prestation a été bien enrégistrée";
        
    }else{
            $prestationInsert["status"]="error";
            $prestationInsert["message"] = "Désolé cette prestation existe déjà.";
          
          
    } 
    echoResponse(200, $prestationInsert);/*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });
	  $app->delete('/deletePresatation/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows = $db->delete("prestation", array('idprestation'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "La prestation a été supprimée de la liste!";
     
       echoResponse(200, $rows);
   
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 ?>