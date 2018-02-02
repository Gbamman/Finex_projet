<?php
session_start();
require_once '../api/config.php';
require_once '../api/v1/dbHelper.php';
require_once '../api/v1/BIAPdf.php';
 //$dataJsonDecode = $_POST['contrat'];
ob_start();
 ?>

<style type="text/css"> 
<!-- 
     table{
        
        border-collapse:collapse;
        
    } 
        .banqueLogo img {
              position: absolute; 
                 top:0; 
                left: 0; 
        }
    .main{ 
        border-top:1px solid black;
        border-right:1px solid black;
        border-left:1px solid black;
        border-bottom:1px solid black;
            position: absolute; 
    top:0; 
    left: 0; 
    width: 600px;
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
                             <table >


                        
                           
                            <tr>          
                                <td colspan="4" style="text-align:center;padding-left:200px;"><br><h6>ASSURANCE PROTECTION EMPRUNTEUR</h6> 
                                   
                                <h5>        
                                    BULLETIN INDIVIDUEL D'ADHESION N&deg;<?php echo $responseContrat[0]['numeropret']; ?>
                                </h5>                       
                                
                                </td>
                                <td colspan="2" style="text-align:center;">
                                    <img src="../Banque/imagesBanque/<?php echo $responseContrat[0]['logo']; ?>" alt="Logo BANQUE" width="120" height="75" style="margin-top:10px;"/>
                                </td>
                            </tr>
                                    <!-- ligne vide -->
                                    <tr class="lg" >
                                        <td colspan="5"><br></td>
                                    </tr>
                                    
                                    <!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5"  style="text-align:center;">IDENTIFICATION DE L'ASSURE</td>
                                    </tr>
                                    <tr >
                                        <td >NUMERO DE COMPTE</td>
                                        <td><?php echo $responseContrat[0]['numcontrat'];?></td>
                                        <td></td>
                                        <td>NOM</td>
                                        <td><?php echo $responseContrat[0]['nom'];?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>STATUT</td>
                                        <td><?php echo  $responseContrat[0]['status'];?></td>
                                        <td></td>
                                        <td>PRENOMS</td>
                                        <td><?php echo $responseContrat[0]['prenom']; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>NUMERO DE CONTRAT</td>
                                        <td><?php echo $responseContrat[0]['numeropret']; ?></td>
                                        <td></td>
                                        <td>DATE DE NAISSANCE</td>
                                        <td><?php echo dateUS2FR($responseContrat[0]['datenaissance']); ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>BANQUE</td>
                                        <td><?php echo $responseContrat[0]['banquelibelle']; ?></td>
                                        <td></td>
                                        <td>SEXE</td>
                                        <td><?php if($responseContrat[0]['sexe']=='M') echo 'MASCULIN';else echo 'FEMININ';?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>AGENCE</td>
                                        <td><?php echo $responseContrat[0]['libelleagence']; ?></td>
                                        <td></td>
                                        <td>PROFESSION</td>
                                        <td><?php echo $responseContrat[0]['profession']; ?></td>
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
                                        <td><?php echo number_format($responseContrat[0]['capital'],0,',','.').' FCFA'; ?> </td>
                                        <td></td>
                                        <td>REGLEMENT PRIME</td>
                                        <td><?php if($responseContrat[0]['reglementprime']=='UNIQUE') echo 'UNIQUE';else echo 'ANNUEL';?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DATE D'EFFET</td>
                                        <td><?php echo dateUS2FR($responseContrat[0]['dateeffet']); ?></td>
                                        <td></td>
                                        <td>PERIODICITE</td>
                                        <td><?php echo $responseContrat[0]['periodicite'];?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DATE D'ECHEANCE</td>
                                        <td><?php echo dateUS2FR($responseContrat[0]['dateecheance']); ?></td>
                                        <td></td>
                                        <td>REMBOURSEMENT</td>
                                        <td><?php if($responseContrat[0]['remboursement']=='PERIODIQUE') echo 'PERIODIQUE';else echo 'A TERME';?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DUREE</td>
                                        <td><?php echo $responseContrat[0]['duree'].' MOIS'; ?> </td>
                                        <td></td>
                                        <td>DIFFERE</td>
                                        <td><?php echo $responseContrat[0]['differe'].' MOIS'; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>TAUX D'EMPRUNT</td>
                                        <td><?php echo (float) str_replace(",",".",$responseContrat[0]['tauxemprunt']).'%'; ?></td>
                                        <td></td>
                                        <td>PERTE EMPLOI</td>
                                        <td><?php if($responseContrat[0]['perteemploi']=='non') echo 'NON';else echo 'OUI';?></td>
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
                                        <td colspan="5">Je d&eacute;clare &ecirc;tre assur&eacute;(e) pour le pr&ecirc;t ci-dessus suivant les modalit&eacute;s au contrat d'assurance
                                        souscrit par la banque : </td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><?php echo $responseContrat[0]['banquelibelle']; ?> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="5">Je reconnais avoir re&ccedil;u la notice d'information précisant les principales dispositions au contrat d'assurance. 
                                        Je d&eacute;clare sur honneur &ecirc;tre en bonne sant&eacute;, ne pas suivre de traitement m&eacute;dical r&eacute;gulier
                                        et exercer une activit&eacute; stable &agrave; plein temps. Je suis inform&eacute;(e) que conform&eacute;ment au code CIMA toute fausse d&eacute;claration 
                                        entraine la nullit&eacute; du contrat.</td>
                                    </tr>
                                     
                                    <?php if($responseContrat[0]['perteemploi']=='oui'){?>
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
                                        en pr&eacute;avis de licenciement, ni en ch&ocirc;mage technique ou partiel, ni en p&eacute;riode de pr&eacute;-retraite, ni avoir postul&eacute; pour un d&eacute;part <br/> n&eacute;goci&eacute;.
                                        Par ailleurs, je suis inform&eacute;(e) que le licenciement pour fautes lourdes ou graves, la d&eacute;mission, le d&eacute;part volontaire, l'abandon de poste font partie des exclusions
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
                                        et d&eacute;finitive jusqu'&agrave; concurence du solde restant d&ugrave; &agrave; la date de d&eacute;c&egrave;s : <?php echo $responseContrat[0]['banquelibelle']; ?> &nbsp;<br/>
                                        <?php if($responseContrat[0]['perteemploi']!='non') echo '<input type="checkbox" checked="checked" /> En cas de perte emploi '.$responseContrat[0]['banquelibelle'];?></td>
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
                                  
                                    
                                        <?php 
                                         $responses=explode('|',$responseContrat[0]['save']);
                                                             $rest=[];
                                                             $v ='abcdef';
                                        for ($i=0; $i <sizeof($responses) ; $i++) { 
                                           //array_push($rest, substr($responses[$i], 0, 1));
                                            if(strlen($responses[$i])=='9'){

                                           array_push($rest,substr($responses[$i], strlen($responses[$i])-9, strlen($responses[$i])-7));
                                            }else if(strlen($responses[$i])=='8'){
                                                 array_push($rest,substr($responses[$i], strlen($responses[$i])-8, strlen($responses[$i])-7));
                                            }else if(strlen($responses[$i])=='10'){
                                                 array_push($rest,substr($responses[$i], strlen($responses[$i])-10, strlen($responses[$i])-7));
                                            }
                                           //substring(savedQMs[i].length-9, savedQMs[i].length-7));

                                        }
                                         
                                            foreach ($Listesquestions as $key => $value) {
                                             
                                             if (in_array($value['idm'], $rest)){
                                                    $resultat='OUI';
                                             }else{
                                                     $resultat='NON';
                                             }
                                             echo '<tr><td colspan="3">'.$value['libelle'].'</td><td>'.$resultat.'</td></tr><tr ><td colspan="5"></td></tr>';
                                   
                                            }

                                         ?>
                                         <tr><td colspan="5"> <h5> Je suis informé que toutes fausses déclarations entrainent la nullité du contrat. </h5></td> </tr>
                                      

                                   

                                    <tr class="lg">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center; ">PRIME D'ASSURANCE</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                   
                                    <tr>
                                        <td style="text-align:right;font-size:12px;">PRIME TTC :</td>
                                        <td style="text-align:left;font-size:12px;"><?php 
                                            /*$responses= explode('|@', $responseContrat[0]['save']);
                                            $response=implode('', $responses);*/
                                        echo number_format($responseContrat[0]['primeassurance'],0,',','.').' FCFA'?></td>
                                        <td></td>
                                        <td style="font-size:12px;">TAUX DE PRIME :</td>
                                        <td style="font-size:12px;"><?php echo (float) str_replace(",",".",$responseContrat[0]['tauxprimes']).'%'; ?></td>
                                    </tr>
                                    <tr class="lg">
                                        <td colspan="5"><br></td>
                                    </tr>

                                   <!--   <tr class="lg">
                                        <td colspan="5"  style="text-align:center;">DETAIL DE LA PRIME</td>
                                    </tr>
                            
                                    <tr >
                                        <td >PRIME DECES</td>
                                        <td><php echo number_format($responseContrat[0]['primedeces'],0,',','.').' FCFA'; ?></td>
                                        <td></td>
                                        <td>PRIME NETTE</td>
                                        <td><php $primenette= $responseContrat[0]['primedeces']+$responseContrat[0]['primeperte']+$responseContrat[0]['montantsupprime'];echo number_format($primenette,0,',','.').' FCFA';?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>PRIME PERTE EMPLOI</td>
                                        <td><php echo number_format( $responseContrat[0]['primeperte'],0,',','.').' FCFA';?></td>
                                        <td></td>
                                        <td>ACCESSOIRES</td>
                                        <td><php echo number_format( $responseContrat[0]['accessoires'],0,',','.').' FCFA';?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>SURPRIME</td>
                                        <td><php echo number_format($responseContrat[0]['montantsupprime'],0,',','.').' FCFA'; ?></td>
                                        <td></td>
                                        <td>PRIME TTC</td>
                                        <td><php echo number_format($responseContrat[0]['primeassurance'],0,',','.').' FCFA';?></td>
                                    </tr>

                                    <tr class="lg">
                                        <td colspan="5"><br></td>
                                    </tr>
 -->                                           

                                            <!-- 
                                             co.idcontrat,co.numcontrat,co.numeropret,co.status,co.idbanque,co.idagence,co.nom,co.prenom,co.datenaissance,co.sexe,co.profession,
                                              co.capital,co.dateeffet,co.duree,co.dateecheance,co.tauxemprunt,co.reglementprime,
                                              co.periodicite,co.differe,co.perteemploi,co.remboursement,co.tauxprimes,co.primeassurance,
                                              co.primedeces,co.iduser,co.primeperte,co.accessoires,co.totalesupprime,co.niveau,co.save,ban.id as idbanque,
                                              agen.idagence,agen.libelle as libelleagence,ban.libelle as banquelibelle,ban.logo";
                                              $table="contrat as co INNER JOIN banque as ban 
                                                    ON co.idbanque=ban.id INNER JOIN agence as agen
                                                         ON co.idagence=agen.idagence"; 
                                      


                                    <tr class="lg">  
                                        <td colspan="5" > Fait &agrave; <?php echo $responseContrat[0]['ville']; ?> le <?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                    <tr>
                                        <td> L'ASSURE <br>Précedé de la mention "Lu et approuvé".</td>
                                        <td colspan="3" style="text-align:center;">LE BENEFICIAIRE</td>
                                        <td style="text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            SUNU &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <?php 

                                                if ($responseContrat[0]['capital']<=$parametreList[0]['capitalmax']) {
                                                        echo'<td colspan="5" style="text-align:right;"><img src="../img/signature/signature.PNG" width="134" height="60"></td>';
                                                    
                                                }
                                          ?>
                                    </tr>   
                                    <tr>
                                        <td colspan="5"><br><br><br></td>
                                    </tr>
                                    <tr class="lg">
                                        
                                    </tr>
                               
                                    <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                    
                                    <tr class="lg"> 

                                          <td colspan="5"><br></td>
                                    </tr>
                                   <tr >
                                       <td><?php echo 'Le gestionnaire : '.$nom.' '.$prenom; ?></td>
                                    </tr>                       
                              
                            </table>
                            </div>   
                           
</page>
<page_footer style="padding-left:20% !important; text-align:center;">

                                        <?php foreach ($coassureurList as $key => $value) {
                                                    echo ' <img src="../typepretFolder/imagecoassureur/'.$value['logo'].'" alt="Logo Saham ASSURANCE" width="134" height="60" style="margin-left:20px !important" />';
                                                } ?>
   
</page_footer>
<?php
$content=ob_get_clean();
require('../html2pdf_v4.03/html2pdf.class.php');


   try
    {
        $pdf= new HTML2PDF('P','A4','fr');
        $pdf->writeHTML($content);
if (ob_get_contents()) ob_end_clean();
      $pdfr=$pdf->Output('BIA.pdf');
      echo  $pdfr;
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


?>
