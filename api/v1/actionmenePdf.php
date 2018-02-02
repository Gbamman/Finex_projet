<?php 
  	
 // Requete pour recuperer les actions que l'uttilisateur tout au long de sa navigation.
    if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
      

                 //echo $_POST['utilisateur'].' '.$_POST['datedebut'].' '.$_POST['datefin'];
                $response = array();
                $mandatory = array();
                	$datedebut=dateFR2US($_POST['datedebut']);
                    $datefin=dateFR2US($_POST['datefin']);
                    //Requete pour recuperer les diferentes actions menées qu'a effectué l'utilisateur
                if (isset($_POST['utilisateur'],$_POST['datedebut'],$_POST['datefin']) AND $_POST['utilisateur']>0) {
                    $utilisateur=$_POST['utilisateur'];
                	$sql="user.idaction,user.iduser,user.action_mene,user.created,uti.name,uti.surname";
              		$table='user_action as user INNER JOIN user_auth as uti ON user.iduser=uti.uid';
             		$order="AND user.iduser='$utilisateur' AND (DATE_FORMAT(user.created,'%Y-%m-%d') BETWEEN '$datedebut' AND '$datefin')";
                }else if (isset($_POST['datedebut'],$_POST['datefin'])) {
             		echo "Ready";
                	$sql="user.idaction,user.iduser,user.action_mene,user.created,uti.name,uti.surname";
              		$table='user_action as user INNER JOIN user_auth as uti ON user.iduser=uti.uid';
             		$order="AND (user.created BETWEEN '$datedebut' AND '$datefin')";
                }else{
                }
             
             $condition = array();
              $db = new dbHelper();
           $actionmene = $db->select2($table,$sql,$condition,$order);
          if ( $actionmene != NULL) 
          {
             $actionmeneList = $actionmene['data'];
           //	print_r($actionmeneList);
                  
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }

  }

 ?>