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
require_once '../api/v1/EtatProduction.php';

    function nbJours($debut, $fin) 
	{
/* 
Fonction pour calculer la différence entre deux dates
*/
        $nbSecondes= 60*60*24;
        $diff=0;
	
		list($annee1, $mois1, $jour1) = explode('-', $debut);
		list($annee2, $mois2, $jour2) = explode('-', $fin);
 
		$timestamp1 = new datetime($annee1.'-'.$mois1.'-'.$jour1);
		$timestamp2 = new datetime($annee2.'-'.$mois2.'-'.$jour2);
		
		$diff = $timestamp1->diff($timestamp2)->days;

		return 	$diff+2;
   }

   function getNiveau($niveau){
   		$valeur='PROPOSITION';
	   	switch ($niveau) {
	   		case 1:
	   			$valeur='REJET';
	   			break;
	   		case 2:
	   			$valeur='ALERTE';
	   			break;
	   		case 3:
	   			$valeur='PROPOSITION';
	   			break;
	   		case 4:
	   			$valeur='VALIDE';
	   			break;
	   		case 5:
	   			$valeur='PAYE';
	   			break;
	   		case 6:
	   			$valeur='TERME';
	   			break;
	   		case 7:
	   			$valeur='REMBOURSE';
	   			break;
	   		case 8:
	   			$valeur='DECES';
	   			break;
	   		case 9:
	   			$valeur='INVALIDE';
	   			break;
	   		case 10:
	   			$valeur='PERTE EMPLOI';
	   			break;
	   		default:
	   			$valeur='PROPOSITION';
	   			break;
	   	}
	   	return $valeur;
   }
   
require_once 'EtatCoAssureur.php';



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
							 ->setTitle("Etat de PRODUCTION")
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
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18); 
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
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);




$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowheight(60);


$objPHPExcel->getActiveSheet()->mergeCells('B2:W2');





// TITRE DE LA FEUILLE


$objPHPExcel->getActiveSheet()->setCellValue('B2','ETAT DE PRODUCTION' ); // titre du tableau
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(42);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('4E3D36');
$objPHPExcel->getActiveSheet()->getStyle('B2')->getfont()->getColor()->setRGB('FEFEFE');



//  ENTETE DU TABLEAU

$objPHPExcel->getActiveSheet()->setCellValue('B'.$lignedepart,'ID SAHGES' );
$objPHPExcel->getActiveSheet()->setCellValue('C'.$lignedepart,'Numero contrat' );
$objPHPExcel->getActiveSheet()->setCellValue('D'.$lignedepart,'Statut' );
$objPHPExcel->getActiveSheet()->setCellValue('E'.$lignedepart,'Nom agence' );
$objPHPExcel->getActiveSheet()->setCellValue('F'.$lignedepart,'Nom du client' );
$objPHPExcel->getActiveSheet()->setCellValue('G'.$lignedepart,'Prénom du client' );

$objPHPExcel->getActiveSheet()->setCellValue('H'.$lignedepart,'Date de naissance' );

$objPHPExcel->getActiveSheet()->setCellValue('I'.$lignedepart,'Capital' );
$objPHPExcel->getActiveSheet()->setCellValue('J'.$lignedepart,'Date Effet');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$lignedepart,'Date Echéance');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$lignedepart,'Durée');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$lignedepart,'Taux');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$lignedepart,'Prime Décès');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$lignedepart,'Perte emploi');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$lignedepart,'Surprime');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$lignedepart,'Accessoires');
$objPHPExcel->getActiveSheet()->setCellValue('R'.$lignedepart,'Prime Nette');
$objPHPExcel->getActiveSheet()->setCellValue('S'.$lignedepart,'Prime Totale');
$objPHPExcel->getActiveSheet()->setCellValue('T'.$lignedepart,'Commission');

$objPHPExcel->getActiveSheet()->setCellValue('U'.$lignedepart,'Apérition');

$objPHPExcel->getActiveSheet()->setCellValue('V'.$lignedepart,'Num bordereau');
$objPHPExcel->getActiveSheet()->setCellValue('W'.$lignedepart,'Niveau');

$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->getFont()->setSize(10);

$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->applyFromArray($styleThinBlackBorderOutline1);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->getFill()->getStartColor()->setARGB('F6E8B1');
$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':W'.$lignedepart)->getfont()->getColor()->setRGB('614B3A');






$ligne=$lignedepart;
 
  $querypart="";
  $sql ="select distinct co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,co.iduser,ban.id as idbanque,agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle FROM contrat as co INNER JOIN banque as ban ON co.idbanque=ban.id INNER JOIN agence as agen ON co.idagence=agen.idagence WHERE (co.dateeffet BETWEEN '$datedebut' AND '$datefin') AND co.idbanque=:idbanque AND co.idagence=:idagence";

$tauxCom=$parametreList[0]['commission'];
$tauxAperit=$parametreList[0]['fraisaperition'];
$partnonaperiteur=0;

foreach ($coassureurList as $key=>$value) 
{
	$estAperiteur=$coassureurList[$key]['estAperiteur'];
	
	if($estAperiteur==0)
	{
		$partnonaperiteur+= $coassureurList[$key]['part'];		
	}
}



 foreach ($response as $key=>$value) 
 {
 	
 				$ligne++;	
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$response[$key]['idcontrat']); // iD CONTRAT
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$ligne,$response[$key]['numcontrat'],PHPExcel_Cell_DataType :: TYPE_STRING); // NUMERO CONTRAT
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$response[$key]['status']); // STATUT
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$response[$key]['libelleagence'] ); // NOM AGENCE
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$response[$key]['nom']); // NOM CLIENT
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,$response[$key]['prenom'] ); // PRENOM CLIENT
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne, nbJours('1900-01-01',$response[$key]['datenaissance'])); // EFFET
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,$response[$key]['capital']); // CAPITAL
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne, nbJours('1900-01-01',$response[$key]['dateeffet'])); // EFFET
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,nbJours('1900-01-01',$response[$key]['dateecheance'])); // ECHEANCE
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,$response[$key]['duree']); // DUREE
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$response[$key]['tauxemprunt']); // TAUX
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,$response[$key]['primedeces']); // PRIME PERTE EMPLOI
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$response[$key]['primeperte']); // PRIME PERTE EMPLOI
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$ligne,$response[$key]['montantsupprime']); // SURPRIME

				$primeNette=$response[$key]['primeperte']+$response[$key]['primedeces']+$response[$key]['montantsupprime'];
				$primeTotale=$primeNette+$response[$key]['accessoires'];
				$Commission=$primeTotale*$tauxCom;
				$APERITION=$primeTotale*$partnonaperiteur*$tauxAperit/100;
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$response[$key]['accessoires']); // ACCESSOIRES
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$ligne,$primeNette); // PRIME NETTE
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$ligne,$primeTotale); // PRIME TOTALE

/*				$objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$response[$key]['']); // PRIME DECES
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$response[$key]['']); // SURPRIME
				*/
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$ligne,$Commission); // COMMISSION
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$ligne,$APERITION); // APERITION
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$ligne,$response[$key]['numbord']); // NUM BORD
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$ligne,getNiveau($response[$key]['niveau'])); // NIVEAU

// Mise en forme des cellules
 $objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':W'.$ligne)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':W'.$ligne)->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':W'.$ligne)->applyFromArray($styleThinBlackBorderOutline1);

// Format text
$objPHPExcel->getActiveSheet()->getStyle('C'.$ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

// Format numerique
$objPHPExcel->getActiveSheet()->getStyle('I'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('L'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('N'.$ligne.':U'.$ligne)->getNumberFormat()->setFormatCode('#,##0');


//Format de date
$objPHPExcel->getActiveSheet()->getStyle('H'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('J'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
$objPHPExcel->getActiveSheet()->getStyle('K'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');


 }


// somme des primes

 $list_col=array('N','O','P','Q','R','S','T','U');

 foreach ($list_col as $key => $value) 
 {
 	$objPHPExcel->getActiveSheet()->setCellValue($value.($lignedepart-1),'=SUM('.$value.($lignedepart+1).':'.$value.$ligne.')');
 }
	$objPHPExcel->getActiveSheet()->getStyle('N'.($lignedepart-1).':U'.($lignedepart-1))->getNumberFormat()->setFormatCode('#,##0');
	$objPHPExcel->getActiveSheet()->getStyle('N'.($lignedepart-1).':U'.($lignedepart-1))->applyFromArray($styleThinBlackBorderOutline1);
	$objPHPExcel->getActiveSheet()->getStyle('N'.($lignedepart-1).':U'.($lignedepart-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('N'.($lignedepart-1).':U'.($lignedepart-1))->getFill()->getStartColor()->setARGB('F6E8B1');
	$objPHPExcel->getActiveSheet()->getStyle('N'.($lignedepart-1).':U'.($lignedepart-1))->getFont()->setItalic(true);




/*$donnees=print_r($response);//sizeof($response);
$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne, $donnees);*/
//$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne, $response['datedebut']);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('PRODUCTION GLOBALE');





$objPHPExcel->setActiveSheetIndex(0);
// Parametre de la banque connectée
 




		// Donnees co-assureur;
		//$coassureurList;
	$i = 1;
foreach ($coassureurList as $key=>$value) 
{
	 $titreFeille=  "PART ". $coassureurList[$key]['nomcoassureur'];
	 $assureur= $coassureurList[$key]['nomcoassureur'];
	 $estAperiteur=$coassureurList[$key]['estAperiteur'];
	$lignedepart = 6;
    $feuille = new \PHPExcel_Worksheet($objPHPExcel, $titreFeille);
	$objPHPExcel->addSheet($feuille, $i);
	$feuille->setTitle($titreFeille);
	$objPHPExcel->setActiveSheetIndex($i);
	enteteFeulle($objPHPExcel,$i,$lignedepart, $titreFeille,$styleThinBlackBorderOutline1,$response,$coassureurList[$key]['part'],$parametreList,$estAperiteur);
	$i++;

}





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
