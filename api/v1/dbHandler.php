<?php

class DbHandler {

    private $conn;
    private $leftMenue;

    function __construct() {
        require_once 'dbConnect.php';
        // opening db connection
        $db = new dbConnect();
        $this->conn = $db->connect();
    }
    /**
     * Fetching single record
     */
    public function getOneRecord($query) {
        $r = $this->conn->query($query.' LIMIT 1') or die($this->conn->error.__LINE__);
        return $result = $r->fetch_assoc();    
    }

    /*public function getUsersInfo($query) {
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
        while($result = $r->fetch_assoc()){
            $result
        }
          return $result;
    }*/
    /**
     * Creating new record
     */
    public function insertIntoTable($obj, $column_names, $table_name) {
        
        $c = (array) $obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach($column_names as $desired_key){ // Check the obj received. If blank insert blank into the array.
           if(!in_array($desired_key, $keys)) {
                $$desired_key = '';
            }else{
                $$desired_key = $c[$desired_key];
            }
            $columns = $columns.$desired_key.',';
            $values = $values."'".$$desired_key."',";
        }
        $query = "INSERT INTO ".$table_name."(".trim($columns,',').") VALUES(".trim($values,',').")";
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);

        if ($r) {
            $new_row_id = $this->conn->insert_id;
            return $new_row_id;
            } else {
            return NULL;
        }
    }
public function getSession(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['uid'],$_SESSION['passwordVerifNumber']) AND $_SESSION['passwordVerifNumber']=='1')
    {
        $sess["uid"] = $_SESSION['uid'];
        $sess["name"] = $_SESSION['name'];
        $sess["pseudo"] = $_SESSION['pseudo'];
        $sess["etat"] = $_SESSION['etat'];
        $sess["idnomgroup"] = $_SESSION['idnomgroup'];
        $sess["idbanque"] = $_SESSION['idbanque'];
        $sess["idagence"] = $_SESSION['idagence'];
        $sess["droit"] = $_SESSION['droit']; 
        $sess["email"] = $_SESSION['email']; 
        $sess["surname"] = $_SESSION['surname']; 
        $sess["passwordVerifNumber"] = $_SESSION['passwordVerifNumber']; 
    }else if(isset($_SESSION['uidVerif'],$_SESSION['passwordVerifNumber']) AND $_SESSION['passwordVerifNumber']=='0'){
        $sess["passwordVerifNumber"] = $_SESSION['passwordVerifNumber'];
        $sess["pseudoVerif"] = $_SESSION['pseudoVerif'];
        $sess["uidVerif"] = $_SESSION['uidVerif'];
    }else
    {
         $response["status"] = "error";
        $response["message"] = "Votre compte est inactif veillez contacter l'administateur!";
       /* $sess["uid"] = '';
        $sess["name"] = 'Guest';
        $sess["email"] = '';*/
    }
    return $sess;
}   

public function destroySession(){
    if (!isset($_SESSION)) {
    session_start();
    }
    if(isset($_SESSION['passwordVerifNumber']) AND $_SESSION['passwordVerifNumber']=='1')
    {
        unset($_SESSION['uid']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['surname']);
        unset($_SESSION['function']);
        unset($_SESSION['etat']);
        unset($_SESSION['idnomgroup']);
        unset($_SESSION['idbanque']);
        unset($_SESSION['idagence']);
        unset($_SESSION['droit']);
        unset($_SESSION['action']);
        unset($_SESSION['pseudo']);
        unset($_SESSION['contrat']);
        unset($_SESSION['email']);
        unset($_SESSION['passwordVerifNumber']);
        if (isset($_SESSION['pseudoVerif'])) {
            unset($_SESSION['pseudoVerif']);
        } 
        if (isset($_SESSION['uidVerif'])) {
            unset($_SESSION['uidVerif']);
        }
        $info='info';
        
        if(isSet($_COOKIE[$info]))
        {
            setcookie ($info, '', time() - $cookie_time);
        }
        $msg="Logged Out Successfully...";
    }elseif (isset($_SESSION['passwordVerifNumber']) AND $_SESSION['passwordVerifNumber']=='0') {
        unset($_SESSION['passwordVerifNumber']);
        unset($_SESSION['pseudoVerif']);
        unset($_SESSION['uidVerif']);
         if (isset($_SESSION['uid'])) {
            unset($_SESSION['uid']);
        }
        if (isset($_SESSION['name'])) {
            unset($_SESSION['name']);
        }
        if (isset($_SESSION['surname'])) {
            unset($_SESSION['surname']);
        } 
        if (isset($_SESSION['function'])) {
            unset($_SESSION['function']);
        }
        if (isset($_SESSION['droit'])) {
            unset($_SESSION['droit']);
        }
        if (isset($_SESSION['pseudo'])) {
            unset($_SESSION['pseudo']);
        }
        if (isset($_SESSION['action'])) {
            unset($_SESSION['action']);
        } if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }
        $msg="Mot de passe réinitialisé";
       
    }else
    {
        $msg = "Not logged in...";
    }
    return $msg;
}

public function setLeftMenue($menues){
       $this->leftMenue=$menues;
} 
public function getLeftMenue(){
      return  $this->leftMenue;
}

    }
?>
