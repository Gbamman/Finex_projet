<?php 
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
                $data= file_get_contents("php://input");
                $dataJsonDecode = json_decode($data);
                $datefin= $dataJsonDecode->datefin;
                $datedebut= $dataJsonDecode->datedebut;
                $datedebut=dateFR2US($datedebut);
               $datefin=dateFR2US( $datefin);
                $response = array();
                $mandatory = array();
                    //Requete pour recuperer les donnes de la table parametres avec la banque de l'utilisateur connecte
              $db = new dbHelper();
              $sql="sini.idsinistre,sini.datedeclaration,sini.nomdeclarant,sini.montantattendu,sini.montantregle,sini.datereglement,sini.capital,sini.primeassurance,sini.numerocontrat,sini.dateeffet,sini.dateecheance,sini.datesurvenance,sini.identifiant as identifiantassure,sini.pieces,sini.observations,sini.assureur_name as coassureur,pres.idprestation,pres.libelle,ban.libelle as libellebanque, agen.libelle as libelleagence";
              $table='sinistre as sini INNER JOIN prestation as pres ON sini.idprestation=pres.idprestation INNER JOIN banque as ban ON sini.idbanque=ban.id INNER JOIN agence as agen ON sini.idagence=agen.idagence';
             $order="AND (sini.datedeclaration BETWEEN '$datedebut' AND '$datefin')";
             $condition = array();
           $etatprestation = $db->select2($table,$sql,$condition,$order);

          if ( $etatprestation != NULL) 
          {
             $etatprestationList = $etatprestation['data'];
                  
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }

  }
  

 ?>