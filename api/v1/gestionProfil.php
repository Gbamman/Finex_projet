<?php 
      if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 
$app->get('/Get_gestionProfil',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select8();
      $user["verification"] = "2"; 
     echoResponse(200, $user);
});
    $app->get('/GetAll_UserGroup',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array();
      $user = $db->select("nomprofil","idnomgroup,libelle",$condition);
       $user["verification"] = "2";
     echoResponse(200, $user);
});
$app->put('/profilmodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idprofil'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
    $libelle=htmlspecialchars($data->libelleProfil);
    $chemin=htmlspecialchars($data->chemin);
         $dataArray = array('idnomgroup'=>$data->idnomgroup,'libelle'=>$libelle,'chemin'=>$chemin);
        $mandatory = array();
        $user = $db->update("profil",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
        $user["status"]="success";
         $user["message"] = "Profil modifié.";
       }else{
             $user;
             $user["monde"] = $data;
       }
         
  			 echoResponse(200, $user);
  
    });
  $app->post('/profilInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->libelleProfil);
      $chemin=htmlspecialchars($data->chemin);
      $conditionverif = array('libelle'=> $libelle,'chemin'=>$chemin);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("profil","libelle",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $dataArray = array('idnomgroup'=>$data->idnomgroup,'libelle'=>$libelle,'chemin'=>$chemin);
       $mandatory = array();
        $condition = array();
      $user = $db->insert("profil",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Profil enrégistré";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Désolé ce profil existe deja.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });
	  $app->delete('/delectProfil/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows = $db->delete("profil", array('idprofil'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "Profil Supprimer!";
     
       echoResponse(200, $rows);
   
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 ?>