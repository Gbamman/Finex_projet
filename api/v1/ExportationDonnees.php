<?php 
if (isset($_SESSION['uid']) AND $_SESSION['uid'] >0) 
{
    $db = new dbHelper();
          // Donnee pa de défaut
          //$sql="idtemp,referencecredit,numcompte,nom,prenom,profession,adresse,datenaissance,sexe,typepret,periodicite,datedeblocage,duree,datefirstecheance,dateleastecheance,tauxinteret,agence,gescompte,capital,prime,statutcontrat,numbord,categorie,code";
          // Données de DIAMOND BANK
          $sql="idtemp,referencecredit,numcompte,nom,adresse,datenaissance,sexe,typepret,datedeblocage,duree,datefirstecheance,dateleastecheance,tauxinteret,agence,gescompte,capital,prime,statutcontrat,categorie,code";
          //$order='ORDER BY idtemp DESC LIMIT 50';
          $condition=array();
          $exports = $db->select("tabletemporaire",$sql,$condition);

          if ($exports != NULL) 
          {
             $exportList = $exports['data'];
          }

  }

