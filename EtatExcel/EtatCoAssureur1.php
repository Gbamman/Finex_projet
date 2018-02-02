<?php
function enteteFeulle(&$objPHPExcel, $indexFeuille,$lignedepart, $titreFeuille,&$styleThinBlackBorderOutline1,&$response, $tauxAssureur,$parametreList,$estAperiteur){
	$objPHPExcel->setActiveSheetIndex($indexFeuille);

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
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowheight(60);


		$objPHPExcel->getActiveSheet()->mergeCells('B2:V2');





		// TITRE DE LA FEUILLE


		$objPHPExcel->getActiveSheet()->setCellValue('B2',$titreFeuille ); // titre du tableau
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(42);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setARGB('4E3D28');
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getfont()->getColor()->setRGB('FEFEFE');



		//  ENTETE DU TABLEAU

		$objPHPExcel->getActiveSheet()->setCellValue('B'.$lignedepart,'ID' );
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
		$objPHPExcel->getActiveSheet()->setCellValue('Q'.$lignedepart,'Prime Nette');
		$objPHPExcel->getActiveSheet()->setCellValue('R'.$lignedepart,'Prime Totale');
		$objPHPExcel->getActiveSheet()->setCellValue('S'.$lignedepart,'COMMISSION ');
		$objPHPExcel->getActiveSheet()->setCellValue('T'.$lignedepart,"Frais apérition");
		$objPHPExcel->getActiveSheet()->setCellValue('U'.$lignedepart,'Prime nette à percevoir ');
		$objPHPExcel->getActiveSheet()->setCellValue('V'.$lignedepart,'Niveau');


		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->getFont()->setSize(10);

		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->applyFromArray($styleThinBlackBorderOutline1);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->getFill()->getStartColor()->setARGB('F6E8B1');
		$objPHPExcel->getActiveSheet()->getStyle('B'.$lignedepart.':V'.$lignedepart)->getfont()->getColor()->setRGB('614B3A');



$ligne=$lignedepart;

		/*AFFICHAGE DES DONNEES*/
		foreach ($response as $key=>$value) 
		 {
 	
 				$ligne++;	
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$response[$key]['idcontrat']); // iD CONTRAT
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$ligne,$response[$key]['numcontrat']); // NUMERO CONTRAT
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$response[$key]['status']); // STATUT
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$response[$key]['libelleagence'] ); // NOM AGENCE
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$response[$key]['nom']); // NOM CLIENT
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,$response[$key]['prenom'] ); // PRENOM CLIENT
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne,$response[$key]['capital']); // CAPITAL
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,nbJours('1900-01-01',$response[$key]['dateeffet'])); // EFFET
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne,nbJours('1900-01-01',$response[$key]['dateecheance'])); // ECHEANCE
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,$response[$key]['duree']); // DUREE
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,$response[$key]['tauxemprunt']); // TAUX
				
				
				
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$response[$key]['primeassurance']); // PRIME TOTALE
				
				
				
				$quotepartAccessoire=$parametreList[0]['quotepartaccessoires'];
				$tauxCom=$parametreList[0]['commission'];
				$tauxAperition=$parametreList[0]['fraisaperition'];

				$primedeces=$response[$key]['primedeces']*($tauxAssureur/100);
				$primeperte=$response[$key]['primeperte']*($tauxAssureur/100);
				$Surprime=$response[$key]['montantsupprime']*($tauxAssureur/100);
				$accessoires=(1-($quotepartAccessoire/100))*($tauxAssureur/100)*$response[$key]['accessoires'];//1-quote part acessoire* quotepartAssureur*accessoires
				$primeNette=$primedeces+$primeperte+$Surprime;

				$primeTotale=$primeNette+$accessoires;
				$fraisaperition=$tauxAperition*$primeTotale;
				if($estAperiteur==1)
					$fraisaperition=0;
				$commission=$tauxCom*$primeTotale;
				$primeNetteArerverser=$primeTotale-($commission+$fraisaperition);

				
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$primedeces); // PRIME DECES
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,$primeperte); // PRIME PERTE EMPLOI
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$Surprime); // SURPRIME
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$ligne,$accessoires); // ACCESSOIRES
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$primeNette); // PRIME NETTE
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$ligne,$primeTotale); // PRIME TOTALE
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$ligne,$commission); // PRIME TOTALE
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$ligne,$fraisaperition); // PRIME NETTE A REVERSER
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$ligne,$primeNetteArerverser); // PRIME NETTE A REVERSER
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$ligne,getNiveau($response[$key]['niveau'])); // NIVEAU


			
				// Mise en forme des cellules
				 $objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->getFont()->setSize(10);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->applyFromArray($styleThinBlackBorderOutline1);

				// Format numerique
				$objPHPExcel->getActiveSheet()->getStyle('H'.$ligne)->getNumberFormat()->setFormatCode('#,##0');
				$objPHPExcel->getActiveSheet()->getStyle('M'.$ligne.':U'.$ligne)->getNumberFormat()->setFormatCode('#,##0');

				//Format de date
				$objPHPExcel->getActiveSheet()->getStyle('I'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
				$objPHPExcel->getActiveSheet()->getStyle('J'.$ligne)->getNumberFormat()->setFormatCode('dd/mm/yyyy');



				// Mise en forme des cellules
				$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->getFont()->setSize(10);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$ligne.':V'.$ligne)->applyFromArray($styleThinBlackBorderOutline1);
				 }


				  $list_col=array('M','N','O','P','Q','R','S','T','U');

 foreach ($list_col as $key => $value) 
 {
 	$objPHPExcel->getActiveSheet()->setCellValue($value.($lignedepart-1),'=SUM('.$value.($lignedepart+1).':'.$value.$ligne.')');
 }

	$objPHPExcel->getActiveSheet()->getStyle('M'.($lignedepart-1).':U'.($lignedepart-1))->getNumberFormat()->setFormatCode('#,##0');
	$objPHPExcel->getActiveSheet()->getStyle('M'.($lignedepart-1).':U'.($lignedepart-1))->applyFromArray($styleThinBlackBorderOutline1);
	$objPHPExcel->getActiveSheet()->getStyle('M'.($lignedepart-1).':U'.($lignedepart-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('M'.($lignedepart-1).':U'.($lignedepart-1))->getFill()->getStartColor()->setARGB('F6E8B1');
	$objPHPExcel->getActiveSheet()->getStyle('M'.($lignedepart-1).':U'.($lignedepart-1))->getFont()->setItalic(true);


}
?>