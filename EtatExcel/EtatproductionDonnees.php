<?php
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
   
                $response = array();
                $mandatory = array();
           require_once '../api/v1/dbHelper.php';
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

          $user =$db->select11($datedebut,$datefin,$where,$variable);
          
          if ($user != NULL) 
          {
             $response=$user;
              $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;
            
           print_r($user);
          }
   }


