<?php 
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
                $data= file_get_contents("php://input");
                $dataJsonDecode = json_decode($data);
                $datefin= $dataJsonDecode->datefin;
                $datedebut= $dataJsonDecode->datedebut; 

                $niveau=property_exists($dataJsonDecode, 'niveau')? $dataJsonDecode->niveau:'';
                //$niveau=$dataJsonDecode->niveau;
                $banque=property_exists($dataJsonDecode, 'banque')? $dataJsonDecode->banque:'';
                $agence=property_exists($dataJsonDecode, 'agence')? $dataJsonDecode->agence:'';
                $utilisateur=property_exists($dataJsonDecode, 'utilisateur')? $dataJsonDecode->utilisateur:'';
                $typedate=property_exists($dataJsonDecode, 'typedate')? $dataJsonDecode->typedate:'';
                $ContratParams=($typedate=='datevalidation' || $typedate=='dateffet')?'numbordvalide':'numbordregle';
                $response = array();
                $mandatory = array();
  
               
       //   require_once 'dbHelper.php';
           $db = new dbHelper();
          $datedebut=dateFR2US($datedebut);
          $datefin=dateFR2US( $datefin);
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

          $listContrat =$db->select11($datedebut,$datefin,$where,$variable,$niveau,$utilisateur,$banque, $agence,$typedate,$ContratParams);
          
          if ($listContrat != NULL) 
          {
             $response=$listContrat['data'];
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }

              //Requete pour recuperer la liste des co-assureur
                $condition = array('etat'=>'0');//'etat'=>'Actif'
               $coassureur = $db->select("coassureur","idcoass,nomcoassureur,logo,part,estAperiteur,etat",$condition);
          
          if ( $coassureur != NULL) 
          {
             $coassureurList= $coassureur['data'];
            
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }
          //Requete pour recuperer les donnes de la table parametres avec la banque de l'utilisateur connecte
            
          $condition = array('idbanque'=>$idbanque);
           $doneesparametres = $db->select("parametres","idparam,idbanque,fraisgestion,agemaxi,agemini,fraisacquisition,capitalmax,idtypepret,tauxprime,commission,quotepartaccessoires,fraisaperition,tauxperteemploi,accessoires,primeplanchet",$condition);
          
          if ( $doneesparametres != NULL) 
          {
             $parametreList= $doneesparametres['data'];
            
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }
          
        
   }


/*header('Location: ../../EtatExcel/etatProductionExcel.php');*/


//INCLUDE '../../EtatExcel/etatProductionExcel.php';


