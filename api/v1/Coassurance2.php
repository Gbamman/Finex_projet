<?php
 session_start();
require '.././libs/Slim/Slim.php';
require_once 'config.php';
require_once 'dbHelper.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();
 global $db;
 //Liste des Co-assureurs
$app->get('/gestionCoassurance',function(){
      $response = array();
      $condition = array();//'etat'=>'Actif'
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("coassureur","idcoass,nomcoassureur,logo,part,etat",$condition);
     echoResponse(200, $user);
});


// Liste des banques actives
$app->get('/banquemodif/:id',function($id) use ($app) { 
    $condition = array('id'=> $id,'etat'=>'Actif');
     global $db;
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
    
});
// Changement de statut des Coass en 'Actif' ou 'Inactif'
$app->put('/CoassureurUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcoass'=>$id);
    if(isset($data->etat)){
    global $db;
    $dataArray = array('etat' => $data->etat);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le status a été correctement modifié.";
    }
    echoResponse(200, $user);
});

// Udpdate des infos Coass
$app->put('/CoassuranceModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcoass'=>$id);
    global $db;
    $libelle=htmlspecialchars($data->nomcoassureur);
         $dataArray = array('nomcoassureur'=>$libelle,'part'=>$data->part,'logo'=>$data->logo);
        $mandatory = array();
        $user = $db->update("coassureur",$dataArray,$condition,$mandatory);
       if($user["status"]=="success");
       
          $user["message"] = "Banque modifiée.";
          $files ='../../typepretFolder/imagecoassureur/'.$data->oldpicturepath;
          unlink($files); // delete file
         echoResponse(200, $user);
  
    });
// Insertion des infos Coass
  $app->post('/CoassuranceInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->nomcoassureur);
      $conditionverif = array('noncoassureur'=> $libelle,'part'=>$data->part);
        $dataArray = array('nomcoassureur'=>$libelle,'part'=>$data->part,'etat'=>$data->etat,'logo'=>$data->logo);
        global $db;
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("coassureur","idcoass",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("coassureur",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Co-assureur enrégistrée";
        /* $user["Banque"] = $_FILES[$data->myFile]['name'];*/
         $user["compte"] = $conditionverif;
    }else{

            $user["status"]="error";
            $user["message"] = "Désolé ce Co-assureur existe deja.";
            $user["compte"] =  $conditionverif;
           /* $user["Banque"] = $_FILES['file']['name'];*/
          
    } 
    echoResponse(200, $user);/*,$data->myFile 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });

// Suppression des infos Coass
$app->post('/DeleteCoassureurPath', function() use ($app){ 
  $data = json_decode($app->request->getBody());
    global $db;
          $rows = $db->delete("coassureur", array('idcoass'=>$data->idcoass));
         if($rows["status"]=="success");
            $rows["message"] = "Type prêt surprimée";
            $files ='../../typepretFolder/imagecoassureur/'.$data->logo;
          unlink($files); // delete file
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});

 


function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response,JSON_NUMERIC_CHECK);
}

$app->run();
?>