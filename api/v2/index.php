<?php
 session_start();
require '.././libs/Slim/Slim.php';
require_once 'config.php';
require_once 'dbHelper.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();


/**
 * Database Helper Function templates
 */
/*
select(table name, where clause as associative array)
insert(table name, data as associative array, mandatory column names as array)
update(table name, column names as associative array, where clause as associative array, required columns as array)
delete(table name, where clause as array)
$scope.primetotale=result.Primetotale
                            $scope.primedeces=result.Primedeces
                            $scope.primePE=result.PrimetPE
                            $scope.Accessoires=result.Accessoires
*/


// Products synchronisation numcontratauto
$app->get('/numcontratauto', function() use ($app){ 
    $condition = array();
            global $db;
            $numcontrat = $db->select("synchronisationnum","contratnum",$condition);
            echoResponse(200,$numcontrat);
});
/*SELECT 
FROM contrat
WHERE 
;*/
//Requete pour recuperer la liste des  contrats regroupés par mois
$app->get('/getCountdashbord', function() use ($app) { 
$order='AND year(dateeffet)=YEAR(curdate()) GROUP BY month(dateeffet)';
 global $db;
            $listedashbord = $db->select2("contrat","COUNT(idcontrat) as nombreDeContratParmois,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200,$listedashbord);
});
//Requete pour recuperer la liste des contrats en proposition
$app->get('/getCountContrat/:id', function($id) use ($app) { 
$order="AND year(dateeffet)=YEAR(curdate()) AND niveau=".$id." GROUP BY month(dateeffet)";
 global $db;
                      
            $listeproposition = $db->select2("contrat","COUNT(idcontrat) as nombreDeContratParmois,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200, $listeproposition);
});


// Requete pour recuperer la liste des contrats en fonction du niveau de traitament
$app->get('/getLevelContratsYear', function() use ($app) { 
//$order='AND year(dateeffet)=YEAR(curdate()) GROUP BY niveau';
$order='AND year(dateeffet)=YEAR(curdate()) GROUP BY month(dateeffet)';
 global $db;
            $listedashbord = $db->select2("contrat","capital,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200,$listedashbord);
});
// Requete pour calculer le total des primes et de celui de la prime Assurance
$app->get('/getCapitauxContratYear', function() use ($app) { 
//$order='AND year(dateeffet)=YEAR(curdate())';
    $order='AND year(dateeffet)=YEAR(curdate()) GROUP BY month(dateeffet)';
 global $db;
            $listedashbord = $db->select2("contrat","SUM(primeassurance) as capitalCalcule,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200,$listedashbord);
});
$app->get('/getPrimesContratYear', function() use ($app) { 
//$order='AND year(dateeffet)=YEAR(curdate())';
    $order='AND year(dateeffet)=YEAR(curdate()) GROUP BY month(dateeffet)';
 global $db;
            $listedashbord = $db->select2("contrat","SUM(capital) as capitalCalcule,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200,$listedashbord);
});

$app->get('/getAgregatYear', function() use ($app) { 
//$order='AND year(dateeffet)=YEAR(curdate())';
    $order='AND year(dateeffet)=YEAR(curdate())';
 global $db;
            $sql='SUM(co.capital) as capitalTotale,SUM(co.primeassurance) as totaleprimeassurance,COUNT(co.idcontrat) as nombretotaledecontrat';
            $table='contrat as co';    
            $listedashbord = $db->select2($table,$sql,array(),$order);
            echoResponse(200,$listedashbord);
});

// Requete pour calculer le total des capitaux et de celui de la prime Assurance
$app->get('/getAgregatContratYear', function() use ($app) { 
//$order='AND year(dateeffet)=YEAR(curdate())';
    $order='AND year(dateeffet)=YEAR(curdate()) GROUP BY month(dateeffet)';
 global $db;
            $listedashbord = $db->select2("contrat","primeassurance as primeassurance_year,month(dateeffet) as moisProduction",array(),$order);
            echoResponse(200,$listedashbord);
});

$app->get('/contratrecup', function() use ($app) { 
   /* $data =  json_decode(json_encode( $app->request()->params() ), true);$app->request->params('droit')$app->request->params('iduser')$app->request->params('idbanque')$app->request->params('idagence')*/
    if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) {
    $iduser=$_SESSION['uid'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    if($droit=='agence'){
        $where =array('idbanque'=> $idbanque,'idagence'=> $idagence);
    }
    if($droit=='banque'){
       $where = array('idbanque'=> $idbanque);
    }

        global $db;
    $rows = $db->select4($where,$variable);
   /* $tableau=['mille','typedate','datefin','echecenace'];
    $chaine = '';
    for ($i=0; $i < sizeof($tableau); $i++) { 
        $chaine = $chaine.','.$tableau[$i];
    }
    
    $rows['chaine']= $chaine;*/
    // array_push($rest,substr($responses[$i], strlen($responses[$i])-9, strlen($responses[$i])-7));
   /* $timestamp = strtotime('noon first day of next year');
        $rows['date'] = date('r', $timestamp);
        $rows['date1'] = date('Y-m-d',strToTime('1/1 next year -1 day'));
         $date = date('Y-m-d H:i:s',strToTime('1/1 next year -1 day 10:05:41'));
         $rows['dat']=$date;
      if(date('Y-m-d H:i:s')=== $date){
        $rows['samedate']='Ready';
         $contratnum =array('contratnum'=> 0);
        $condition=array();
        $synchro = $db->update("synchronisationnum", $contratnum, $condition, array());
      }*/
    echoResponse(200,$rows);
    }
    
});

// Recuperation des contrats pour traitement
$app->get('/contratrecupTraitement', function() use ($app) { 
   /* $data =  json_decode(json_encode( $app->request()->params() ), true);$app->request->params('droit')$app->request->params('iduser')$app->request->params('idbanque')$app->request->params('idagence')*/
    if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) {
    $iduser=$_SESSION['uid'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    if($droit=='agence'){
        $where ="co.idbanque=".$idbanque."AND co.idagence=".$idagence;
    }
    if($droit=='banque'){
       $where = "AND co.idbanque=".$idbanque;
    }
        $sql ="co.idcontrat,  CONCAT('',co.numcontrat,' ') as numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.iduser,co.idtypepret,co.primeperte,co.accessoires,co.niveau,co.save,co.totalesupprime,co.montantsupprime,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
        $table="contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence "; 
        $order= "$where AND co.status='SOUSCRIPTION' AND co.niveau < 5 ORDER BY idcontrat";            
        global $db;
    $contratPourTraitement = $db->select2($table,$sql,array(),$order);
    echoResponse(200, $contratPourTraitement);
    }
    
});
$app->post('/SearchContratPath', function() use ($app) { 
     $data = json_decode($app->request->getBody());
     if (isset($_SESSION['uid'], $data) AND $_SESSION['uid'] >0) {
    $criteres= htmlspecialchars($data->criteres);
    $iduser=$_SESSION['uid'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    $condition="AND 1=2";
    if($droit=='agence'){
        $where =array('co.idbanque'=> $idbanque,'idagence'=> $idagence);
         $condition='AND co.idbanque='.$idbanque.'AND co.idagence='.$idagence;
    }
    if($droit=='banque'){
       $where = array('co.idbanque'=> $idbanque);
       $condition='AND co.idbanque= '.$idbanque;
    }
}
    if (isset($criteres) AND strlen($criteres)>='2' ) {
  $sql = "co.idcontrat,  CONCAT('',co.numcontrat,' ') as numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.iduser,co.idtypepret,co.primeperte,co.accessoires,co.niveau,co.save,co.totalesupprime,co.montantsupprime,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
  $table="contrat as co INNER JOIN banque as ban 
        ON co.idbanque=ban.id INNER JOIN agence as agen
             ON co.idagence=agen.idagence AND
             (co.numcontrat LIKE '%".$criteres."%' OR co.nom LIKE '%".$criteres."%' OR co.prenom LIKE '%".$criteres."%') ".$condition;
    global $db;
    $rows = $db->select($table,$sql,array());
        if ($rows['status'] != 'success') {
                    $iduser=$_SESSION['uid'];
                        $idbanque=$_SESSION['idbanque'];
                        $idagence=$_SESSION['idagence'];
                        $droit=$_SESSION['droit'];
                        $variable=$droit;
                if($droit=='agence'){
                    $where =array('idbanque'=> $idbanque,'idagence'=> $idagence);
                }
                if($droit=='banque'){
                            $where = array('idbanque'=> $idbanque);
                }
                         
                    $rehercherGlobale = $db->select4($where,$variable);
                    if ($rehercherGlobale['data']==='success') {
                        $rows["status"]="error";
                        $rows["message"] = "Aucune donnée n'a été retrouvée.";
                        $rows["data"] =  $rehercherGlobale['data'];
                    }
                   
                }
     }else{
        $rows["status"]="error";
        $rows["message"] = "Veuillez entrer une mot clé.";
           
     }
    echoResponse(200,$rows);
});


$app->get('/getContratAlerte', function() use ($app) { 
     if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) {
    $iduser=$_SESSION['uid'];
    $idbanque=$_SESSION['idbanque'];
    $idagence=$_SESSION['idagence'];
    $droit=$_SESSION['droit'];
    $variable=$droit;
    $condition="AND 1=2";
    if($droit=='agence'){
        $where =array('co.idbanque'=> $idbanque,'idagence'=> $idagence);
         $condition='AND co.idbanque='.$idbanque.' AND co.idagence='.$idagence.'AND co.niveau=2 AND co.status="SOUSCRIPTION"';
    }
    if($droit=='banque'){
       $where = array('co.idbanque'=> $idbanque);
       $condition='AND co.idbanque= '.$idbanque.' AND co.niveau=2 AND co.status="SOUSCRIPTION"';
    }
}
  $sql = " co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,
  co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,
  co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,
  co.primedeces,co.iduser,co.primeperte,co.accessoires,co.totalesupprime,co.niveau,co.save,ban.id as idbanque,
  agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle";
  $table="contrat as co INNER JOIN banque as ban 
        ON co.idbanque=ban.id INNER JOIN agence as agen
             ON co.idagence=agen.idagence";
    global $db;
    $contratAlerteListe = $db->select2($table,$sql,array(),$condition);
    echoResponse(200,$contratAlerteListe);
});



/*$app->get('/compteusers', function() { 
    global $db;
    $rows = $db->select("contrat","*",array());
    echoResponse(200, $rows);
});*/
      $app->put('/contratstatus/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcontrat'=>$id);
    if(isset($data->status)){
    global $db;
    $dataArray = array('status' => $data->status);
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le status a été correctement modifié.";
    }
    echoResponse(200, $user);
});   

// Changement manuel du niveau de contrat
$app->put('/contratniveauPath/:id',function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    $condition = array('idcontrat'=>$id);
    if(isset($data->niveau)){
    global $db;
    
    if ( $data->niveau===3) {
       $dataArray = array('niveau' => $data->niveau,'datevalidation'=> null,'datereglement'=>null);
    }elseif ($data->niveau===4) {
        $dataArray = array('niveau' => $data->niveau,'datevalidation'=> date('Y-m-d'),'datereglement'=>null);
    }
    else{
    $typedate=($data->typedate=='datevalidation') ? 'datevalidation' :'datereglement';
    $dataArray = array('niveau' => $data->niveau,$typedate=> date('Y-m-d'));

    }
    $table=$data->table;
    /* $dataArray = array('name' => $data->name,'surname' => $data->surname,'fonction' => $data->fonction,'phone' => $data->phone);*/
    $mandatory = array();
      $user = $db->update($table,$dataArray,$condition,$mandatory);
     if($user["status"]=="success")
        $user["message"] = "Le niveau de contrat a été correctement modifié.";
    echoResponse(200, $user);
    }
});

$app->post('/menus', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array();
      if (isset( $data->dateeffet)) {
        $data->dateeffet=dateFR2US($data->dateeffet);
        $data->dateecheance=dateFR2US($data->dateecheance);
        $data->datenaissance=dateFR2US($data->datenaissance);
        $contratCreated=date('Y-m-d H:i:s');
    }
    global $db;
    $order ='ORDER BY idcontrat LIMIT 1';
      $conditionverif = array('numeropret'=>$data->numeropret);
    /* $dataArray = array('libelle'=>$data->libelle, 'icon' => $data->icon);*/
    $user1 = $db->select2("contrat","numeropret",$conditionverif,$order);
    if ($user1["status"]=="success") {
        $condition = array();
        $num = $db->select("synchronisationnum","contratnum",$condition);
        $numero = $num['data'][0]['contratnum'];
        $numcontrat=$numero+1;
        $numeroActualise= $numcontrat;
         $year=date('Y');
        $numeropret='FINBEN'.$year.'/'.$numcontrat;
      
    }else{
        $numeropret=htmlspecialchars($data->numeropret);
        $numeroActualise=$data->numsynchro;

    }
    $profession=(isset($data->profession)? htmlspecialchars($data->profession):null);
    //$data->numcontrat=$data->numcontrat.'|num';
    //$numcontrat=echoResponse(200, $numcontrat); 
 $dataArray = array('numcontrat'=>htmlspecialchars($data->numcontrat),'numeropret'=>$numeropret,'status'=>htmlspecialchars($data->status),'idbanque'=>htmlspecialchars($data->idbanque),'idagence'=>htmlspecialchars($data->idagence),'nom'=>htmlspecialchars($data->nom),'prenom'=>htmlspecialchars($data->prenom),'datenaissance'=>$data->datenaissance,'sexe'=>htmlspecialchars($data->sexe),'profession'=>$profession,'capital'=>htmlspecialchars($data->capital),'dateeffet'=>$data->dateeffet,'duree'=>htmlspecialchars($data->duree),'dateecheance'=>$data->dateecheance,'tauxemprunt'=>htmlspecialchars($data->tauxemprunt),'reglementprime'=>htmlspecialchars($data->reglementprime),'periodicite'=>htmlspecialchars($data->periodicite),'differe'=>htmlspecialchars($data->differe),'perteemploi'=>htmlspecialchars($data->perteemploi),'remboursement'=>htmlspecialchars($data->remboursement),'tauxprimes'=>htmlspecialchars($data->tauxprimes),'primeassurance'=>$data->primeassurance,'primedeces'=>$data->primedeces,'primeperte'=>$data->primeperte,'accessoires'=>$data->accessoires,'iduser'=>$_SESSION['uid'],'idtypepret'=>$data->idtypepret,'totalesupprime'=>$data->totalesupprime,'montantsupprime'=>$data->montantsupprime,'niveau'=>$data->niveau,'save'=>$data->save,'created'=>date('Y-m-d H:i:s'));//'primeassurance'=>htmlspecialchars($data->primeassurance),'primeperte'=>$data->primePE,'accessoires'=>$data->Accessoires
    $rows = $db->insert("contrat", $dataArray, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Le contrat a été bien enrégistré.";
    $contratnum =array('contratnum'=> $numeroActualise);
    $condition=array();
     $synchro = $db->update("synchronisationnum", $contratnum, $condition, $mandatory);
    echoResponse(200, $rows);

});

// NUmero associe au compte 
$app->post('/nomassocieauCompte',function() use ($app) { 
    $data = json_decode($app->request->getBody());
     $condition = array('numcontrat'=>$data->numcontrat);
            require_once 'dbHelper.php';
                $db = new dbHelper();
     $identification = $db->select("contrat","nom,prenom,dateeffet,dateecheance,capital,primeassurance,datenaissance",$condition);
    echoResponse(200,$identification);
 });
$app->post('/logins', function() use ($app) { 
    $data = json_decode($app->request->getBody());
    $mandatory = array();
    global $db;
    /*$rows = $db->insert("contrat", $data, $mandatory);
    if($rows["status"]=="success")*/
        $rows["message"] = "Product added successfully.";
    echoResponse(200, $rows);
});

$app->put('/contrat/:id', function($id) use ($app) { 
    $data = json_decode($app->request->getBody());
    if (isset( $data->dateeffet)) {
        $data->dateeffet=dateFR2US($data->dateeffet);
        $data->dateecheance=dateFR2US($data->dateecheance);
        $data->datenaissance=dateFR2US($data->datenaissance);
       /* $dt = new DateTime();
        $dt->format('d/m/Y H:i:s');*/
    }
     //$data->numcontrat=$data->numcontrat.'|num';
     $profession=(isset($data->profession)? htmlspecialchars($data->profession):null);
    $dataArray = array('numcontrat'=>htmlspecialchars($data->numcontrat),'numeropret'=>htmlspecialchars($data->numeropret),'status'=>htmlspecialchars($data->status),'idbanque'=>htmlspecialchars($data->idbanque),'idagence'=>htmlspecialchars($data->idagence),'nom'=>htmlspecialchars($data->nom),'prenom'=>htmlspecialchars($data->prenom),'datenaissance'=>$data->datenaissance,'sexe'=>htmlspecialchars($data->sexe),'profession'=> $profession,
    'capital'=>htmlspecialchars($data->capital),'dateeffet'=>$data->dateeffet,'duree'=>htmlspecialchars($data->duree),'dateecheance'=>$data->dateecheance,'tauxemprunt'=>htmlspecialchars($data->tauxemprunt),'reglementprime'=>htmlspecialchars($data->reglementprime),'periodicite'=>htmlspecialchars($data->periodicite),'differe'=>htmlspecialchars($data->differe),'perteemploi'=>htmlspecialchars($data->perteemploi),'remboursement'=>htmlspecialchars($data->remboursement),'tauxprimes'=>htmlspecialchars($data->tauxprimes),'primeassurance'=>$data->primeassurance,'primedeces'=>$data->primedeces,'primeperte'=>$data->primeperte,'accessoires'=>$data->accessoires,'iduser'=>$_SESSION['uid'],'idtypepret'=>$data->idtypepret,'totalesupprime'=>$data->totalesupprime,'montantsupprime'=>$data->montantsupprime,'niveau'=>$data->niveau,'save'=>$data->save,'created'=>date('Y-m-d H:i:s'));//totaleSupprime'primeassurance'=>htmlspecialchars($data->primeassurance),'primeperte'=>$data->primePE,'accessoires'=>$data->Accessoires
    $condition = array('idcontrat'=>$id);
    $mandatory = array();
    global $db;
    $rows = $db->update("contrat",$dataArray, $condition, $mandatory);
    if($rows["status"]=="success")
        $rows["message"] = "Le contrat a été correctement modifié.";
    echoResponse(200, $rows);
});

$app->delete('/effacer/:id', function($id) { 
    global $db;
    $rows = $db->delete("contrat", array('idcontrat'=>$id));
    if($rows["status"]=="success");
   
        /*$rows["message"] = "Le contrat a été correctement supprimé.";*/
    echoResponse(200, $rows);
});

function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response,JSON_NUMERIC_CHECK);
}

$app->run();
?>