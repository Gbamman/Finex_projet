<?php

//include '../config.php'; // Database setting constants [DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD]

 if (!isset($_SESSION)) {
            session_start();
        }
function dateFR2US($date)
{
$date = explode('/', $date);
$date = array_reverse($date);
$date = implode('-', $date);
return $date;
}
function dateUS2FR($date)
{
$date = explode('-', $date);
$date = array_reverse($date);
$date = implode('/', $date);
return $date;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

class dbHelper {
    private $db;
    private $err;
    function __construct() {
        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
        try {
            $this->db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            $response["status"] = "error";
            $response["message"] = 'La connexion à la base de données a echoué: ' . $e->getMessage();
            $response["data"] = null;
            //echoResponse(200, $response);
            exit;
        }
    }
    function select($table, $columns, $where){
        try{
            $a = array();
            $w = "";
            foreach ($where as $key => $value) {
                $w .= " and " .$key. " like :".$key;
                $a[":".$key] = $value;
            }
            $stmt = $this->db->prepare("select ".$columns." from ".$table." where 1=1 ". $w);
            $stmt->execute($a);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée retrouvée.";
            }else{
                $response["status"] = "success";
            }
           
                $response["data"] = $rows;
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué: ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }


    function select2($table, $columns, $where, $order){
        try{
            $a = array();
            $w = "";
            foreach ($where as $key => $value) {
                $w .= " and " .$key. " like :".$key;
                $a[":".$key] = $value;
            }
            $stmt = $this->db->prepare("select ".$columns." from ".$table." where 1=1 ". $w." ".$order);
            $stmt->execute($a);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée retrouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Les données ont été selectionnées de la base";
            }
                $response["data"] = $rows;
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'la selection a echoué: ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }   
 function selectdistinct($table, $columns, $where, $order){
        try{
            $a = array();
            $w = "";
            foreach ($where as $key => $value) {
                $w .= " and " .$key. " like :".$key;
                $a[":".$key] = $value;
            }
            $stmt = $this->db->prepare("select distinct ".$columns." from ".$table." where 1=1 ". $w." ".$order);
            $stmt->execute($a);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été sélectionnée";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table";
            }
                $response["data"] = $rows;
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a échoué: ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }   



    function select3($table, $userConnect){
        try{

               /* $stmt = $this->db->prepare("select distinct me.libelle as menu, me.icon as icones, se.nomcourt, me.idmenue as idmenu,se.libelle as libelleSousMenue,
                                                 pro.libelle as libellegroupe,pro.idnomgroup,pro.chemin,grp.actionMenue FROM sousmenus as se INNER JOIN menus as me 
                                                ON se.idmenu=me.idmenue INNER JOIN profil as pro INNER JOIN groupeutilisateur as grp ON pro.idnomgroup=grp.idnomgroupe
                                             WHERE se.idsousmenu IN (select grp.idsousmenu FROM groupeutilisateur as grpe WHERE grpe.idnomgroupe IN
                                              (select pro.idnomgroup FROM profil as pro1 WHERE pro1.idprofil=".$userConnect."))
                                               AND pro.idprofil=?"); */
                $stmt = $this->db->prepare("select distinct me.libelle as menu, me.icon as icones, se.nomcourt, me.idmenue as idmenu,se.libelle as libelleSousMenue,
                                                nompro.chemin,grp.actionMenue FROM  groupeutilisateur as grp INNER JOIN sousmenus as se ON grp.idsousmenu=se.idsousmenu
                                                  INNER JOIN menus as me ON se.idmenu=me.idmenue INNER JOIN nomprofil as nompro ON nompro.idnomgroup=grp.idnomgroupe
                                             WHERE grp.idnomgroupe=?  AND grp.etat=?");
            $stmt->execute($table) or die (print_r($stmt->ErrorInfo()));
         
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }
    function select5($array,$table1,$table2,$ON){
        try{
                $stmt = $this->db->query("select distinct $array
                                                 FROM $table1 INNER JOIN $table2 $ON
                                                ") or die (print_r($stmt->ErrorInfo()));
         
         
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été retrouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }

/**/
     function select6($table){
        try{

                $stmt = $this->db->prepare("select distinct se.idsousmenu,se.libelle FROM sousmenus as se INNER JOIN groupeutilisateur as grpe ON se.idsousmenu=grpe.idsousmenu WHERE grpe.idnomgroupe = ?");
                $stmt->execute($table) or die (print_r($stmt->ErrorInfo()));
         
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }  

    function select7(){
        try{

                $stmt = $this->db->query("select distinct se.idsousmenu,se.libelle as libelleSousMenue,ngrp.idnomgroup,ngrp.libelle,grpe.idgroup,grpe.actionMenue FROM sousmenus as se INNER JOIN groupeutilisateur as grpe ON se.idsousmenu=grpe.idsousmenu INNER JOIN nomprofil as ngrp ON grpe.idnomgroupe=ngrp.idnomgroup") or die (print_r($stmt->ErrorInfo()));
                
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    } 


    function select8(){
        try{

                $stmt = $this->db->query("select distinct nom.idnomgroup,nom.libelle as libelleNomGroupe,pro.idprofil,pro.libelle as libelleProfil,pro.chemin FROM profil as pro INNER JOIN nomprofil as nom ON pro.idnomgroup=nom.idnomgroup") or die (print_r($stmt->ErrorInfo()));
                
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }


     function select9($where){
        try{

                $stmt = $this->db->prepare("select distinct nom.idnomgroup as idnomgroup,nom.libelle as libelleNomGroupe,se.libelle as libelleSousMenueCheck,se.idsousmenu,grp.actionMenue,grp.etat FROM nomgroupeutilisteur as nom LEFT JOIN groupeutilisateur as grp  ON nom.idnomgroup=grp.idnomgroupe INNER JOIN sousmenus as se ON se.idsousmenu=grp.idsousmenu WHERE grp.idnomgroupe=?");
                $stmt->execute($where) or die (print_r($stmt->ErrorInfo()));
         
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }



    function select10($where){
        try{

                $stmt = $this->db->prepare("select distinct grp.etat,grp.idgroup,grp.idsousmenu,grp.idnomgroupe,se.libelle as libelleSousMenue,me.libelle as allsousmenus,grp.actionMenue FROM groupeutilisateur as grp INNER JOIN sousmenus as se ON grp.idsousmenu=se.idsousmenu INNER JOIN menus as me ON se.idmenu=me.idmenue WHERE grp.idnomgroupe=?") or die (print_r($stmt->ErrorInfo()));
                $stmt->execute($where) or die (print_r($stmt->ErrorInfo()));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows)<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été trouvée.";
            }else{
                $response["status"] = "success";
                $response["message"] = "Des données ont été sélectionnées de la table"; 
                $response["data"] = $rows;
            }
               
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'La selection a echoué : ' .$e->getMessage();
            $response["data"] = null;
        }
        return $response;
    }

    function select11($datedebut,$datefin,$where,$variable,$niveau,$uid, $banque, $agence,$typedate,$ContratParams)
    {
        $querypart=" AND 1=1 AND status='SOUSCRIPTION'";
        if(trim($niveau)!='')
            $querypart.=" AND niveau ='$niveau' AND status='SOUSCRIPTION'";
        if(trim($uid)!='')
            $querypart.=" AND co.iduser ='$uid' AND status='SOUSCRIPTION'";

        if($variable=='agence'){
            $sql ="select distinct co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.primeperte,co.accessoires,co.iduser,co.referencecredit,co.".$ContratParams." as numbord,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle,co.niveau,co.totalesupprime,co.montantsupprime FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE (DATE_FORMAT(co.".$typedate.",'%Y-%m-%d') BETWEEN '$datedebut' AND '$datefin') AND co.idbanque=:idbanque AND co.idagence=:idagence".$querypart;
                             try{
                                                       
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute($where)or die (print_r($stmt->ErrorInfo()));
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                               
                                if(count($rows)<=0){
                                    $response["status"] = "warning";
                                    $response["message"] = "Aucune donnée n'a été retrouvée.";
                                }else{
                                    $response["status"] = "success";
                                    $response["message"] = "Des données ont été sélectionnées de la table";
                           
                                }
                                    $response["data"] = $rows;
                        }catch(PDOException $e){
                                $response["status"] = "error";
                                $response["message"] = 'La selection a échoué: ' .$e->getMessage();
                                $response["data"] = null;
                    }
                             return $response;
        }
        else{

            if(trim($banque)!='')
                $querypart.=" AND co.idbanque ='$banque'";
            if(trim($agence)!='')
                 $querypart.=" AND co.idagence ='$agence'";

            $sql ="select distinct co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.banquelibelle,co.idagence,co.libelleagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.primeperte,co.totalesupprime,co.accessoires,co.iduser,co.referencecredit,co.".$ContratParams." as numbord,ban.id as idbanque,agen.libelle as libelleagence,ban.libelle as banquelibelle,co.niveau,co.montantsupprime FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE (DATE_FORMAT( co.".$typedate.",'%Y-%m-%d') BETWEEN '$datedebut' AND '$datefin') ".$querypart;
                              try{
                                  
                                  
                                    $stmt = $this->db->prepare($sql);
                                    $stmt->execute($where)or die (print_r($stmt->ErrorInfo()));
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if(count($rows)<=0){
                                        $response["status"] = "warning";
                                        $response["message"] = "Aucune donnés n'a été retrouvé.";
                                    }else
                                    {
                                        $response["status"] = "success";
                                        $response['message'] = "Des données ont été sélectionnées de la table";
                                   
                                    }
                                        $response["data"] = $rows;
                                }catch(PDOException $e){
                                    $response["status"] = "error";
                                    $response["message"] = 'La selection a echoué: ' .$e->getMessage();
                                    $response["data"] = null;
                                 }
                    return $response;
                        
        }
       
            }
 

    function insert($table, $columnsArray, $requiredColumnsArray) {
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);
        
        try{
            $a = array();
            $c = "";
            $v = "";
            foreach ($columnsArray as $key => $value) {
                $c .= $key. ", ";
                $v .= ":".$key. ", ";
                $a[":".$key] = $value;
            }
            $c = rtrim($c,', ');
            $v = rtrim($v,', ');
            $stmt =  $this->db->prepare("INSERT INTO $table($c) VALUES($v)");
            $stmt->execute($a);
            $affected_rows = $stmt->rowCount();
            $lastInsertId = $this->db->lastInsertId();
            $response["status"] = "success";
            $response["message"] = $affected_rows." lignes ont été insérées dans la base";
            $response["data"] = $lastInsertId;
            $response["ligne"] = $affected_rows;
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'L\'insertion a echoué: ' .$e->getMessage();
            $response["data"] = 0;
        }
        return $response;
    }
    function update($table, $columnsArray, $where, $requiredColumnsArray){ 
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);
        try{
            $a = array();
            $w = "";
            $c = "";
            $compte = 0;
            foreach ($where as $key => $value) {
                $w .= " and " .$key. " = :".$key;
                $a[":".$key] = $value;
            }
            foreach ($columnsArray as $key => $value) {
                $c .= $key. " = :".$key.", ";
                $a[":".$key] = $value;
                $compte++;
            }
                $c = rtrim($c,", ");

            $stmt =  $this->db->prepare("UPDATE $table SET $c WHERE 1=1 ".$w);
            $stmt->execute($a);
            $affected_rows = $stmt->rowCount();
            if($affected_rows<=0){
                $response["status"] = "warning";
                $response["message"] = "Aucune donnée n'a été modifiée";
            }else{
                $response["status"] = "success";
                $response["message"] = $affected_rows." champ(s) ont été modifié(s) dans la base";
                $response["ligne"] = $compte;
            }
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = "la modification a échoué: " .$e->getMessage();
        }
        return $response;
    }
    function delete($table, $where){
        if(count($where)<=0){
            $response["status"] = "warning";
            $response["message"] = "La suppression a échoué: une condition a été oubliée";
        }else{
            try{
                $a = array();
                $w = "";
                foreach ($where as $key => $value) {
                    $w .= " and " .$key. " = :".$key;
                    $a[":".$key] = $value;
                }
                $stmt =  $this->db->prepare("DELETE FROM $table WHERE 1=1 ".$w);
                $stmt->execute($a);
                $affected_rows = $stmt->rowCount();
                if($affected_rows<=0){
                    $response["status"] = "warning";
                    $response["message"] = "Aucune donnée n'a été supprimée de la table";
                }else{
                    $response["status"] = "success";
                    $response["message"] = $affected_rows." lignes ont été supprimée(s) de la table";
                }
            }catch(PDOException $e){
                $response["status"] = "error";
                $response["message"] = 'La suppression a échoué: ' .$e->getMessage();
            }
        }
        return $response;
    } 
    
    function truncates($table){
       
            try{
                
                $stmt =  $this->db->prepare("TRUNCATE TABLE ".$table);
                $stmt->execute();
                $affected_rows = $stmt->rowCount();
                if($affected_rows<=0){
                    $response["status"] = "success";
                    $response["message"] = "Des données ont été éffacées de la table";
                }else{
                    $response["status"] = "warning";
                    $response["message"] = "Aucune donnée n'a été éffacée de la table";
                }
            }catch(PDOException $e){
                $response["status"] = "error";
                $response["message"] = 'La requete a échoué: ' .$e->getMessage();
            }
       
        return $response;
    }

     function verifyValidCondition($data) {
      
        foreach ($data as $key => $value) {
          
        }

     }
   
    function verifyRequiredParams($inArray, $requiredColumns) {
        $error = false;
        $errorColumns = "";
        foreach ($requiredColumns as $field) {
        // strlen($inArray->$field);
            if (!isset($inArray->$field) || strlen(trim($inArray->$field)) <= 0) {
                $error = true;
                $errorColumns .= $field . ', ';
            }
        }

        if ($error) {
            $response = array();
            $response["status"] = "error";
            $response["message"] = 'Des champs obligatoirs ' . rtrim($errorColumns, ', ') . ' ont été soit oubliés ou ne sont pas remplis';
            echoResponse(200, $response);
            exit;
        }
    }
}

?>
