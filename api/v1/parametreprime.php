<?php 
if(!isset($_SESSION)) {
            session_start();
            } 

$app->get('/gestionParametrePrime',function(){
      require_once 'dbHelper.php';
    $db = new dbHelper();
  $sqlPret="param.idparam,param.fraisgestion,param.fraisacquisition,param.capitalmax,param.tauxprime,param.accessoires,param.primeplanchet,param.agemaxi,param.tauxperteemploi,param.agemini,param.commission,param.quotepartaccessoires,param.fraisaperition,ban.id,ban.libelle as libelleBanque,typr.idtypepret,typr.libelle as type_de_pret";
    $sqltable="parametres  as param INNER JOIN banque as ban ON param.idbanque=ban.id INNER JOIN typepret as typr ON param.idtypepret=typr.idtypepret";
     $user = $db->select($sqltable,$sqlPret,array());
     
     echoResponse(200, $user);
});
$app->get('/gestiontypepret',function(){
      require_once 'dbHelper.php';
      $condition = array('etat'=>0);
    $db = new dbHelper();
     $user = $db->select("typepret","idtypepret,libelle,idbanque,etat",$condition);
      
     echoResponse(200, $user);
});
$app->put('/paramprimemodif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idparam'=>$id);
    $date=date('Y-m-d H:i:s');
    require_once 'dbHelper.php';/*, 'icon' => $data->icon commission*/
    $db = new dbHelper();
          $dataArray = array('idbanque'=>$data->idbanque,'fraisgestion'=>$data->fraisgestion,'agemaxi'=>$data->agemaxi,'agemini'=>$data->agemini,'fraisacquisition'=>$data->fraisacquisition,'capitalmax'=>$data->capitalmax,'idtypepret'=>$data->idtypepret,'tauxprime'=>$data->tauxprime,'commission'=>$data->commission,'quotepartaccessoires'=>$data->quotepartaccessoires,'fraisaperition'=>$data->fraisaperition,'tauxperteemploi'=>$data->tauxperteemploi,'accessoires'=>$data->accessoires,'primeplanchet'=>$data->primeplanchet,'date'=> $date);
        $mandatory = array();
       $rows = $db->update("parametres",$dataArray,$condition,$mandatory);
      if($rows["status"]=="success"){
      	$rows["message"] = "Parametre Prime modifié.";
      }else{
      	$rows;
      }
         echoResponse(200,$rows);  
    });


  $app->post('/paramprimeInsert',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $order ='ORDER BY idparam LIMIT 1';
       $date=date('Y-m-d H:i:s'); 
      $conditionverif = array('idbanque'=>$data->idbanque,'fraisgestion'=>$data->fraisgestion,'fraisacquisition'=>$data->fraisacquisition,'capitalmax'=>$data->capitalmax,'idtypepret'=>$data->idtypepret,'tauxprime'=>$data->tauxprime,'accessoires'=>$data->accessoires,'primeplanchet'=>$data->primeplanchet);
           $dataArray = array('idbanque'=>$data->idbanque,'fraisgestion'=>$data->fraisgestion,'agemaxi'=>$data->agemaxi,'agemini'=>$data->agemini,'fraisacquisition'=>$data->fraisacquisition,'capitalmax'=>$data->capitalmax,'idtypepret'=>$data->idtypepret,'tauxprime'=>$data->tauxprime,'commission'=>$data->commission,'quotepartaccessoires'=>$data->quotepartaccessoires,'fraisaperition'=>$data->fraisaperition,'tauxperteemploi'=>$data->tauxperteemploi,'accessoires'=>$data->accessoires,'primeplanchet'=>$data->primeplanchet,'date'=> $date);
        require_once 'dbHelper.php';
    $db = new dbHelper();
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
       $user1 = $db->select2("parametres","idtypepret,idbanque",$conditionverif,$order);
    if ($user1["status"]!="success") {
       $mandatory = array();
        $condition = array();
      $user = $db->insert("parametres",$dataArray,$condition,$mandatory);
         $user["status"]="success";
         $user["message"] = "Parametre Prime enrégistré";
         $user["compte"] = $conditionverif;
    }else{
            $user["status"]="error";
            $user["message"] = "Ce Parametre a été déja prise en compte.";
            $user["compte"] =  $conditionverif;
          
    } 
    echoResponse(200, $user);/*, 'nomcourt' => $data->nomcourt*/
    });

 $app->delete('/DeleteParamePrimePath/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $rows = $db->delete("parametres", array('idparam'=>$id));
    if($rows["status"]=="success")
            $rows["message"] = "Type de prêt Supprimé!";
     
       echoResponse(200, $rows);
   
});

 ?>