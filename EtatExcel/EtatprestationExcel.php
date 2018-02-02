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
require_once '../api/v1/Etatprestation.php';
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
							 ->setTitle("Etat de PRESTATION")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");




$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setShowGridlines(false);
$objPHPExcel->getActiveSheet()->freezePane('A'.($lignedepart+1));


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
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
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowheight(60);


$objPHPExcel->getActiveSheet()->mergeCells('B2:Q2');





// TITRE DE LA FEUILLE
  

$objPHPExcel->getActiveSheet()->setCellValue('B2','ETAT DE PRESTATION' ); // titre du tableau
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(42);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('4E3D28');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getfont()->getColor()->setRGB('FEFEFE');



//  ENTETE DU TABLEAU

$objPHPExcel->getActiveSheet()->setCellValue('B'.$lignedepart,'Numero contrat' );
$objPHPExcel->getActiveSheet()->setCellValue('C'.$lignedepart,'Nom et Prénom de l\'assuré' );
$objPHPExcel->getActiveSheet()->setCellValue('D'.$lignedepart,'Nom du déclarant' );
$objPHPExcel->getActiveSheet()->setCellValue('E'.$lignedepart,'Banque' );
$objPHPExcel->getActiveSheet()->setCellValue('F'.$lignedepart,'Agence' );
$objPHPExcel->getActiveSheet()->setCellValue('G'.$lignedepart,'Capital' );
$objPHPExcel->getActiveSheet()->setCellValue('H'.$lignedepart,'Montant attendu' );
$objPHPExcel->getActiveSheet()->setCellValue('I'.$lignedepart,'Montant réglé');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$lignedepart,'Prime Assurance');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$lignedepart,'Date d\'effet');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$lignedepart,'Date d\'écheance');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$lignedepart,'Date de reglement');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$lignedepart,'Date de survenance');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$lignedepart,'Nom de l\'assureur');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$lignedepart,'Prestation');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$lignedepart,'observations');


$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFont()->setSize(10);

$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->applyFromArray($styleThinBlackBorderOutline1);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFill()->getStartColor()->setARGB('F6E8B1');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getfont()->getColor()->setRGB('614B3A');






$ligne=$lignedepart;
 
  $querypart="";
  $sql ="select distinct co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.iduser,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE (co.dateeffet BETWEEN '$datedebut' AND '$datefin') AND co.idbanque=:idbanque AND co.idagence=:idagence";
/*$sql="sini.idsinistre,sini.datedeclaration,sini.nomdeclarant,sini.montantattendu,sini.montantregle,sini.datereglement,sini.capital,sini.primeassurance,sini.numerocontrat,sini.dateeffet,sini.dateecheance,sini.datesurvenance,sini.identifiant as identifiantassure,sini.pieces,sini.observations,sini.assureur_name as coassureur,pres.idprestation,pres.libelle,ban.libelle as libellebanque, agen.libelle as libelleagence"; etatprestationList*/

 foreach ($etatprestationList as $key=>$value) 
 {
 					if (isset($etatprestationList[$key]['numerocontrat'])) 
 						$etatprestationList[$key]['numerocontrat'];
 					if (isset($etatprestationList[$key]['identifiantassure'])) 
 						$etatprestationList[$key]['identifiantassure'];
 					if (isset($etatprestationList[$key]['nomdeclarant'])) 
 						$etatprestationList[$key]['nomdeclarant'];
 					if (isset($etatprestationList[$key]['libellebanque'])) 
 						$etatprestationList[$key]['libellebanque'];
 					if (isset($etatprestationList[$key]['libelleagence'])) 
 						$etatprestationList[$key]['libelleagence'];
 					if (isset($etatprestationList[$key]['capital'])) 
 						$etatprestationList[$key]['capital'];
 					if (isset($etatprestationList[$key]['montantattendu'])) 
 						$etatprestationList[$key]['montantattendu'];
 					//if(isset($prestationPdf[0]['datesurvenance']) AND validateDate($prestationPdf[0]['datesurvenance'], 'Y-m-d') === true)  echo dateUS2FR($prestationPdf[0]['datesurvenance']);else echo '';
 					if (isset($etatprestationList[$key]['datereglement']) AND validateDate($etatprestationList[$key]['datereglement'], 'Y-m-d') === true) 
 						$etatprestationList[$key]['datereglement'];
 					if (isset($response[$key]['observations'])) 
 						$etatprestationList[$key]['observations'];
 					if (isset($response[$key]['montantregle']) AND $response[$key]['montantregle']>0) 
 						$etatprestationList[$key]['montantregle'];
 				$ligne++;	
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$etatprestationList[$key]['numerocontrat']); //Numero contrat
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$ligne,$etatprestationList[$key]['identifiantassure']); // Nom et Prénom de l\'assuré
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$etatprestationList[$key]['nomdeclarant']); // Nom du déclarant
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$etatprestationList[$key]['libellebanque'] ); // Banque
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$etatprestationList[$key]['libelleagence']); // agence
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,$etatprestationList[$key]['capital'] ); // Capital
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne,$etatprestationList[$key]['montantattendu']); // Montant attendu
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,$etatprestationList[$key]['montantregle']); //Montant réglé
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne,$etatprestationList[$key]['primeassurance']);                            // Prime Assurance
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,dateUS2FR($etatprestationList[$key]['dateeffet'])); // Date d\'effet
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,dateUS2FR($etatprestationList[$key]['dateecheance'])); //Date d\'écheance
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$reglement=(isset($etatprestationList[$key]['datereglement']) AND validateDate($etatprestationList[$key]['datereglement'], 'Y-m-d') === true) ? dateUS2FR($etatprestationList[$key]['datereglement']) : ''); //Date de reglement'
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,dateUS2FR($etatprestationList[$key]['datesurvenance'])); //Date de survenance
				
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$etatprestationList[$key]['coassureur']); //Nom de l\'assureur
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$ligne,$etatprestationList[$key]['libelle']); // Prestation
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$etatprestationList[$key]['observations']); // observations
				


// Mise en forme des cellules
 $objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':Q'.$ligne)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':Q'.$ligne)->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':Q'.$ligne)->applyFromArray($styleThinBlackBorderOutline1);

// Format numerique
$objPHPExcel->getActiveSheet()->getStyle('G'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('H'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('J'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('I'.$ligne)->getNumberFormat()->setFormatCode('#,##0');

//Format de date

$objPHPExcel->getActiveSheet()->getStyle('K'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('L'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('M'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('N'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');


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