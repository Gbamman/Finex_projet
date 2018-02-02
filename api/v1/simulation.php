<?php 
/* (
	$data->tauxprimes
	$Capital,
	$Duree,
	$nai,
	$effet,
	$periodicite,
	$taux_banque,
	$PE,
	$idbanque,
	$typepret,
	$Rbt,
	$diff

)*/			require_once 'config.php';
		require_once '../../calculPrime/Primofunction.php';
		require_once 'dbHelper.php';
             	  $db = new dbHelper();
      if(!isset($_SESSION)) {
            session_start();
            $sessionImprimer=array();
            } 
             $app->post('/SimulationPath',function() use ($app) {
             	 $data = json_decode($app->request->getBody());
    				/*$condition = array('idcoass'=>$id); */
    				 $data->dateeffet=dateFR2US($data->dateeffet); 
    				$data->datenaissance=dateFR2US($data->datenaissance);
    			
    					
    						$user=Prime($data->capital,$data->duree,$data->datenaissance,$data->dateeffet,$data->periodicite,$data->tauxbanquaire/100,$data->perteemploi,$_SESSION['idbanque'],$data->idtypepret,$data->remboursement,$data->differe,$data->surprime);
    					
    			
   						
    				 echoResponse(200, $user);
                     //echoResponse(200, $data);
             });
?>
