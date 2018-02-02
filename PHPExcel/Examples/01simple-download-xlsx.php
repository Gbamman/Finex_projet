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

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');





$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35); 
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);

$lignedepart = 6;



//  ENTETE DU TABLEAU

$objPHPExcel->getActiveSheet()->setCellValue('B'.$lignedepart,'Identifiant' );
$objPHPExcel->getActiveSheet()->setCellValue('C'.$lignedepart,'Numero contrat' );
$objPHPExcel->getActiveSheet()->setCellValue('D'.$lignedepart,'Statut' );
$objPHPExcel->getActiveSheet()->setCellValue('E'.$lignedepart,'Nom agence' );
$objPHPExcel->getActiveSheet()->setCellValue('F'.$lignedepart,'Nom du client' );
$objPHPExcel->getActiveSheet()->setCellValue('G'.$lignedepart,'Prénom du client' );
$objPHPExcel->getActiveSheet()->setCellValue('H'.$lignedepart,'Capital' );
$objPHPExcel->getActiveSheet()->setCellValue('I'.$lignedepart,'Date Effet');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$lignedepart,'Date Echéance');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$lignedepart,'Durée');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$lignedepart,'Taux');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$lignedepart,'Prime Décès');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$lignedepart,'Perte emploi');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$lignedepart,'Surprime');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$lignedepart,'Accessoires');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$lignedepart,'Prime totale');


$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFont()->setSize(7);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':Q'.$lignedepart)->getFont()->setBold(true);




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Etat');





// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


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
