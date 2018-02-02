<?php 
// Creation de numéro de bordereau
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
$app->post('/createBordPath',function() use ($app) { 
    $data = json_decode($app->request->getBody());
            $niveau=isset($data->iveau)? $data->niveau:'';
                //$niveau=$dataJsonDecode->niveau;
                $banque=isset($data->banque)? $data->banque:'';
                $agence=isset($data->agence)? $data->agence:'';
            $utilisateur=isset($data->utilisateur)? $data->utilisateur:'';
          $datedebut=dateFR2US($data->datedebut);
          $datefin=dateFR2US( $data->datefin);
          $typedate=dateFR2US( $data->typedate);
          $iduser=$_SESSION['uid'];
          $idbanque=$_SESSION['idbanque'];
          $idagence=$_SESSION['idagence'];
          $droit=$_SESSION['droit'];
          $variable=$droit;

          if($droit=='agence')
          {
              $where =array('idbanque'=> $idbanque,'idagence'=> $idagence);

          }
          if($droit=='banque')
          {
             $where = array('idbanque'=> $idbanque);
          }
          /*if(!empty($niveau))
              array_push($where, array('niveau'=>$niveau));
          if(!empty($utilisateur))
              array_merge($where, array('iduser'=>$utilisateur));*/
              require_once 'dbHelper.php';
  			  $db = new dbHelper();
          $ContratParams=($typedate=='datevalidation')?'numbordvalide':'numbordregle';
          $listContrat =$db->select11($datedebut,$datefin,$where,$variable,$niveau,$utilisateur,$banque, $agence,$typedate,$ContratParams);
          if ($listContrat != NULL) 
          {
            // Liste des contrats dont les numeros de bordereau sont à créer
             $createnumbordlist=$listContrat['data'];
             // selection de numero de dordereau dans la table synchronisation
             $SynchrParam=($typedate=='datevalidation')?'numproduction':'numreglement';
             $ParamDefinie=($typedate=='datevalidation')?'PROD'.date('Y').'/':'REG'.date('Y').'/';
             $valeurTampon='';//Cette variable nous indique que la creation des numéros de bordereau est terminée.
             $FIRST='';
                  $i = 0;
                  $len = count($createnumbordlist);
                  $listContrat['list']='';
             foreach ($createnumbordlist as $key => $value) {

                            $condition=array('idcontrat'=>$value['idcontrat']);
                            $referencecredit=$value['referencecredit'];
                                $selectionVerif=$db->select('contrat',"idcontrat,$ContratParams",$condition);
                                if ($selectionVerif['data'][0][$ContratParams] != null) {
                                  # code...
                                             $listContrat['list2']=   $i ;
                                            $listContrat['total']=  $len ;
                                            $listContrat['total2']=  $selectionVerif;
                                            $listContrat['total3']=  $ContratParams;
                                }else{
                                        
                                        $numbordvalide= $db->select('synchronisationnum',$SynchrParam,array());
                                        $valeur=$numbordvalide['data'][0][$SynchrParam];
                                       $dataArray = array($ContratParams=>  $ParamDefinie.$valeur);
                                      $mandatory = array();
                                      $updateContrat = $db->update("contrat",$dataArray,$condition,$mandatory);
                                       if (($updateContrat['status']=='success') AND $i == $len - 1) {
                                          $valeurTampon= $valeur;
                                           $valeur1=$valeur+1;
                                            $updateSynchro = $db->update("synchronisationnum", array($SynchrParam=>$valeur1),array(),array());
                                            $listContrat['Bravo']=$selectionVerif['data'][0][$ContratParams];
                                            $listContrat['list']= $valeurTampon;
                                            $listContrat['list2']=   $i ;
                                            $listContrat['total']=  $len ;
                                   
                                        }
                                       
                                }
                                if ($i == 0) {
                                    // first
                                } else if ($i == $len - 1) {
                                    // last
                                }
                                // …
                                $i++;
                 
             }
                    
                   if ($listContrat['list']>0) {
                        $listContrat['status']='success';
                        $listContrat['message']= ($i>1) ? $i.' contrats ont été créés sur le bordereau ':$i.' contrat a été créé sur le bordereau ';
                   } else {
                         $listContrat['status']='warning';
                        $listContrat['message']='Aucun contrat n\'a été créé sur le bordereau';
                   }
                   
                    echoResponse(200,$listContrat);
          }
});
}
 ?>