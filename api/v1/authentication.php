<?php 
if (!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
        }
  // Creation de session pour l'utilisateur après son authentifaication
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    if(count($session)>0 AND $session['passwordVerifNumber']=='1'){
        $response["uid"] = $session['uid'];
        $response["pseudo"] = $session['pseudo'];
        $response["name"] = $session['name'];
        $response["surname"] = $session['surname'];
        $response["email"] = $session['email'];
        $response["idnomgroup"] = $session['idnomgroup'];
        $response["idagence"] = $session['idagence'];
        $response["idbanque"] = $session['idbanque'];
        $response["droit"] = $session['droit'];
        
    }else if(count($session)>0 AND $session['passwordVerifNumber']=='0'){
                $response["passwordVerifNumber"] =$session["passwordVerifNumber"];
                $response["pseudoVerif"]=$session["pseudoVerif"];
               $response["uidVerif"]=$session["uidVerif"];
    }else{
        return [];
    }
  
    echoResponse(200, $session);
});
// Geston de profil pour 
$app->get('/profil',function(){
      $response = array();
      $condition = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("profil","idprofil,libelle",$condition);
     echoResponse(200, $user);
});

// Recupération des menus auxquels a droit l'utilisateur connecté
$app->get('/leftMenues',function() use ($app){
   if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) {
       $dbleft = new DbHandler();
      $getM= $dbleft-> getLeftMenue();
      if (count($getM)>0) {
         $user["arrayLeft"] = $getM;
        $user=   $getM;
      } else {
        $data = json_decode($app->request->getBody());
        $iduser=$_SESSION['uid'];
        $idprofil=$_SESSION['idnomgroup'];
        $response = array();
         $condition = array();
          require_once 'dbHelper.php';
                  $db = new dbHelper();
                /*  $dataArray = array('etat' => $data->etat);*/
                  $table=array($idprofil,'1');
                  $userConnect=$idprofil;
                  /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
                  $mandatory = array();
                    $user = $db->select3($table,$userConnect);
                   if($user["status"]=="success"){ 
                    $user["message"] = "Menus Chargés.";
                     $dbleft-> setLeftMenue($user);
                      $getM= $dbleft-> getLeftMenue();
                    $user['See']=  $getM;
                     
                        
                      } else {
                          $user['status'] = "error";
                          $user['message'] = 'Aucun Sous menu';
                      }
      
      }
      
     echoResponse(200, $user);
  }

});


/* $db->select("customers_php",array('id'=>171))*
/*$app->get('/contratrecup', function() { 
    $db = new DbHandler();
    $session = $db->getSession();
    echoResponse(200,$session);
});*/
// Banque utilisateur connecté
$app->get('/banqueutilisateur',function(){
      $response = array();
      $condition = array('id'=> $_SESSION['idbanque'],'etat'=>'Actif');
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("banque","id,libelle,etat",$condition);
     echoResponse(200, $user);
});
// Requete pour connecter l'utilisateur
$app->post('/connectUser', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    VerifiactionDesParams(array('pseudo','password'),$r->customer);
    $response = array();
    $db = new DbHandler();
    $password = htmlspecialchars($r->customer->password);
    $pseudo = htmlspecialchars($r->customer->pseudo);
           
               
                  $userVerif = $db->getOneRecord("select uid, pseudo,password,etat from  user_auth where pseudo='$pseudo' AND password ='$password'");
              if ($userVerif != NULL AND $userVerif['password']==="assurance" AND $userVerif['etat'] == 'Actif') {
                        $response=array();
                        $response['passwordVerifNumber']='0';
                        $response['passwordVerif']=$userVerif['password'];
                        $response['pseudoVerif']= $pseudo;
                        $response['uidVerif']= $userVerif['uid'];
                        $_SESSION['pseudoVerif']= $pseudo;
                        $_SESSION['uidVerif']=$userVerif['uid'];
                        $_SESSION['passwordVerifNumber']= $response['passwordVerifNumber'];
                       
               }else{
                 $user = $db->getOneRecord("select distinct au.uid,au.pseudo,au.name,au.surname,au.email,au.sexe,au.password,au.etat,au.lastconnect,au.idnomgroup,au.idbanque,au.idagence,au.droit,nomgrp.chemin,grp.actionMenue,se.libelle as sousmenu,me.libelle as menuUnique 
                  from  nomprofil as nomgrp INNER JOIN user_auth as au  ON au.idnomgroup= nomgrp.idnomgroup INNER JOIN groupeutilisateur as grp ON nomgrp.idnomgroup=grp.idnomgroupe INNER JOIN sousmenus as se ON  nomgrp.chemin = se.nomcourt INNER JOIN menus as me ON me.idmenue=se.idmenu where au.pseudo='$pseudo' AND grp.etat='1'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['password'],$password) AND $user['etat'] == 'Actif' ){
        $response['status'] = "success";
        $response['message'] = 'Vous êtes connecté(e)';
        $response['name'] = $user['name'];
        $response['surname'] = $user['surname'];
        $response['uid'] = $user['uid'];
        $response['email'] = $user['email'];
        $response['pseudo'] = $user['pseudo'];
        $response['etat'] = $user['etat'];
        $response['idnomgroup'] = $user['idnomgroup'];
        $response['idbanque'] = $user['idbanque'];
        $response['idagence'] = $user['idagence'];
        $response['droit'] = $user['droit'];
        $response['chemin'] = $user['chemin'];
        $response['menuUnique'] = $user['menuUnique'];
        $response['sousmenu'] = $user['sousmenu'];
        $response['actionMenue'] = $user['actionMenue'];
         $response['passwordVerifNumber']='1';
        if (!isset($_SESSION)) {
            session_start();
        }/* $_SESSION['email'] = $email;*/
        $_SESSION['uid'] = $user['uid'];
       
        $_SESSION['name'] = $user['name'];
        $_SESSION['etat'] = $user['etat'];             
        $_SESSION['pseudo'] = $user['pseudo'];             
        $_SESSION['idnomgroup'] = $user['idnomgroup'];             
        $_SESSION['idbanque'] = $user['idbanque'];             
        $_SESSION['idagence'] = $user['idagence'];             
        $_SESSION['droit'] = $user['droit'];                       
        $_SESSION['email'] = $user['email'];                       
        $_SESSION['surname'] = $user['surname'];                       
        $_SESSION['passwordVerifNumber'] =  $response['passwordVerifNumber']; 
                      if (isset($_SESSION['uidVerif'])) {
                                    $session = $db->destroySession();
                                  }            
    }  else {
                          $response['status'] = "error";
                          $response['message'] = 'Verifiez votre identifiant ou votre mot de passe. 
                          contactez votre administateur pour avoir plus d\'informations sur l\'etat de votre compte si le problème persiste';
                          $response['userInfo']=$userVerif;
                      }

      } else {
            $response['status'] = "error";
            $response['message'] = 'identifiant ou mot de passe est incorrect';
        }
      }
        echoResponse(200, $response);
});

// Requete pour deconnecter l'utilisateur
$app->put('/logout/:id', function($id) use ($app) {
    $data = json_decode($app->request->getBody());
    $condition = array('uid'=>$id);
    require_once 'dbHelper.php';
    $nouvelleDate=date('Y-m-d-H-i');
    $db = new dbHelper();
    $dataArray = array('lastconnect' => $nouvelleDate);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
      if($user["status"]=="success"){
      $db = new DbHandler(); /*$rows = $db->update("user_auth",array('lastconnect' => $nouvelleDate,'etat'=>'0'),array('uid'=>$_SESSION["uid"]), array('lastconnect','etat'));*/
    $session = $db->destroySession();
     $response["status"] = "info";
    $response["message"] = "Vous êtes deconnecté"; 
     $response["session"] = $session ; 
    $response["user"] = $user; 
    echoResponse(200, $response);
      }
}); 
$app->put('/logoutPassword/:id', function($id) use ($app) {
    $data = json_decode($app->request->getBody());
    $condition = array('uid'=>$id);
    require_once 'dbHelper.php';
    $nouvelleDate=date('Y-m-d-H-i');
    $db = new dbHelper();
    $dataArray = array('lastconnect' => $nouvelleDate);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
      if($user["status"]=="success"){
      $db = new DbHandler(); /*$rows = $db->update("user_auth",array('lastconnect' => $nouvelleDate,'etat'=>'0'),array('uid'=>$_SESSION["uid"]), array('lastconnect','etat'));*/
    $session = $db->destroySession();
     $response["status"] = "info";
    $response["message"] = "Vous êtes deconnecté"; 
    $response["session"] = $session ; 
    $response["user"] = $user; 
    echoResponse(200, $response);
      }
}); 

$app->get('/chemins', function() { 
    global $db;
    $rows = $db->select("table","les champs separés par une virgule",array());
    echoResponse(200, $rows);
});
$app->post('/menus', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array('name');
    global $db;
    $rows = $db->insert("", $data, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Contrat bien renseigné.";
    echoResponse(200, $rows);
});


/* $data1=array();*/
/*$app->get('/impression', function() use ($app){ 
        if(isset($_SESSION['contratImprim']))
    {
        
        $data1= $_SESSION['contratImprim'];
        echoResponse(200, $data1);
      }
});
$app->post('/imprimer', function(){ 
       
});*/

?>