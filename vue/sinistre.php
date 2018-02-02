<?php
session_start();
require_once '../api/config.php';
require_once '../api/v1/dbHelper.php';
require_once '../api/v1/sinistrePdf.php';
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


 <page backtop="5mm" backbottom="5mm" backleft="1mm"   style="font-size: 9px"> 
                            <div class="main">    
                             <table>
                            <tr>          
                                <td colspan="4" style="text-align:center;padding-left:200px;"><br><h6>ASSURANCE PROTECTION EMPRUNTEUR</h6> 
                                   
                                <h5>        FICHE DE PRESTATION N&deg; <?php echo $prestationPdf[0]['idsinistre']; ?>
                                </h5>                       
                                
                                </td>
                               <td colspan="2" style="text-align:center;">
                                    <img src="../Banque/imagesBanque/<?php echo $prestationPdf[0]['logo']; ?>" alt="Logo BANQUE" width="120" height="75" style="margin-top:10px;"/>
                                </td>
                            </tr>
                                    <!-- ligne vide -->
                                    <tr class="lg" >
                                        <td colspan="5"><br></td>
                                    </tr>
                                    
                                    <!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5"  style="text-align:center;">INFORMATIONS GENERALES SUR LE CONTRAT</td>
                                       
                                    </tr>
                                    <tr >
                                        <td >AGENCE</td>
                                        <td><?php echo $prestationPdf[0]['libelleagence'];?></td>
                                        <td><br/></td>
                                        <td>NUMERO DU CONTRAT OU DU BIA</td>
                                        <td><?php echo $prestationPdf[0]['numerocontrat'];?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>NOM ET PRENOM DE L'ASSUREUR</td>
                                        <td><?php echo $prestationPdf[0]['identifiantassure'];?></td>
                                        <td><br/></td>
                                        <td>DATE D'EFFET</td>
                                        <td><?php echo dateUS2FR($prestationPdf[0]['dateeffet']);?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DATE D'ECHEANCE</td>
                                        <td><?php echo dateUS2FR($prestationPdf[0]['dateecheance']);?></td>
                                        <td><br/></td>
                                        <td>CAPITAL</td>
                                        <td><?php echo number_format($prestationPdf[0]['capital'],0,',','.').' FCFA'; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>PRIME PAYEE</td>
                                        <td><?php echo number_format($prestationPdf[0]['primeassurance'],0,',','.').' FCFA'; ?></td>
                                        <td><br/></td>
                                        <td>NOM DU DECLARANT</td>
                                        <td><?php echo  $prestationPdf[0]['nomdeclarant'] ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;">INFORMATION SUR LA PRESTATIONS</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td >PRESTATION</td>
                                        <td><?php echo $prestationPdf[0]['libelle'];?></td>
                                        <td><br/></td>
                                        <td>DATE DU REGLEMENT</td>
                                        <td><?php if(isset($prestationPdf[0]['datereglement']) AND validateDate($prestationPdf[0]['datereglement'], 'Y-m-d') === true)  echo dateUS2FR($prestationPdf[0]['datereglement']);else echo ''; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DATE DE DECLARATION</td>
                                        <td><?php if(isset($prestationPdf[0]['datedeclaration']) AND validateDate($prestationPdf[0]['datedeclaration'], 'Y-m-d') === true)  echo dateUS2FR($prestationPdf[0]['datedeclaration']);else echo ''; ?></td>
                                        <td><br/></td>
                                        <td>MONTANT REGLE</td>
                                         <td><?php if(isset($prestationPdf[0]['montantregle']) AND $prestationPdf[0]['montantregle'] !=null)  echo $prestationPdf[0]['montantregle'];else echo '....'; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>MONTANT ATTENDU</td>
                                        <td><?php if(isset($prestationPdf[0]['montantattendu']) AND $prestationPdf[0]['montantattendu'] !=null)  echo $prestationPdf[0]['montantattendu'];else echo '...'; ?></td>
                                        <td><br/></td>
                                        <td>DATE DU SURVENANCE</td>
                                        <td><?php if(isset($prestationPdf[0]['datesurvenance']) AND validateDate($prestationPdf[0]['datesurvenance'], 'Y-m-d') === true)  echo dateUS2FR($prestationPdf[0]['datesurvenance']);else echo ''; ?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>OBSERVATIONS</td>
                                        <td><?php if(isset($prestationPdf[0]['observations']) AND $prestationPdf[0]['observations'] !=null)  echo $prestationPdf[0]['observations'];else echo ''; ?></td>
                                        <td><br/></td>
                                        <td><?php if(isset($prestationPdf[0]['coassureur']) AND $prestationPdf[0]['coassureur'] === 'ARGG')  echo 'NOM DU CO-ASSUREUR';else echo 'NOM DE L\'ASSUREUR'; ?></td>
                                        <td><?php if(isset($prestationPdf[0]['coassureur']) AND $prestationPdf[0]['coassureur'] !=null)  echo $prestationPdf[0]['coassureur'];else echo ''; ?></td>
                                    </tr>
                                       <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5" style="text-align:center;">PIECES A FOURNIR</td>
                                    </tr>
                                     <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <!-- //ligne vide -->
                                        <?php 
                                         $responses=explode('@|',$prestationPdf[0]['pieces']);
                                            foreach ($sinistrePieceList as $key => $value) {
                                             
                                             if (in_array($value['idpiece'], $responses)){
                                                    $resultat='OUI';
                                             }else{
                                                     $resultat='NON';
                                             }
                                             echo '<tr><td colspan="3">'.$value['libellepiece'].'</td><td>'.$resultat.'</td></tr><tr ><td colspan="5"></td></tr>';
                                   
                                            }

                                         ?>
                                         <tr> <td colspan="5">
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                        </td></tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr> 
                                             <!-- <tr>
                                        <td colspan="5" style="visibility: hidden !important;">Je reconnais avoir re&ccedil;u la notice d'information précisant les principales dispositions au contrat d'assurance. 
                                        Je d&eacute;clare sur honneur &ecirc;tre en bonne sant&eacute;, ne pas suivre de traitement m&eacute;dical r&eacute;gulier
                                        et exercer une activit&eacute; stable &agrave; plein temps. Je suis inform&eacute;(e) que conform&eacute;ment au code CIMA toute fausse d&eacute;claration 
                                        entraine la nullit&eacute; du contrat.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                     -->
                                    <tr class="lg">
                                        <td colspan="5"><br></td>
                                    </tr>
                                    <tr class="lg">  
                                        <td colspan="5" > Fait &agrave; Cotonou le <?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                    <tr>
                                        <td> LE DECLARANT</td>
                                        <td colspan="3" style="text-align:center;">LE BENEFICIAIRE</td>
                                        <td style="text-align:right;">SAHAM ASSURANCE VIE</td>
                                    </tr>
                                   <!--  <tr>
                                        <td colspan="5" style="text-align:right;"><img src="../img/signature/signDAR.PNG" width="134" height="60"></td>
                                    </tr> -->   
                                    <tr>
                                        <td colspan="5"><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
                                    </tr>
                                  
                                                  
                              
                            </table>
                            </div>   
                           
</page>
<page_footer style="padding-left:20% !important; text-align:center;">

                                        <?php foreach ($coassureurList as $key => $value) {
                                                    echo ' <img src="../typepretFolder/imagecoassureur/'.$value['logo'].'" alt="Logo ARGG" width="134" height="60" style="margin-left:20px !important" />';
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
      $pdf->Output('prestation.pdf'); 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


?>
