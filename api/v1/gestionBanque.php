<?php
$app->get('/gestionbanqueActif',function(){
      $response = array();
      $condition = array('etat'=>'Actif');
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat,logo",$condition);
     echoResponse(200, $user);
});
$app->get('/gestionbanque',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat,logo",$condition);
     echoResponse(200, $user);
});

$app->get('/gestionBanqueAdmin',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat,logo",$condition);
     echoResponse(200, $user);
});


$app->get('/banquemodif/:id',function($id) use ($app) { 
    $condition = array('id'=> $id,'etat'=>'Actif');
     require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
    
});
$app->put('/banqueUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
   /* $files = glob('path/to/temp/*'); // get all file names oldpicturepath
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}*/

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

$app->put('/banqueModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('id'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
    $libelle=htmlspecialchars($data->libelle);
         $dataArray = array('libelle'=>$libelle,'logo'=>$data->logo);
        $mandatory = array();
        $user = $db->update("banque",$dataArray,$condition,$mandatory);
       if($user["status"]=="success"){
          $user["message"] = "Banque modifiée.";
            if($data->logo !=$data->oldpicturepath){
          $files ='../../Banque/imagesBanque/'.$data->oldpicturepath;
          unlink($files); // delete file
            }
        }else{
           $user;
        }
         echoResponse(200, $user);
  
    });
  $app->post('/banqueInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $libelle=htmlspecialchars($data->libelle);
      $conditionverif = array('libelle'=> $libelle);
        $dataArray = array('libelle'=>$libelle,'etat'=>$data->etat,'logo'=>$data->logo);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("banque","id",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("banque",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Banque enrégistrée";
        /* $user["Banque"] = $_FILES[$data->myFile]['name'];*/
         $user["compte"] = $conditionverif;
    }else{

            $user["status"]="error";
            $user["message"] = "Désolé cette banque existe deja.";
            $user["compte"] =  $conditionverif;
           /* $user["Banque"] = $_FILES['file']['name'];*/
          
    } 
    echoResponse(200, $user);/*,$data->myFile 'nomcourt' => $data->nomcourt nomGrpSuppr*/
    });





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
    
});

$app->post('/effacerbanque', function() use ($app){ 
  $data = json_decode($app->request->getBody());
    require_once 'dbHelper.php';
    $db = new dbHelper();
          $rows = $db->delete("banque", array('id'=>$data->id));
         if($rows["status"]=="success");
            $rows["message"] = "Banque surprimée";
            $files ='../../Banque/imagesBanque/'.$data->logo;
          unlink($files); // delete file
       echoResponse(200, $rows);
    
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});

 ?>