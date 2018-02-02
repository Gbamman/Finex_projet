<?php 
            if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 

$app->get('/nomgroupeutilisateurProfil',function(){
      $response = array();
      $condition = array();
       $order ='AND (idnomgroup >17) ORDER BY idnomgroup';
      require_once 'dbHelper.php';
       $db = new dbHelper();
     $user = $db->select2("nomprofil","idnomgroup,libelle",$condition,$order);
     /*$user = $db->select9();*/
     /* $user["verification"] = "1";*/
     echoResponse(200, $user);
});
$app->get('/gestionutilisteur',function(){
      $response = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
    $order='ORDER BY name';
     $user = $db->select2("user_auth","uid,pseudo,name,surname,sexe,phone,fonction,email,
      etat,idnomgroup,idbanque,idagence,droit",array(),$order);
    echoResponse(200, $user);
});

$app->get('/getCountUsers',function(){
      $response = array();
      require_once 'dbHelper.php';
    $db = new dbHelper();
     $user = $db->select("user_auth","COUNT(uid) AS NombreUtilisateurs",array());
    echoResponse(200, $user);
});

     $app->post('/newcount', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    VerifiactionDesParams(array('pseudo','name','surname','sexe','phone', 'fonction', 'email'), $r->customer);
    $db = new DbHandler();
    $pseudo = htmlspecialchars($r->customer->pseudo);
    $name = htmlspecialchars($r->customer->name);
    $surname = htmlspecialchars($r->customer->surname);
    $sexe = htmlspecialchars($r->customer->sexe);
    $phone = htmlspecialchars($r->customer->phone);
    $fonction = htmlspecialchars($r->customer->fonction);
    $email = htmlspecialchars($r->customer->email);
   /* $password = htmlspecialchars($r->customer->password);*/
    $idbanque = htmlspecialchars($r->customer->idbanque);
    $idagence = htmlspecialchars($r->customer->idagence);
    $droit = htmlspecialchars($r->customer->droit);
    /*$action = htmlspecialchars($r->customer->action);*/
     $r->customer->lastconnect = date('Y-m-d-H-i');
    $isUserExists = $db->getOneRecord("select 1 from user_auth where pseudo='$pseudo'");
    if(!$isUserExists){
        require_once 'passwordHash.php';
       /* $r->customer->password = passwordHash::hash($password);*/
       $r->customer->password = "assurance";
        $tabble_name = "user_auth";
        $column_names = array('pseudo','name', 'surname','sexe','phone', 'fonction', 'email', 'password','etat','lastconnect','idnomgroup','idbanque','idagence','droit');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Le compte a été crée avec succes. Et votre mot de passe par defaut est assurance";
            $response["data"] = $result;
            echoResponse(200, $response);

        } else {
            $response["status"] = "error";
            $response["message"] = "La creation du compte a échoué. Veuillez reéssayer";
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "l'utilistateur d'où provient cet identifiant existe dejà";
        echoResponse(201, $response);
    }
});


    $app->delete('/effacerusers/:id', function($id) { 
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $rows1 = $db->delete("user_auth", array('uid'=>$id));
    if($rows1["status"]=="success"){
      $conditionverif = array('iduser'=>$id);
      $sousmenusverif = $db->select("groupeutilisateur","iduser",$conditionverif);
      if ($sousmenusverif["status"]!="success") {
          $rows=array();
           $rows["status"]="success";
            $rows["message"] = "Utilisateur supprimé";
      }else{
          $rows = $db->delete("groupeutilisateur", array('iduser'=>$id));
          $rows["status"]="success";
            $rows["message"] = "Utilisateur supprimé";
      }
       echoResponse(200, $rows);
    }else{
      echoResponse(200, $rows1);
    }
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    
});

    $app->put('/ModificationUsures/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('uid'=>$id);
    if(isset($data->name)){
      $pseudo = htmlspecialchars($data->pseudo);
      $name = htmlspecialchars($data->name);
        require_once 'dbHelper.php';
        $db = new dbHelper();
        $conditionverifUser= array('pseudo'=>$pseudo);
        $order=' and uid!='.$id;
       $isUserExists = $db->select2("user_auth","COUNT(uid) AS nbpseudo",$conditionverifUser,$order);
    if($isUserExists['data'][0]['nbpseudo']==0){ 
     $dataArray = array('pseudo'=>$data->pseudo, 'name' => $data->name,'surname' => $data->surname,'sexe' => $data->sexe,'fonction' => $data->fonction,'phone' => $data->phone,
      'idnomgroup'=>$data->idnomgroup,'idbanque'=>$data->idbanque,'idagence'=>$data->idagence,'droit'=>$data->droit);
    $mandatory = array();
      
      $user = $db->update("user_auth",$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Les informations ont été correctement modifiées.";
        $user["number"] =  $isUserExists['data'][0]['nbpseudo'];
   
   } else{
         $user["status"] = "error";
         $user["data"] = $isUserExists;
        $user["message"] = "Desole, Un utilisateur a déjà cet identifiant. Veuillez choisir un autre.";
        $user["number"] =  $isUserExists['data'][0]['nbpseudo'];
        
        }
   }else{
     /*require_once 'dbHelper.php';
    $db = new dbHelper();
      $mandatory = array();
     $user = $db->update("user_auth",$data,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le status de l'utilisateur a été correctement modifié.";*/
   }

   /* update("customers_php",array('name' => 'Ipsita Sahoo', 'email'=>'email'),array('id'=>'170'), array('name', 'email'));*/

   
    echoResponse(200, $user);
});   

   $app->put('/StatutUserUpdate/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('uid'=>$id);
    if(isset($data->etat)){
    require_once 'dbHelper.php';
    $db = new dbHelper();
    $dataArray = array('etat' => $data->etat);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le status de l'utilisateur a été correctement modifié.";

    }
    echoResponse(200, $user);
});     

 $app->put('/passwordModif/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    
    if ($data->password=="assurance") {
        $user["status"]="error";
        $user["message"] = "Vous ne pouvez utiliser ce mot de passe.";
    } else {
          $condition = array('uid'=>$id);
          require_once 'dbHelper.php';
          $db = new dbHelper();
          $data->password = passwordHash::hash($data->password);
          $dataArray = array('password'=>$data->password);
          $mandatory = array();
          $user = $db->update("user_auth",$dataArray,$condition,$mandatory);
              if($user["status"]=="success")
                    $user["message"] = "Le mot de passe a été correctement modifié.";
                    $db = new DbHandler(); 
                    $session = $db->destroySession();
     }
          echoResponse(200, $user);
    });

 $app->put('/mdpmodifpath/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('uid'=>$id);
      require_once 'dbHelper.php';
    $db = new dbHelper();
    $data->password = 'assurance';
    $dataArray = array('password'=>$data->password);
    $mandatory = array();
      $user = $db->update("user_auth",$dataArray,$condition,$mandatory);
        if( $user['status']=='success'){
          $user['status']='success';
         $user["message"] = "Le mot de passe a été  réenitialisé. Le nouveau mot de passe est : ".$data->password;
          
        }else{
           $user["message"] = "Ce mot de passe a été déjà réenitialisé. Le nouveau mot de passe est : ".$data->password;
        }
        $db = new DbHandler();
      echoResponse(200, $user);
    });
// Requete pour enrégistrer les enregistrement les modifications éffectué par l'utilisateur
      
        $app->post('/ActionmenePath', function() use ($app) {
        $r = json_decode($app->request->getBody());
        $actionMene=$r->Actionmene;
        $date=date('Y-m-d-H-i-s');
        $iduser=$_SESSION['uid'];
        require_once 'dbHelper.php';
        $db = new dbHelper();
        $dataArray = array('iduser'=>$iduser,'action_mene'=>$actionMene,'created'=>$date);
       $mandatory = array();
        $condition = array();
      $actionMeneInsert = $db->insert("user_action",$dataArray,$condition,$mandatory);
      // 1 : on ouvre le fichier
        $monfichier = fopen('../../Utilisateur/vue/compteur.txt', 'a+');
        fseek($monfichier, 0); // On remet le curseur au début du fichier
        fputs($monfichier,  $iduser.'@@'.$actionMene.'@@'.$date);
 
        // 2 : on lit la première ligne du fichier
            $ligne = fgets($monfichier);
          $actionMeneInsert['ligne']= $ligne;
    // 3 : quand on a fini de l'utiliser, on ferme le fichier
        fclose($monfichier);
          echoResponse(200, $actionMeneInsert);
      })
 ?>