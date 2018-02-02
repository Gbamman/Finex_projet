<?php 
$app->get('/gestionBanqueAdmin',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
});

$app->get('/gestionBanqueAdminActif',function(){
      $response = array();
      $condition = array('etat'=>'Actif');
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
});


$app->get('/getAgenceBanque',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $agence = $db->select("agence","idagence,idbanque,libelle,ville",$condition);
     echoResponse(200, $agence);
});

$app->get('/gestionbanque1',function(){
      require_once 'dbHelper.php';
        $db = new dbHelper();
       $array ='ban.id as idbanque,ban.libelle as liblleBanque,ban.etat, agen.idagence, agen.libelle as libelleagence,agen.ville';
    $table1='banque as ban';
    $table2='agence as agen';
    $ON='ON ban.id=agen.idbanque WHERE etat="Actif"';
     $user = $db->select5($array,$table1,$table2,$ON);
       $user["verification"] = "1";
     echoResponse(200, $user);
  /*  $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",array());
     echoResponse(200, $user);*/
});
$app->post('/agenceInsert',function() use ($app){
	 $data = json_decode($app->request->getBody());
      require_once 'dbHelper.php';
    $db = new dbHelper();
      $order ='ORDER BY idagence LIMIT 1';
     $response = array();
      $condition = array();
       $mandatory = array();
       $conditionverif = array('idbanque'=>$data->id,'libelle'=>$data->libelleagence,'ville'=>$data->ville);
      $dataArray = array('idbanque'=>$data->id,'libelle'=>$data->libelleagence,'ville'=>$data->ville);
 $user1 = $db->select2("agence","idagence",$conditionverif,$order);
    if ($user1["status"]!="success") {
      $user = $db->insert("agence",$dataArray,$condition,$mandatory);
        if( $user["status"]=="success")
         $user["status"]="success";
         $user["message"] = "Agence enrégistrée";
          $user["compte"] = $data ;
    }else{
            $user["status"]="error";
            $user["message"] = "Désolé cette agence est déjà liée à cette Banque.";
            $user["compte"] =  $conditionverif;
          
    } 

       
     echoResponse(200, $user);
});
 $app->delete('/nomGrpUserPath/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
   
          $rows = $db->delete("agence", array('idagence'=>$id));
         if($rows["status"]=="success");
            $rows["message"] = "Agence surprimer";
     
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 $app->put('/agenceModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idagence'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('idbanque'=>$data->id,'libelle'=>$data->libelleagence,'ville'=>$data->ville);
        $mandatory = array();
        $user = $db->update("agence",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
        $user["status"]="success";
       	 $user["message"] = "Agence modifiée.";
       	}else{
       		 $user ;
       	}
         
  			 echoResponse(200, $user);
  
    });
 $app->post('/effacerAgence', function() use ($app){ 
  $data = json_decode($app->request->getBody());
    require_once 'dbHelper.php';
    $db = new dbHelper();
          $rows = $db->delete("agence", array('idagence'=>$data->idagence));
         if($rows["status"]=="success");
            $rows["message"] = "Agence surprimée";
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});

 ?>