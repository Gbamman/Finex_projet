<?php
require_once 'config.php';
require_once 'dbHandler.php';
require_once 'passwordHash.php';
require '.././libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();



// User id from db - Global Variable
require_once 'gestionnomgroupe.php';
require_once 'gestionsousmenugroupe.php';
require_once 'usersreq.php';
require_once 'gestionProfil.php';
require_once 'authentication.php';
require_once 'gestionmenus.php';
require_once 'gestionsousmenus.php';
require_once 'gestionBanque.php';
require_once 'gestionAgence.php';
require_once 'typePret.php';
require_once 'coassureur.php';
require_once 'simulation.php';
require_once 'parametreprime.php';
require_once 'questionsmedicales.php';
require_once 'RecuperationImport.php';
require_once 'sinistre.php';
require_once 'prestation.php';
require_once 'numbordereau.php';
require_once 'produit.php';

/*require_once 'EtatProduction.php';*/

/**
 * Verifying required params posted or not
 */
function  VerifiactionDesParams($required_fields,$request_params) {
    $error = false;
    $error_fields = "";
    foreach ($required_fields as $field) {
        if (!isset($request_params->$field) || strlen(trim($request_params->$field)) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["status"] = "error";
        $response["message"] = 'Le(s) champ (s) obligatoires tel que ' . substr($error_fields, 0, -2) . ' ont ete oublié ou ne se sont pas remplis';
        echoResponse(200, $response);
        $app->stop();
    }
}


function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
?>
