<?php 
      if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 

$app->get('/gestionnomgroupeutilisateur',function(){
      $response = array();
      $condition = array();
       $order ='ORDER BY idnomgroup';
      require_once 'dbHelper.php';
       $db = new dbHelper();
     $user = $db->select2("nomprofil","idnomgroup,libelle,chemin",$condition,$order);
     /*$user = $db->select9();*/
    /*  $user["verification"] = "1";*/
     echoResponse(200, $user);
});
$app->get('/gestionsousMenueCheck/:id',function($id) use ($app){
      $response = array();
       $condition = array($id);
       $order ='ORDER BY idnomgroup';
      require_once 'dbHelper.php';
       $db = new dbHelper();
    /* $user = $db->select2("nomprofil","idnomgroup,libelle",$condition,$order);*/
     $user = $db->select9($condition);
      /*$user["verification"] = "1";*/
     echoResponse(200, $user);
});
$app->get('/gestionsousMenusAdim/:id',function($id) use ($app){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $condition = array($id);
     $user = $db->select10($condition);
       /*$user["verification"] = "1";*/
     echoResponse(200, $user);
});
$app->put('/AffectationEtat/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idgroup'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('etat'=> $data->etat);
        $mandatory = array();
        $user = $db->update("groupeutilisateur",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
         $user["message"] = "Profil modifié.";
       }else{
        $user;
       }
         
         echoResponse(200, $user);
  
    });
$app->put('/AffectationDroit/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idgroup'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('actionMenue'=> $data->actionMenue);
        $mandatory = array();
        $user = $db->update("groupeutilisateur",$dataArray,$condition,$mandatory);
       if($user["status"]=="success");
       
          $user["message"] = "Droit modifié.";
          $user["Droit"] = $data;
         echoResponse(200, $user);
  
    });
$app->put('/nomgrpmodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idnomgroup'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
    $libelle=htmlspecialchars($data->libelle);
    $chemin='dashbord';
         $dataArray = array('libelle'=>$libelle,'chemin'=>$chemin);
        $mandatory = array();
        $user = $db->update("nomprofil",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
         $user["message"] = "Groupe modifié.";
       }else{
        /*$user;*/
       }
         
  			 echoResponse(200, $user);
  
    });
  $app->post('/nomgrpInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->libelle);
       $chemin='dashbord';
      $conditionverif = array('libelle'=> $libelle);
           $dataArray = array('libelle'=>$libelle,'chemin'=>$chemin);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("nomprofil","idnomgroup",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("nomprofil",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Groupe enrégistré";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Désolé ce groupe existe deja.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });
	  $app->delete('/nomGrpSupprPath/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows1 = $db->delete("nomprofil", array('idnomgroup'=>$id));
    if($rows1["status"]=="success"){
      $conditionverif = array('idnomgroupe'=>$id);
      $sousmenusverif = $db->select("groupeutilisateur","idnomgroupe",$conditionverif);
      if ($sousmenusverif["status"]!="success") {
          $rows=array();
           $rows["status"]="success";
            $rows["message"] = "Nom de groupe surprimé";
      }else{
          $rows = $db->delete("groupeutilisateur", array('idnomgroupe'=>$id));
          $rows["status"]="success";
            $rows["message"] = "Soumenu surprimé";
      }
       echoResponse(200, $rows);
    }
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 ?>