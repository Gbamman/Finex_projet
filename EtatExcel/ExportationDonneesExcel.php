<?php
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
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/*require_once '../common/fonctions.php';*/
require_once '../api/config.php';
require_once '../api/v1/dbHelper.php';
require_once '../api/v1/ExportationDonnees.php';

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../PHPExcel/Classes/PHPExcel.php';


// tableau de stype
$styleThinBlackBorderOutline1 = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => '7E5835'),
		),
	),
);

$lignedepart = 6; // ligne de départ pour l'affichage des contrats

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("SAHGES CREDIT")
							 ->setLastModifiedBy("SAHGES CREDIT")
							 ->setTitle("EXPORTATION")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");




$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setShowGridlines(false);
$objPHPExcel->getActiveSheet()->freezePane('A'.($lignedepart+1));


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowheight(60);
$objPHPExcel->getActiveSheet()->mergeCells('B2:S2');





// TITRE DE LA FEUILLE
  

$objPHPExcel->getActiveSheet()->setCellValue('B2','EXPORTATION' ); // titre du tableau
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(42);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('4E3D28');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getfont()->getColor()->setRGB('FEFEFE');



//  ENTETE DU TABLEAU

$objPHPExcel->getActiveSheet()->setCellValue('B'.$lignedepart,'ID' );
$objPHPExcel->getActiveSheet()->setCellValue('C'.$lignedepart,'Référence du crédit' );
$objPHPExcel->getActiveSheet()->setCellValue('D'.$lignedepart,'Numero de compte' );
$objPHPExcel->getActiveSheet()->setCellValue('E'.$lignedepart,'Nom' );
$objPHPExcel->getActiveSheet()->setCellValue('F'.$lignedepart,'Adresse' );
$objPHPExcel->getActiveSheet()->setCellValue('G'.$lignedepart,'Date de naissance' );
$objPHPExcel->getActiveSheet()->setCellValue('H'.$lignedepart,'Sexe' );
$objPHPExcel->getActiveSheet()->setCellValue('I'.$lignedepart,'Type de pret');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$lignedepart,'Date de déblocage');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$lignedepart,'Première échéance');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$lignedepart,'Dernière échéance');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$lignedepart,'Agence');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$lignedepart,'Gestionnaire de compte');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$lignedepart,'Capital');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$lignedepart,'Taux Emprunt');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$lignedepart,'Prime');
$objPHPExcel->getActiveSheet()->setCellValue('R'.$lignedepart,'Statut du contrat');
$objPHPExcel->getActiveSheet()->setCellValue('S'.$lignedepart,'Catégorie');
$objPHPExcel->getActiveSheet()->setCellValue('T'.$lignedepart,'Code');


$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->getFont()->setSize(10);

$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->applyFromArray($styleThinBlackBorderOutline1);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->getFill()->getStartColor()->setARGB('F6E8B1');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':T'.$lignedepart)->getfont()->getColor()->setRGB('614B3A');






$ligne=$lignedepart;
 
  /*$querypart="";
  $sql="idtemp,referencecredit,numcompte,nom,prenom,profession,adresse,datenaissance,sexe,typepret,periodicite,datedeblocage,duree,datefirstecheance,dateleastecheance,tauxinteret,agence,gescompte,capital,prime,statutcontrat,numbord,categorie,code";*/
 foreach ($exportList as $key=>$value) 
 {

 				$firstdate = validateDate($exportList[$key]['datefirstecheance'], 'Y-m-d') === true ? dateUS2FR($exportList[$key]['datefirstecheance']) : '---';
 				$ligne++;	
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$exportList[$key]['idtemp']); //ID
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$ligne,$exportList[$key]['referencecredit']); //ReferenceCredit
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$exportList[$key]['numcompte']); // Num de compte
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$exportList[$key]['nom']); // Nom
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$exportList[$key]['adresse']); // Adresse
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,dateUS2FR($exportList[$key]['datenaissance'])); // Date de naissance
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne,$exportList[$key]['sexe'] ); // Sexe
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,$exportList[$key]['typepret']); // Capital
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne,dateUS2FR($exportList[$key]['datedeblocage'])); //Date de la première échéance
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,$firstdate); //Date de la première échéance
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,dateUS2FR($exportList[$key]['dateleastecheance']));// Date de la dernière échéance
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$exportList[$key]['agence']); // Agence
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,$exportList[$key]['gescompte']); //gestion de compte
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$exportList[$key]['capital']); //Capital
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$ligne,$exportList[$key]['tauxinteret']); //Capital
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$exportList[$key]['prime']); //Prime
				
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$ligne,$exportList[$key]['statutcontrat']); //Statut du contrat
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$ligne,$exportList[$key]['categorie']); // Catégorie
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$ligne,$exportList[$key]['code']); // Code
				


// Mise en forme des cellules
 $objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':T'.$ligne)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':T'.$ligne)->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':T'.$ligne)->applyFromArray($styleThinBlackBorderOutline1);

// Format numerique
$objPHPExcel->getActiveSheet()->getStyle('O'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('P'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('Q'.$ligne)->getNumberFormat()->setFormatCode('#,##0');


//Format de date


$objPHPExcel->getActiveSheet()->getStyle('J'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('K'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('L'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');


 }



/*$donnees=print_r($response);//sizeof($response);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne, $donnees);*/
//$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne, $response['datedebut']);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('PRESTATION');





$objPHPExcel->setActiveSheetIndex(0);
// Parametre de la banque connectée
 







// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;