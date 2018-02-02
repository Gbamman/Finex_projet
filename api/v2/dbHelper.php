<?php
require_once 'config.php'; // Database setting constants [DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD]
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
class dbHelper {

            private $db;
            private $err;
            function __construct() {
                $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
                try {
                    $this->db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                } catch (PDOException $e) {
                    $response["status"] = "error";
                    $response["message"] = 'La connexion a la base de donnée a échoué: ' . $e->getMessage();
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
                        $response["message"] = "Aucune donnée n'a été retrouvée.";
                    }else{
                        $response["status"] = "success";
                        $response["message"] = "Des donnée ont été selectionnées de la table";
                    }
                        $response["data"] = $rows;
                }catch(PDOException $e){
                    $response["status"] = "error";
                    $response["message"] = 'La selection a échoué: ' .$e->getMessage();
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
                        $response["message"] = "Aucune donnée n'a été retrouvée.";
                    }else{
                        $response["status"] = "success";
                        $response["message"] = "Des données ont été selectionnées de la table";
                    }
                        $response["data"] = $rows;
                }catch(PDOException $e){
                    $response["status"] = "error";
                    $response["message"] = 'La selection a échoué: ' .$e->getMessage();
                    $response["data"] = null;
                }
                return $response;
            }
             function select4($where,$variable){
               
                switch ($variable) {
                        case 'agence':

                            $sql ="select distinct co.idcontrat,  CONCAT('',co.numcontrat,' ') as numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.iduser,co.idtypepret,co.primeperte,co.accessoires,co.niveau,co.save,co.totalesupprime,co.montantsupprime,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE co.idbanque=:idbanque AND co.idagence=:idagence ORDER BY idcontrat DESC LIMIT 50";
                             try{
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute($where)or die (print_r($stmt->ErrorInfo()));
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                               
                                if(count($rows)<=0){
                                    $response["status"] = "warning";
                                    $response["message"] = "Aucune donnée n'a été retrouvée.";
                                }else{
                                    $response["status"] = "success";
                                    $response["message"] = "Les données sont selectionnées";
                                }
                                    $response["data"] = $rows;
                        }catch(PDOException $e){
                                $response["status"] = "error";
                                $response["message"] = 'La sélection a echoué: ' .$e->getMessage();
                                $response["data"] = null;
                    }
                             return $response;
                            break; 
                        case 'banque':
                           $sql ="select distinct co.idcontrat, CONCAT('',co.numcontrat,' ') as numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primedeces,co.primeperte,co.accessoires,co.niveau,co.save,co.totalesupprime,co.montantsupprime,co.iduser,co.idtypepret,co.idtypepret,ban.id as idbanque,agen.libelle as libelleagence,ban.libelle as banquelibelle FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE co.idbanque=:idbanque ORDER BY idcontrat DESC LIMIT 50";
                              try{
                                    
                                    $stmt = $this->db->prepare($sql);
                                    $stmt->execute($where)or die (print_r($stmt->ErrorInfo()));
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if(count($rows)<=0){
                                        $response["status"] = "warning";
                                        $response["message"] = "Aucune donnés n'a été retrouvé.";
                                    }else{
                                        $response["status"] = "success";
                                    }
                                        $response["data"] = $rows;
                                }catch(PDOException $e){
                                    $response["status"] = "error";
                                    $response["message"] = 'La selection a echouée: ' .$e->getMessage();
                                    $response["data"] = null;
                                 }
                return $response;

                            break;
                        
                        default:
                            # code...
                            break;
                    }
              
            }
             function select5($where){
               $sql ="select distinct co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.primeperte,co.accessoires,co.iduser FROM contrat as co WHERE co.idcontrat=:idcontrat LIMIT 1";
                try{
                          $stmt = $this->db->prepare($sql);
                                $stmt->execute($where)or die (print_r($stmt->ErrorInfo()));
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                               
                                if(count($rows)<=0){
                                    $response["status"] = "warning";
                                    $response["message"] = "Aucune donnée n'a été retrouvée.";
                                }else{
                                    $response["status"] = "success";
                                    $response["message"] = "Des données ont été selectionnées de la table";
                                 }
                                    $response["data"] = $rows;
                        }catch(PDOException $e){
                                $response["status"] = "error";
                                $response["message"] = 'La selection a échoué: ' .$e->getMessage();
                                $response["data"] = null;
                    }
                             return $response;
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
                    $stmt->execute($a) or die(print_r($stmt->ErrorInfo()));
                    $affected_rows = $stmt->rowCount();
                    $lastInsertId = $this->db->lastInsertId();
                    $response["status"] = "success";
                    $response["message"] = $affected_rows."Les données ont été bien inserées dans la base";
                    $response["data"] = $lastInsertId;
                }catch(PDOException $e){
                    $response["status"] = "error";
                    $response["message"] = 'L\insertion a echoué: ' .$e->getMessage();
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
                    foreach ($where as $key => $value) {
                        $w .= " and " .$key. " = :".$key;
                        $a[":".$key] = $value;
                    }
                    foreach ($columnsArray as $key => $value) {
                        $c .= $key. " = :".$key.", ";
                        $a[":".$key] = $value;
                    }
                        $c = rtrim($c,", ");

                    $stmt =  $this->db->prepare("UPDATE $table SET $c WHERE 1=1 ".$w);
                    $stmt->execute($a);
                    $affected_rows = $stmt->rowCount();
                    if($affected_rows<=0){
                        $response["status"] = "warning";
                        $response["message"] = "Aucune donnée n'a éte modifiée";
                    }else{
                        $response["status"] = "success";
                        $response["message"] = $affected_rows." champ(s) ont été modifié(s) dans la base";
                    }
                }catch(PDOException $e){
                    $response["status"] = "error";
                    $response["message"] = "La modification a echouée: " .$e->getMessage();
                }
                return $response;
            }
            function delete($table, $where){
                if(count($where)<=0){
                    $response["status"] = "warning";
                    $response["message"] = "La suppression a échouée";
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
                            $response["message"] = $affected_rows." ligne(s) ont été supprimée de la table";
                        }
                    }catch(PDOException $e){
                        $response["status"] = "error";
                        $response["message"] = 'La requete a échouée: ' .$e->getMessage();
                    }
                }
                return $response;
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
            $response["message"] = 'Des champs obligatoire(s) ' . rtrim($errorColumns, ', ') . 'ont été soit oublié ou sont vide';
                    echoResponse(200, $response);
                    exit;
                }
            }
}
?>
