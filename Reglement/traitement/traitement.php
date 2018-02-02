			<?php 
		if (isset($_FILES['file']['name'])) {
		$response = array();
		$fileName = $_FILES["file"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file"]["type"]; // The type of file it is
		$fileSize = $_FILES["file"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true 		 
		$extensions_valides = array('xlsx','xls');  
		$extension =  strtolower(  substr( strrchr($_FILES['file']['name'], '.'),1));
		$dossier = '../FichierExcelReglement/'; 
		
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
			if(file_exists($dossier.'Reglement.'.$extension)){
				rename ($dossier.'Reglement.'.$extension,$dossier.'Reglement'.date("dmY-h-i-s").'.'.$extension);
				//echo "file existe"; 
			} 
			if(rename ( $fileTmpLoc,$dossier.'Reglement.'.$extension)){ 
				 $response['status'] = "success";
				 $response['message'] = 'Chargement reussi';
            		require_once '../../api/config.php';
					  require_once '../../api/v1/dbHelper.php';
					    $db = new dbHelper();	
					       $mandatory = array();
					        $condition = array();
					       $deleteTable = $db->truncates("reglement");
					       if ($deleteTable['status']=='success') {
            	  
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
require_once '../../PHPExcel/Classes/PHPExcel.php';
require_once '../../PHPExcel/Classes/PHPExcel/IOFactory.php';
$data = json_decode(file_get_contents("php://input"));
$objPHPExcel = PHPExcel_IOFactory::load($dossier.'Reglement.'.$extension);
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
 						
					$referencecredit=(isset($val[0]))?$val[0]:null;
					$referencevirement=(isset($val[1]))?$val[1]:null;
					$numcomptedebite=(isset($val[6]))?$val[6]:null;
					$dateoperation=(isset($val[2]))?date('Y-m-d', ($val[2] - 25569)*24*60*60 ):null;
					$datevaleur=(isset($val[4]))?date('Y-m-d', ($val[4] - 25569)*24*60*60 ):null;
					$montantcredite=(isset($val[3]))?$val[3]:null;
					
					 
					       $mandatory = array();
					        $condition = array();
					       //
         			//

					         $dataArray = array('referencecredit'=>$referencecredit,'referencevirement'=>$referencevirement,'numcomptedebite'=>$numcomptedebite,'dateoperation'=>$dateoperation,'datevaleur'=>$datevaleur,'montantcredite'=>$montantcredite);
					       
					        		$insert = $db->insert("reglement",$dataArray,$condition,$mandatory);
					        		  if ($insert['status']=='success') {
					        	 $response['status'] = "success";
            					$response['message'] = 'Le fichier a été importé avec succès';
					        }
					         	
					        
					         
      
			} 
		}
	}else{
		$response=$deleteTable;
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
		echo json_encode($response);
 /*move_uploaded_file($fileTmpLoc, $dossier.$_FILES['file']['name']);*/

   /*, 'nomcourt' => $data->nomcourt nomGrpSuppr*/

/*echo $data;
extract($_POST);
 
  echo extract($_POST['file']);;*/
   ?>
