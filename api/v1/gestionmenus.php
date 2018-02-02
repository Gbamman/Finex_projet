<?php 
if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 
$app->get('/gestionmenus',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("menus","idmenue,libelle,icon",array());
      $user["verification"] = "0";
     echoResponse(200, $user);
});

$app->put('/menusmodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idmenue'=>$id);
    require_once 'dbHelper.php';/*, 'icon' => $data->icon*/
    $db = new dbHelper();
         $dataArray = array('libelle'=>$data->libelle,'icon'=>$data->icon);
        $mandatory = array();
       $rows = $db->update("menus",$dataArray,$condition,$mandatory);
      if($rows["status"]=="success"){
        $rows["message"] = "Menu modifié.";
      }else{
        $rows;
      }
      echoResponse(200,  $rows);
    });
  $app->post('/menusInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY libelle LIMIT 1';
      $conditionverif = array('libelle'=>$data->libelle);
        $dataArray = array('libelle'=>$data->libelle,'icon'=>$data->icon);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("menus","idmenue",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("menus",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Menu enrégistré";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Ce menu existe deja.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt*/
    });

 $app->delete('/clear_in_menus/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $rows = $db->delete("menus", array('idmenue'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "Menus Supprimer!";
     
       echoResponse(200, $rows);
   
});
 ?>