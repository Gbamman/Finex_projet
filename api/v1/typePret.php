<?php 
if(!isset($_SESSION)) {
            session_start();
            } 

$app->get('/gestiontypePretsAll',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
    $sqlPret="pr.idtypepret,pr.libelle,pr.etat,ban.id,ban.libelle as libelleBanque";
    $sqltable="typepret as pr INNER JOIN banque as ban ON pr.idbanque=ban.id";
     $user = $db->select($sqltable,$sqlPret,array());
      $user["verification"] = "0";
     echoResponse(200, $user);
});
$app->put('/TypeProfilmodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idtypepret'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('libelle'=>$data->libelle,'idbanque'=>$data->idbanque);
        $mandatory = array();
       $rows = $db->update("typepret",$dataArray,$condition,$mandatory);
      if($rows["status"]=="success"){
      	$rows["message"] = "Type modifié.";
      }else{
      	$rows;
      }
       echoResponse(200, $rows);   
    });
$app->put('/TypePretUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idtypepret'=>$id);
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

  $app->post('/SaveTypeProfil',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $conditionverif = array('libelle'=>$data->libelle,'idbanque'=>$data->idbanque);
        $dataArray = array('libelle'=>$data->libelle,'idbanque'=>$data->idbanque);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("typepret","idtypepret,idbanque",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("typepret",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Type de prêt enrégistré";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Ce type de prêt existe deja.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt*/
    });

 $app->delete('/DeleteTypePretPath/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $rows = $db->delete("typepret", array('idtypepret'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "Type de prêt Supprimer!";
     
       echoResponse(200, $rows);
   
});

 ?>