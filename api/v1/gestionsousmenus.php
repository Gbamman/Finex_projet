<?php 
if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 

$app->get('/gestionMenueVideos',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
    // $array ='me.idmenue as idmenu, se.idsousmenu, se.nomcourt';
    // $table1='menus as me INNER JOIN sousmenus as se ON me.idmenue=se.idmenu';
    $ON=array('idmenu' => 20);
     $videos = $db->select('sousmenus','nomcourt',$ON);
   
     echoResponse(200, $videos);
});
$app->get('/gestionsousMenue',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
    $array ='me.idmenue as idmenu,me.libelle as allsousmenus, me.icon as icones, se.idsousmenu, se.nomcourt,se.libelle as libelleSousMenue';
    $table1='menus as me';
    $table2='sousmenus as se';
    $ON='ON me.idmenue=se.idmenu';
     $user = $db->select5($array,$table1,$table2,$ON);
       $user["verification"] = "1";
     echoResponse(200, $user);
});
  $app->put('/sousmenusmodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idsousmenu'=>$id);
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $dataArray = array('idmenu'=>$data->idmenu,'libelle'=>$data->libelleSousMenue,'nomcourt'=> $data->nomcourt);
     $mandatory = array();
      $user = $db->update("sousmenus",$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Sous menue modifié.";
    });
  $app->post('/sousmenusInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $conditionverif = array('libelle'=>$data->libelleSousMenue);
     $dataArray = array('idmenu'=>$data->idmenu,'libelle'=>$data->libelleSousMenue,'nomcourt' => $data->nomcourt);
    $condition = array();
     $order ='ORDER BY libelle LIMIT 1';
    require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
     $user1 = $db->select2("sousmenus","idsousmenu",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
              $user = $db->insert("sousmenus",$dataArray,$condition,$mandatory);
              $user["status"]="success";
              $user["message"] = "Soumenu enrégistré";
    }else{
            $user["status"]="error";
            $user["message"] = "Ce sousmenu existe deja.";
    } 
    echoResponse(200, $user);
   
    });
  $app->delete('/effacersousmenus/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows1 = $db->delete("sousmenus", array('idsousmenu'=>$id));
    if($rows1["status"]=="success"){
      $conditionverif = array('idsousmenu'=>$id);
      $sousmenusverif = $db->select("groupeutilisateur","idsousmenu",$conditionverif);
      if ($sousmenusverif["status"]!="success") {
          $rows=array();
           $rows["status"]="success";
            $rows["message"] = "Soumenu surprimer seulement dans la table sousmenus";
      }else{
          $rows = $db->delete("groupeutilisateur", array('idsousmenu'=>$id));
          $rows["status"]="success";
            $rows["message"] = "Soumenu surprimer dans la table sousmenus et dans la table groupeutilisateur";
      }
       echoResponse(200, $rows);
    }
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});
 ?>