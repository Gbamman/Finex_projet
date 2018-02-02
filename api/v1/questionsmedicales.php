<?php 
if(!isset($_SESSION)) {
            session_start();
            } 
$app->get('/getquetionsmedicales',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("questions_medicales","idm,libelle,tauxsup,etat",array('etat'=>'Actif'));
     echoResponse(200, $user);
});

$app->put('/questionModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idm'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('libelle'=>htmlspecialchars($data->libelle) ,'tauxsup'=>$data->tauxsup,'etat'=>$data->etat);
        $mandatory = array();
       $rows = $db->update("questions_medicales",$dataArray,$condition,$mandatory);
      if($rows["status"]=="success"){
        $rows["message"] = "La Question a été modifiée avec succès.";
      }else{
        $rows;
      }
      echoResponse(200,  $rows);
    });
  $app->post('/questionInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $conditionverif = array('libelle'=>htmlspecialchars($data->libelle));
        $dataArray = array('libelle'=>htmlspecialchars($data->libelle),'tauxsup'=>$data->tauxsup,'etat'=>$data->etat);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("questions_medicales","idm",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("questions_medicales",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "La question a été bien enrégistrée";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Cette question existe deja.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt*/
    });
$app->put('/BanqueStatusUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idm'=>$id);
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

 $app->delete('/deleteQuestions/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $rows = $db->delete("questions_medicales", array('idm'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "Le question a été bien Supprimée!";
     
       echoResponse(200, $rows);
   
});
  $app->post('/AskQuestion',function() use ($app) { 
    $data = json_decode($app->request->getBody());
   /* $string = serialize($app->request->getBody());
*/
//String to array
  /*  $array = unserialize($app->request->getBody());*/
       echoResponse(200,  $data);
  })
 //
 ?>