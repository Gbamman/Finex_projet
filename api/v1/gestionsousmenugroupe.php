
<?php 
 if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 
$app->get('/gestionsousutilisteur',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array();
      $user = $db->select("sousmenus","idsousmenu,libelle",$condition);
       $user["verification"] = "0";
     echoResponse(200, $user);
});

$app->get('/gestionsousutilisteurSame/:id',function($id) use ($app){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array($id);
      $user = $db->select6($condition);
    /*   $user["verification"] = "0"; $condition = array('id'=> $_SESSION['idbanque'],'etat'=>'Actif');*/
     echoResponse(200, $user);
});
$app->get('/listenamegroupe',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array();
      $user = $db->select7();
      /* $user["verification"] = "0";*/
     echoResponse(200, $user);
});

$app->post('/namegroupeInsert',function() use ($app){
	 $data = json_decode($app->request->getBody());
      require_once 'dbHelper.php';
    $db = new dbHelper();
      $order ='ORDER BY idsousmenu LIMIT 1';
     $response = array();
      $condition = array();
       $mandatory = array();
       $conditionverif = array('idsousmenu'=>$data->idsousmenu,'idnomgroupe'=>$data->idnomgroup);
      $dataArray = array('idsousmenu'=>$data->idsousmenu,'idnomgroupe'=>$data->idnomgroup,'actionMenue'=>$data->actionMenue);
 $user1 = $db->select2("groupeutilisateur","idnomgroupe",$conditionverif,$order);
    if ($user1["status"]!="success") {
      $user = $db->insert("groupeutilisateur",$dataArray,$condition,$mandatory);
        if( $user["status"]=="success")
         $user["status"]="success";
         $user["message"] = "Element enrégistré";
          $user["compte"] = $data ;
    }else{
            $user["status"]="error";
            $user["message"] = "Désolé ce Sous menu est dejà lié ce groupe utilisateur.";
            $user["compte"] =  $conditionverif;
          
    } 

       
     echoResponse(200, $user);
});
 $app->delete('/nomGrpUserPath/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
   
          $rows = $db->delete("groupeutilisateur", array('idgroup'=>$id));
         if($rows["status"]=="success");
            $rows["message"] = "Soumenu surprimé ";
     
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 $app->put('/nomGrpUsermodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idgroup'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('idsousmenu'=>$data->idsousmenu,'idnomgroupe'=>$data->idnomgroup,'actionMenue'=>$data->actionMenue);
        $mandatory = array();
        $user = $db->update("groupeutilisateur",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
       	 $user["message"] = "Groupe modifié.";
       	}else{
       		 $user ;
       	}
         
  			 echoResponse(200, $user);
  
    });
     
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
      
 ?>