<?php 
  
	   $app->get('/affichageReglement',function(){
      $response = array();
      $condition = array();//'etat'=>'Actif'
     require_once 'dbHelper.php';
    $db = new dbHelper();
    $order='ORDER BY idregle DESC LIMIT 50';
    $sql="idregle,referencecredit,referencevirement,numcomptedebite,dateoperation,datevaleur,montantcredite";
     $import = $db->select2("reglement",$sql,$condition,$order);
     echoResponse(200, $import);
});	
       $app->get('/affichageFichier',function(){
      $response = array();
      $condition = array();//'etat'=>'Actif'
     require_once 'dbHelper.php';
    $db = new dbHelper();
    $order='ORDER BY idtemp DESC LIMIT 50';
    $sql="idtemp,referencecredit,numcompte,nom,prenom,profession,adresse,datenaissance,sexe,typepret,periodicite,datedeblocage,duree,datefirstecheance,dateleastecheance,tauxinteret,agence,gescompte,capital,prime,statutcontrat,numbord,categorie,code";
     $import = $db->select2("tabletemporaire",$sql,$condition,$order);
     echoResponse(200, $import);
});
  $app->get('/gestiondesimports',function(){
    $sql="idtemp,referencecredit,numcompte,capital";
    require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array();//'etat'=>'Actif'
      $nouvelleDate=date('Y-m-d');
      $z = 0;
    $importCompare = $db->select("tabletemporaire",$sql,$condition);
    foreach ($importCompare['data'] as $key => $value) {
       $dataArray = array('referencecredit'=>$value['referencecredit'],'niveau'=>4,'datevalidation'=>$nouvelleDate);
       $mandatory = array();
            $conditionModif = array('numcontrat'=>$value['numcompte'],'capital'=>$value['capital']);
            $updateSouscription = $db->update("contrat",$dataArray,$conditionModif,$mandatory);
          if ($updateSouscription['status']=='success') {
             $z++;
               $updateSouscriptions = $db->delete("tabletemporaire", array('idtemp'=>$value['idtemp']));
                $response['status']='success';
                $response['message']=($updateSouscription['ligne'] >1)? $z.' contrats ont été validés avec succès ' : $z.' contrat a été validé avec succès' ;
            }else{
                     $response['status']='warning';
                      $response['message']= "Aucune donnée n'a été modifiée";
            }
    }
     echoResponse(200,  $response);
  });

  	$app->get('/gestiondesregelementspath',function(){
		$sql="idregle,referencecredit,referencevirement";
		require_once 'dbHelper.php';
    $db = new dbHelper();
     $response = array();
      $condition = array();//'etat'=>'Actif'
      $nouvelleDate=date('Y-m-d');
      $comptes=0;
		$importCompare = $db->select("reglement",$sql,$condition);
		foreach ($importCompare['data'] as $key => $value) {
           $dataArray = array('niveau'=>5,'datereglement'=>$nouvelleDate);
    			 $mandatory = array();
        		$conditionModif = array('referencecredit'=>$value['referencecredit']);
        		$updateSouscription = $db->update("contrat",$dataArray,$conditionModif,$mandatory);
        if ($updateSouscription['status']=='success') {
                $comptes++;
               $deletereglement = $db->delete("reglement", array('idregle'=>$value['idregle']));
                
		}
  }
        if ( $comptes>0) {
                          $response['status']='success';
                        $response['message']=($comptes >1) ? $comptes.' contrats ont été réglés ' : 'Seul un '.$comptes.' contrat a été reglé' ;
            }else{
                     $response['status']='warning';
                      $response['message']= "Aucune donnée n'a été modifiée";
                      
            }
     echoResponse(200, $response);
	})	
 ?>