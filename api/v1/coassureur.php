<?php
$app->get('/gestionCoassurance',function(){
      $response = array();
      $condition = array();//'etat'=>'Actif'
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("coassureur","idcoass,nomcoassureur,logo,part,estAperiteur,etat",$condition);
     echoResponse(200, $user);
});
$app->get('/gestionCoassuranceActif',function(){
      $response = array();
      $condition = array('etat'=>'0');//'etat'=>'Actif'
      require_once 'dbHelper.php';
    $db = new dbHelper();
    $order='ORDER BY nomcoassureur';
     $user = $db->select2("coassureur","idcoass,nomcoassureur,logo,part,estAperiteur,etat",$condition,$order);
     echoResponse(200, $user);
});



$app->get('/banquemodif/:id',function($id) use ($app) { 
    $condition = array('id'=> $id,'etat'=>'Actif');
     require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
    
});
$app->put('/CoassureurUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcoass'=>$id);
    if(isset($data->etat)){
    require_once 'dbHelper.php';
    $db = new dbHelper();
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

$app->put('/CoassuranceModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcoass'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
    $libelle=htmlspecialchars($data->nomcoassureur);
         $dataArray = array('nomcoassureur'=>$libelle,'part'=>$data->part,'estAperiteur'=>$data->estAperiteur,'logo'=>$data->logo);
        $mandatory = array();
        $user = $db->update("coassureur",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
         $user["message"] = "Les informations sur l'assureur ont été modifiées avec succès.";
          if($data->logo != $data->oldpicturepath){
          $files ='../../typepretFolder/imagecoassureur/'.$data->oldpicturepath;
          unlink($files); // delete file
        }
      }else{
        $user;
      }
         
         echoResponse(200, $user);
  
    });
  $app->post('/CoassuranceInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->nomcoassureur);
      $conditionverif = array('noncoassureur'=> $libelle,'part'=>$data->part);
        $dataArray = array('nomcoassureur'=>$libelle,'part'=>$data->part,'estAperiteur'=>$data->estAperiteur,'etat'=>$data->etat,'logo'=>$data->logo);
        require_once 'dbHelper.php';
    $db = new dbHelper();
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
            $user["message"] = "Désolé cet assureur existe déjà.";
            $user["compte"] =  $conditionverif;
           /* $user["Banque"] = $_FILES['file']['name'];*/
          
    } 
    echoResponse(200, $user);/*,$data->myFile 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });




/*
$app->get('/agence/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idbanque'=>$id);
    require_once 'dbHelper.php';
    $db = new dbHelper();
      $mandatory = array();
      $order ='order by idagence';
       $user = $db->select2('agence', 'idagence,libelle', $condition, $order);
        echoResponse(200, $user);
    
});
$app->get('/typepret/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idbanque'=>$id);
    require_once 'dbHelper.php';
    $db = new dbHelper();
      $mandatory = array();
      $order ='order by idbanque';
       $user = $db->select2('typepret', 'idtypepret,idbanque,libelle,etat', $condition, $order);
        echoResponse(200, $user);
    
});*/

$app->post('/DeleteCoassureurPath', function() use ($app){ 
  $data = json_decode($app->request->getBody());
    require_once 'dbHelper.php';
    $db = new dbHelper();
          $rows = $db->delete("coassureur", array('idcoass'=>$data->idcoass));
         if($rows["status"]=="success");
            $rows["message"] = "Type prêt surprimée";
            $files ='../../typepretFolder/imagecoassureur/'.$data->logo;
          unlink($files); // delete file
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});

 ?>

 