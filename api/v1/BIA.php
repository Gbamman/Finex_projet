 <?php
 session_start();
require_once("connect_d_emprunt1.php");

$Connex1= new Connexion1();
$con1=$Connex1->connect_d();
$conn1=$Connex1->connect_db();

/*$Connex1= new Connexion1();
$conn1=$Connex1->connect_db();
$con1=$Connex1->connect_d();*/
$num=$_GET['id'];

$s = oci_parse($con1, "select NUMCON,NUMPRET,STATUT,NOM,PRENOM,TO_CHAR(DATENAIS,'DD/MM/YYYY'),SEXE,CAPITAL, PERTEMP ,
    TO_CHAR(DATEEFFET,'DD/MM/YYYY') , TO_CHAR(DATEECHE,'DD/MM/YYYY'),
     DUREE , TAUXEMPR , NATURE ,PERIODE , TYPREMB ,DIFFERE ,PRIMASSUR ,
     TAUX ,LOGIN ,c.CODAG , c.CODPROFES AS LIBPROFES,LIBBANQ,LIBAG,VILLE,PHOTO  
	from CONTRAT c,AGENCE a ,BANQUE b  where c.CODAG=a.CODAG and a.CODBANQ=b.CODBANQ and NUMCON = :1");
oci_bind_by_name($s, ":1", trim($num));
oci_execute($s);
$arr = oci_fetch_array($s);

ob_start();
 ?>

<style type="text/css"> 
<!-- 
	 table{
		
		border-collapse:collapse;
		
	} 
		
	.main{ 
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
	}		
		
	table  .first  td{
		border-bottom:1px solid black;
	}			 
	table  .lg  td {
		border-bottom:1px solid black;
	} 
 --> 
 </style>
 

 <page backtop="5mm" backbottom="5mm" backleft="1mm"   style="font-size: 8.5px"> 






            
			                <div class="main">    
                             <table  >
                               
                                    <tr >
                                        <td> <?php if($arr != false){ $phot = $arr['PHOTO']->load();  print'<img src="data:image/png;base64,'.base64_encode($phot).'"  width="134" height="60" />';} ?> </td>
                                        <td colspan="3" style="text-align:center;"><br>COLLECTIF EMPRUNTEUR <br> <br>BULLETIN INDIVIDUEL D'ADHESION N&deg; <?php echo $arr['NUMCON']; ?></td>
                                        <td style="text-align:right;"></td>
                                    </tr>
									<!-- ligne vide -->
                                    <tr class="lg" >
                                        <td colspan="5"><br></td>
                                    </tr>
									
									<!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5"  style="text-align:center;">IDENTIFICATION DE L'ASSURE</td>
                                    </tr>
                               
									<!-- ligne vide -->
                                   
									
									<!-- //ligne vide -->
                                    <tr >
                                        <td >NUMERO</td>
                                        <td><?php echo $arr['NUMCON']; ?></td>
                                        <td></td>
                                        <td>NOM</td>
                                        <td><?php echo $arr['NOM']; ?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>STATUT</td>
                                        <td><?php if($arr[2]==2) echo 'ANNULATION';else echo 'SOUSCRIPTION';?></td>
                                        <td></td>
                                        <td>PRENOMS</td>
                                        <td><?php echo $arr['PRENOM']; ?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>N&deg; DE COMPTE</td>
                                        <td><?php echo $arr['NUMPRET']; ?></td>
                                        <td></td>
                                        <td>DATE DE NAISSANCE</td>
                                        <td><?php echo $arr[5]; ?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>BANQUE</td>
                                        <td><?php echo $arr['LIBBANQ']; ?></td>
                                        <td></td>
                                        <td>SEXE</td>
                                        <td><?php if($arr[6]=='2') echo 'MASCULIN';else echo 'FEMININ';?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>AGENCE</td>
                                        <td><?php echo $arr['LIBAG']; ?></td>
                                        <td></td>
                                        <td>PROFESSION</td>
                                        <td><?php echo $arr['LIBPROFES']; ?></td>
                                    </tr>
									 <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;">CARACTERISTIQUES DU CREDIT</td>
                                    </tr>
									 <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>CAPITAL</td>
                                        <td><?php echo number_format($arr['CAPITAL'],0,',','.').' FCFA'; ?> </td>
                                        <td></td>
                                        <td>REGLEMENT PRIME</td>
                                        <td><?php if($arr['NATURE']==0) echo 'UNIQUE';else echo 'ANNUEL';?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>DATE D'EFFET</td>
                                        <td><?php echo $arr[9]; ?></td>
                                        <td></td>
                                        <td>PERIODICITE</td>
                                        <td><?php if($arr['PERIODE']==12) echo 'MENSUELLE';elseif($arr['PERIODE']==6) echo 'BIMESTRIELLE';elseif($arr['PERIODE']==4) echo 'TRIMESTRIELLE';elseif($arr['PERIODE']==2) echo 'SEMESTRIELLE';else echo 'ANNUELLE';?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>DATE D'ECHEANCE</td>
                                        <td><?php echo $arr[10]; ?></td>
                                        <td></td>
                                        <td>REMBOURSEMENT</td>
                                        <td><?php if($arr['TYPREMB']==0) echo 'PERIODIQUE';else echo 'A TERME';?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>DUREE</td>
                                        <td><?php echo $arr['DUREE'].' MOIS'; ?> </td>
                                        <td></td>
                                        <td>DIFFERE</td>
                                        <td><?php echo $arr['DIFFERE'].' MOIS'; ?></td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td>TAUX D'EMPRUNT</td>
                                        <td><?php echo (float) str_replace(",",".",$arr['TAUXEMPR']).'%'; ?></td>
                                        <td></td>
                                        <td>PERTE EMPLOI</td>
                                        <td><?php if($arr['PERTEMP']==0) echo 'NON';else echo 'OUI';?></td>
                                    </tr>
									 <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center; ">DECLARATION DE LA PERSONNE A ASSURER</td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td colspan="5">Je d&eacute;clare &ecirc;tre assur&eacute;(e) pour le pr&ecirc;t ci-dessus suivant les modalit&eacute; au contrat d'assurance
										souscrit par la banque : </td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td colspan="5"><?php echo $arr['LIBBANQ'].' '.$arr['LIBAG']; ?> </td>
                                    </tr>
									
									<tr>
                                        <td colspan="5">Je reconnais avoir re&ccedil;u le r&eacute;sum&eacute; des principales dispositions au contrat d'assurance. 
										Je d&eacute;clare sur honneur &ecirc;tre en bonne sant&eacute;, ne pas suivre de traitement m&eacute;dical r&eacute;gulier
										et exercer une activit&eacute; stable &agrave; plein temps. Je suis inform&eacute; que conform&eacute;ment au code CIMA toute fausse d&eacute;claration 
										entraine la nullit&eacute; du contrat.</td>
                                    </tr>
									 
									<?php if($arr['PERTEMP']==1){?>
									<tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
									
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center; ">GARANTIE COMPLEMENTAIRE ASSURANCE PERTE EMPLOI</td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<!-- ligne vide -->
                                   
									
									<!-- //ligne vide -->
									<tr>
                                        <td colspan="5">Je souhaite souscrire &agrave; la garantie compl&eacute;mentaire PERTE D'EMPLOI </td>
                                    </tr>
									 <tr>
                                        <td colspan="5"></td>
                                    </tr>
									<tr>
                                        <td colspan="5">Je d&eacute;clare ce jour &ecirc;tre ag&eacute;(e) de moins de 60 ans, exercer &agrave; titre principal une activit&eacute; salari&eacute;e du secteur
										priv&eacute; ou public sous contrat &agrave; dur&eacute;e d&eacute;termin&eacute;e ou indd&eacute;termin&eacute;e depuis plus de <br/> six (6) mois chez le m&ecirc;me employeur, n'&ecirc;tre ni en p&eacute;riode d'essai,
										en pr&eacute;avis de licenciement, ni en chomage technique ou partiel, ni en p&eacute;riode de pr&eacute;-retraite, ni avoir postul&eacute; pour un d&eacute;part <br/> n&eacute;goci&eacute;.
										Par ailleurs, je suis inform&eacute; que le licenciement pour fautes lourdes ou graves, la d&eacute;mission, le d&eacute;part volontaire, l'abandon de poste font partie des exclusions
										de la garantie et donc <br/> ne donne droit &agrave; aucune indemnisation.</td>
                                    </tr>
									<?php }?>
									<!-- ligne vide -->
									<tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
									<!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center; ">BENEFICIAIRES DES GARANTIES</td>
                                    </tr>
									<tr>
                                        <td colspan="5"></td>
                                    </tr>
									<!-- //ligne vide -->
									<tr>
                                        <td colspan="5">
										<input type="checkbox" checked="checked" /> En cas de d&eacute;c&egrave;s ou d'invalidit&eacute; absolue 
										et d&eacute;finitive jusqu'&agrave; concurence du solde restant du à la date de d&eacute;c&egrave;s. &nbsp;<br/>
										<?php if($arr['PERTEMP']!=0) echo '<input type="checkbox" checked="checked" /> En cas de perte emploi '.$arr['LIBBANQ'].' '.$arr['LIBAG'].'.';?></td>
                                    </tr>
									<tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
									<!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center;">QUESTIONNAIRE MEDICAL</td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<!-- //ligne vide -->
									<tr>
                                        <td colspan="5">NB: Veuillez encercler la bonne r&eacute;ponse et apporter des pr&eacute;cisions en cas de r&eacute;ponses positives.<br/> &nbsp;</td>
										
                                    </tr>
									<tr>
                                        <td colspan="3">1. Il y a t-il dans votre famille une maladie h&eacute;r&eacute;ditaire?</td>
										<td>
										 <!--<ul class="main1">   <li >OUI</li>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <li >NON</li> </ul>-->
										  <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="2">2. Souffrez-vous ou avez vous &eacute;t&eacute; atteint par l'une des maladies particuli&egrave;res <!-- : respiratoires, genito-urinaires, 
										cardio-vasculaire, neurologique, des os et articulations, de l'appareil digestif, 
										endocriniennes ou m&eacute;taboliques et neuropsychiques ou autres non cit&eacute;es ? --></td>
										
										<td> </td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									
									<tr>
                                        <td colspan="3">3. Avez-vous fait r&eacute;cemment l'objet d'un test de d&eacute;pistage des h&eacute;patites B , C ou VIH ? </td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="3">4. Avez vous suivi ou suivez vous un r&eacute;gime ou un traitement  m&eacute;dical?</td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="3">5. Avez vous ou devez vous subir une intervention chirurgicale?</td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="3">6. Avez vous subi une perfusion ou une transfusion de sang ?</td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="3">7. Avez vous &eacute;t&eacute; ou devez vous &ecirc;tre hospitalis&eacute; ou subir des examens m&eacute;dicaux ?</td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="3">8. Avez vous &eacute;t&eacute; victime d'un accident de circulation ?.</td>
										<td>
										    <i class="aweso-icon-check-empty"></i> OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="aweso-icon-check-empty"></i> NON
                                        </td>
										<td>
										    Si oui pr&eacute;cisez:.............................................................
                                        </td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<tr>
                                        <td colspan="5">L'assureur se r&eacute;serve le droit de demander une visite ou examen m&eacute;dical pour une meilleure 
										appr&eacute;ciation du risque, ou de ne pas accepter le risque</td>
										
                                    </tr>
									<tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center; ">PRIME D'ASSURANCE</td>
                                    </tr>
									<tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
									<?php $s1 = oci_parse($con1, 'select * from Para_Tech');oci_execute($s1);  $arr2 = oci_fetch_array($s1);$capii=$arr2[5]; ?>
									<tr>
                                        <td style="text-align:right;font-size:12px;">PRIME TTC :</td>
										<td style="text-align:left;font-size:12px;"><?php if($arr['CAPITAL']<=$capii) echo number_format($arr['PRIMASSUR'],0,',','.').' FCFA'; ?></td>
										<td></td>
										<td style="font-size:12px;">TAUX DE PRIME :</td>
										<td style="font-size:12px;"><?php if($arr['CAPITAL']<=$capii) echo (float) str_replace(",",".",$arr['TAUX']).'%'; ?></td>
                                    </tr>
									<tr class="lg">
                                        <td colspan="5"><br></td>
                                    </tr>
									<tr class="lg">  
									
										<td colspan="5" > Fait &agrave; <?php echo $arr['VILLE']; ?> le <?php echo date("d/m/Y"); ?></td>
									</tr>
									<tr>
                                        <td colspan="5"><br></td>
                                    </tr>
									<tr class="lg">
                                        <td> L'ASSURE</td>
                                        <td colspan="3" style="text-align:center;">LE BENEFICIAIRE</td>
                                        <td style="text-align:right;">SAHAM ASSURANCE VIE BENIN</td>
                                    </tr>
									<tr>
                                        <td colspan="5"><br></td>
                                    </tr>
						<tr class="lg">
                                        <td colspan="5" style="text-align:right;"> <?php if($arr != false){ if($arr['CAPITAL']<=$capii) echo '<img src="assets/img/signDAR.png" alt="Logo Saham ASSURANCE" width="160" height="70" />';} ?> </td>
                                    </tr>
									<tr>
                                        <td colspan="5"><br></td>
                                    </tr>
					

								   <tr >
                                        <td ><img src="assets/img/logo_saham.jpg" alt="Logo Saham ASSURANCE" width="134" height="60"  /></td>
                                        <td><img src="assets/img/sunu.jpg" alt="Logo Saham ASSURANCE" width="134" height="60" /></td>
                                        <td><img src="assets/img/africaine.jpg" alt="Logo Saham ASSURANCE" width="134" height="60" /></td>
                                        <td><img src="assets/img/nsia.jpeg" alt="Logo Saham ASSURANCE" width="134" height="60" /></td>
                                        <td><img src="assets/img/argg.png" alt="Logo Saham ASSURANCE" width="134" height="60" /></td>
                                    </tr>						
                              
                            </table>
							</div>   
                           
</page>

<?php
 $content=ob_get_clean();
require('html2pdf_v4.03/html2pdf.class.php');
$pdf= new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
ob_end_clean();
$pdf->Output('BIA.pdf'); 
?>
