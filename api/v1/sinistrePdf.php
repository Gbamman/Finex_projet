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
              $sql="sini.idsinistre,sini.datedeclaration,sini.nomdeclarant,sini.montantattendu,sini.montantregle,sini.datereglement,sini.capital,sini.primeassurance,sini.numerocontrat,sini.dateeffet,sini.dateecheance,sini.datesurvenance,sini.identifiant as identifiantassure,sini.pieces,sini.observations,sini.assureur_name as coassureur,pres.idprestation,pres.libelle,ban.libelle as libellebanque,ban.logo,agen.libelle as libelleagence";
              $table='sinistre as sini INNER JOIN prestation as pres ON sini.idprestation=pres.idprestation INNER JOIN banque as ban ON sini.idbanque=ban.id INNER JOIN agence as agen ON sini.idagence=agen.idagence';
             $condition = array();
           $etatprestation = $db->select($table,$sql,$condition);

          if ( $etatprestation != NULL) 
          {
             $prestationPdf = $etatprestation['data'];
                  
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin;*/
            
       
          }
      $prestation= $etatprestation['data'][0]['idprestation'];
      $sql='prespiece.id,prespiece.etat,prespiece.idprestation,piece.libelle as libellepiece,piece.id as idpiece';
      $table='pieceprestation as prespiece  INNER JOIN piece as piece ON prespiece.idpiece=piece.id';
      $condition = array();
      $condition = array();
      $order='AND prespiece.etat=1 AND prespiece.idprestation='.$prestation;
      $sinistrePiece = $db->selectdistinct($table, $sql,$condition,$order);
      if ( $etatprestation != NULL) 
          {
             $sinistrePieceList = $sinistrePiece['data'];
             /* $response['datedebut'] =  $datedebut;
             $response['datefin'] =$datefin; $etatprestation['data'][0]['idprestation']*/
           }
           // Co-Assureurs Actif
           $conditions = array('etat'=>'0');//'etat'=>'Actif'
           $orders='ORDER BY nomcoassureur';

           $coassureur = $db->select2("coassureur","idcoass,nomcoassureur,logo,part,etat",$conditions,$orders);
      if ($coassureur != NULL) 
          {
              $coassureurList=$coassureur['data'];
          };
  }
 ?>