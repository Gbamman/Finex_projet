			<?php 
		
			/*header('Access-Control-Allow-Origin: http://localhost:3000'); 
			header('Access-Control-Allow-Credentials: true'); 
			header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS'); 
			header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token,authorization');
			if ($_SERVER['REQUEST_METHOD'] != 'OPTIONS')
			header('Access-Control-Max-Age: 31536000');*/
			function cors() {

				// Allow from any origin
				if (isset($_SERVER['HTTP_ORIGIN'])) {
				// Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
				// you want to allow, and if so:
				header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
				header('Access-Control-Allow-Credentials: true');
				header('Access-Control-Max-Age: 86400');    // cache for 1 day
				}

				// Access-Control headers are received during OPTIONS requests
				if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

				if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

				if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

				exit(0);
				}

				//echo "You have CORS!";
			}
				require_once '../../api/config.php';
				require_once '../../api/v1/dbHelper.php';
								/**
				 * PHPExcel
				 *
				 * Copyright (c) 2006 - 2015 PHPExcel
				 *
				 * This library is free software; you can redistribute it and/or
				 * modify it under the terms of the GNU Lesser General Public
				 * License as published by the Free Software Foundation; either
				 * version 2.1 of the License, or (at your option) any later version.
				 *
				 * This library is distributed in the hope that it will be useful,
				 * but WITHOUT ANY WARRANTY; without even the implied warranty of
				 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
				 * Lesser General Public License for more details.
				 *
				 * You should have received a copy of the GNU Lesser General Public
				 * License along with this library; if not, write to the Free Software
				 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
				 *
				 * @category   PHPExcel
				 * @package    PHPExcel
				 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
				 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt  LGPL
				 * @version    ##VERSION##, ##DATE##
				 */

				/** Error reporting */
				error_reporting(E_ALL);
				ini_set('display_errors', TRUE);
				ini_set('display_startup_errors', TRUE);
				date_default_timezone_set('Europe/London');

				if (PHP_SAPI == 'cli')
				  die('This example should only be run from a Web Browser');
				/** Include PHPExcel */
				require_once ('../../PHPExcel/Classes/PHPExcel.php');
				require_once ('../../PHPExcel/Classes/PHPExcel/IOFactory.php');
			cors();

			if(isset($_FILES["file"]["name"])){

		$response = array();
		$fileName = $_FILES["file"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file"]["type"]; // The type of file it is
		$fileSize = $_FILES["file"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true 		 
		$extensions_valides = array('xlsx','xls');  
		$extension =  strtolower(  substr( strrchr($_FILES['file']['name'], '.'),1));
		$dossier = 'fichierExcel/'; 
		
		if (!$fileTmpLoc) 
		{ 
				 $response['status'] = "error";
            	$response['message'] = "Un petit Oubli: Attention vous devez choisir un fichier avant de lancer le chargerment.";
            	 
			exit();
		}
		if(!in_array($extension, $extensions_valides)){
			 	$response['status'] = "error";
            	$response['message'] = "Vous devez choisir un fichier excel 2007 ou convertir votre fichier en Ms Excel 2007";
			  
		}else{
			//On formate le nom du fichier ici...
		 /*$fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-',$fichier);*/			
			if(file_exists($dossier.'EtatProduction.'.$extension)){
				rename ($dossier.'EtatProduction.'.$extension,$dossier.'EtatProduction'.date("dmY-h-i-s").'.'.$extension);
				//echo "file existe"; 
			} 
			if(rename ( $fileTmpLoc,$dossier.'EtatProduction.'.$extension)){ 
				 $response['status'] = "success";
            		$response['message'] = 'Chargement reussi';
					    $db = new dbHelper();	
					       $mandatory = array();
					        $condition = array();
					       $deleteTable = $db->truncates("tabletemporaire");
					       if ($deleteTable) {
					       	# code...
					     
					          /*$verification = $db->select("reglementemp","idregle",$condition);
					         if (COUNT($verification) >0){
					         	$deleteFichier = $db->delete("reglementemp", array('idtemp'=>'>0'));
					         		if($deleteFichier["status"]=="success"){ 
					        			$response = $db->insert("reglementemp",$dataArray,$condition,$mandatory);
					         		}
					         }else{ }*/

$data = json_decode(file_get_contents("php://input"));
$objPHPExcel = PHPExcel_IOFactory::load($dossier.'EtatProduction.'.$extension);
	
					        
  	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetNom     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
   for ($row = 2; $row <= $highestRow; ++ $row) {
		$val=array();
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
			    $cell = $worksheet->getCellByColumnAndRow($col, $row);
			    $val[] = $cell->getValue();
			    //here's my prob..
			    //echo $val;
			}
 				// Ordre par defaut
			/*$referencecredit=(isset($val[0]))?$val[0]:null;
					$numcompte=(isset($val[1]))?$val[1]:null;
					$nom=(isset($val[2]))?$val[2]:null;
					$prenom=(isset($val[3]))?$val[3]:null;
					$profession=(isset($val[4]))?$val[4]:null;
					$adresse=(isset($val[5]))?$val[5]:null;
					$datenaissance=(isset($val[6]))?$val[6]:null;
					$sexe=(isset($val[7]))?$val[7]:null;
					$typepret=(isset($val[8]))?$val[8]:null;
					$periodicite=(isset($val[9]))?$val[9]:null;
					$datedeblocage=(isset($val[10]))?date('Y-m-d', ($val[10] - 25569)*24*60*60 ):null;
					$duree=(isset($val[11]))?$val[11]:null;
					$datefirstecheance=(isset($val[9]))?date('Y-m-d', ($val[9] - 25569)*24*60*60 ):null;
					//$datefirstecheance=(isset($val[12]))?date('Y-m-d', ($val[12] - 25569)*24*60*60 ):null;
					$datelastecheance=(isset($val[12]))?date('Y-m-d', ($val[12] - 25569)*24*60*60 ):null;
					$tauxinteret=(isset($val[14]))?$val[14]:null;
					$agence=(isset($val[15]))?$val[15]:null;
					$gescompte=(isset($val[16]))?$val[16]:null;
					$capital=(isset($val[17]))?$val[17]:null;
					$prime=(isset($val[18]))?$val[18]:null;
					$statutcontrat=(isset($val[19]))?$val[19]:null;
					$numbord=(isset($val[20]))?$val[20]:null;
					$categorie=(isset($val[20]))?$val[20]:null;
					$code=(isset($val[20]))?$val[20]:null;*/

					// Ordere de DIAMOND BANK
					$referencecredit=(isset($val[0]))?$val[0]:null;
					$numcompte=(isset($val[1]))?$val[1]:null;
					$nom=(isset($val[2]))?$val[2]:null;
					$categorie=(isset($val[3]))?$val[3]:null;
					$adresse=(isset($val[4]))?$val[4]:null;// A revoir
					$datenaissance=(isset($val[5]))?$val[5]:null;
					$sexe=(isset($val[6]))?$val[6]:null;
					$sexes=(isset($val[7]))?$val[7]:null;// A revoir
					$typepret=(isset($val[8]))?$val[8]:null;
					$datedeblocage=(isset($val[9]))?date('Y-m-d', ($val[9] - 25569)*24*60*60 ):null;
					$datefirstecheance=(isset($val[10]))?date('Y-m-d', ($val[10] - 25569)*24*60*60 ):null;
					$duree=(isset($val[11]))?$val[11]:'0';
					//$datefirstecheance=(isset($val[9]))?date('Y-m-d', ($val[9] - 25569)*24*60*60 ):null;
					//$datefirstecheance=(isset($val[12]))?date('Y-m-d', ($val[12] - 25569)*24*60*60 ):null;
					$datelastecheance=(isset($val[12]))?date('Y-m-d', ($val[12] - 25569)*24*60*60 ):null;
					$tauxinteret=(isset($val[13]))?$val[13]:null;// A revoir
					$capital=(isset($val[14]))?$val[14]:null;
					$agence=(isset($val[15]))?$val[15]:null;
					$gescompte=(isset($val[16]))?$val[16]:null;
					$interet=(isset($val[17]))?$val[17]:null;// A revoir
					$prime=(isset($val[18]))?$val[18]:null;
					$statutcontrat=(isset($val[19]))?$val[19]:null;
					$numbord=(isset($val[20]))?$val[20]:null;
					$categories=(isset($val[20]))?$val[20]:null; // A revoir
					$code=(isset($val[20]))?$val[20]:null;
				
         			
         					/*$dataArray = array('referencecredit'=>$referencecredit,'numcompte'=>$numcompte,'nom'=>$nom,'prenom'=>$prenom,'profession'=>$profession,'adresse'=>$adresse,'datenaissance'=>date('Y-m-d', ($datenaissance - 25569)*24*60*60 ),'sexe'=>$sexe,'typepret'=>$typepret,'periodicite'=>$periodicite,'datedeblocage'=>$datedeblocage,'duree'=>$duree,'datefirstecheance'=>$datefirstecheance,'dateleastecheance'=>$datelastecheance,'tauxinteret'=>$tauxinteret,'agence'=>$agence,'gescompte'=>$gescompte,'capital'=>$capital,'prime'=>$prime,'statutcontrat'=>$statutcontrat,'numbord'=>$numbord);*/
         					$dataArray = array('referencecredit'=>$referencecredit,'numcompte'=>$numcompte,'nom'=>$nom,'prenom'=>null,'profession'=>null,'adresse'=>$adresse,'datenaissance'=>date('Y-m-d', ($datenaissance - 25569)*24*60*60 ),'sexe'=>$sexe,'typepret'=>$typepret,'periodicite'=>null,'datedeblocage'=>$datedeblocage,
         						'duree'=>$duree,'datefirstecheance'=>$datefirstecheance,'dateleastecheance'=>$datelastecheance,'tauxinteret'=>$tauxinteret,'agence'=>$agence,'gescompte'=>$gescompte,'capital'=>$capital,'prime'=>'0','statutcontrat'=>$statutcontrat,'numbord'=>$numbord,'categorie'=>$categorie,'code'=>$gescompte);
					        $insert = $db->insert("tabletemporaire",$dataArray,$condition,$mandatory);
					        if ($insert['status']=='success') {
					        	 $response['status'] = "success";
            					$response['message'] = 'Le fichier a été importé avec succès';
					        }
         						
         			
            
					 	
      
			} 
		}
}
	}
		else {
				echo "Erreur de copie du fichier";		 
			} 
			
		} 
}else{

								$response['status'] = "error";
            					$response['message'] = 'Aucun fichier n\'a été choisi.';
}
		
		echo json_encode( $response);
 /*move_uploaded_file($fileTmpLoc, $dossier.$_FILES['file']['name']);*/

   /*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/

/*echo $data;
extract($_POST);
 
  echo extract($_POST['file']);;*/
   ?>
