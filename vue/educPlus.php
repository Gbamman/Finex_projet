<?php
session_start();
require_once '../api/config.php';
require_once '../api/v1/dbHelper.php';
require_once '../api/v1/educplusPdf.php';
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
    table   td .case {
        border-right: 1px solid #000;border-bottom: 1px solid #000;border-left:1px solid #000;
    }   

    table   td .case50 {
       width:50px;height:10px; text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }  
    table   td .case60 {
       width:60px;height:10px; text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }  
    table   td .case20 {
       width:20px;height:10px; text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }  

    table   td .case10 {
       width:10px;height:10px;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    } 
     table   td .case80 {
        width:80px;height:10px;text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }   
     table   td .case100 {
        width:100px;height:10px;text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }   
    table   td .case200 {
        width:200px;height:10px;text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }   
  table   td .case400 {
        width:400px;height:10px;text-align:center;display:inline;margin-left:5px;margin-right:5px;font-weight: bold;
    }   

    table   td .casecoche {
       width:10px;height:10px; display:inline;margin-left:5px;margin-right:5px;background: #000;
    } 
 --> 
 </style>


 <page backtop="5mm" backbottom="5mm" backleft="1mm"   style="font-size: 8.5px"> 






            
                            <div class="main">     
                             <table >


                        
                           
                            <tr>          
                                <td colspan="2" style="text-align:left;">
                                     <?php foreach ($coassureurList as $key => $value) {
                                                    echo '<img src="../typepretFolder/imagecoassureur/'.$value['logo'].'" alt="Logo Saham ASSURANCE" width="200" height="70" style="margin-top:10px;"/>';
                                                } 
                                        ?>
                                </td>
                                <td colspan="4" style="text-align:center;"><br><h6></h6> 
                                   
                                <h5>         
                                   <?php ?>
                                </h5>                       
                                </td>
                            </tr>
                                    <!-- ligne vide -->
                                    <tr class="lg" >
                                        <td colspan="5"><br></td>
                                    </tr>
                                    
                                    <!-- //ligne vide -->
                                    <tr class="lg">
                                        <td colspan="5"  style="text-align:center;font-weight: bold;">SOUSCRIPTEUR</td>
                                    </tr>
                                    <tr> 
                                        <td>Nom du souscripteur</td>
                                        <td><?php echo $responseContrat[0]['civilite'].' '. $responseContrat[0]['nom'].' '.$responseContrat[0]['prenom'];?></td>
                                        <td></td>
                                        <td>Nom de jeune fille: -------------------------------------</td>
                                        <td></td>
                                    </tr>
                                   <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr> 
                                        <td>BOITE POSTALE</td>
                                        <td><?php echo $responseContrat[0]['boitepostal'];?></td>
                                        <td></td>
                                        <td>Ville</td>
                                        <td>COTONOU</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>N° Acte de Naissance ou jugement Suppletif </td>
                                         <td><?php echo  $responseContrat[0]['numpiece'];?></td>  
                                         <td></td>
                                        <td> TELEPHONE:</td>
                                        <td><?php echo $responseContrat[0]['telephone'];?></td>
                                    </tr>
                                   <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $responseContrat[0]['email']; ?></td>
                                        <td></td>
                                        <td>DATE DE NAISSANCE :</td>
                                        <td> <?php echo dateUS2FR($responseContrat[0]['datenaissance']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                         <td>Preofession du souscripteur</td>
                                        <td><?php if(isset($responseContrat[0]['profession'])) echo $responseContrat[0]['profession'];else echo '';?></td>
                                        <td></td>
                                        <td>Description de l'activite ou structure de l'emploi</td>
                                        <td></td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;font-weight: bold;">PERSONNE A ASSURER</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                   <tr> 
                                        <td>Nom</td>
                                        <td><?php echo $responseContrat[0]['civiliteAssure'].' '. $responseContrat[0]['nomAssure'].' '.$responseContrat[0]['prenomAssure'];?></td>
                                        <td></td>
                                        <td>Nom de la jeune filles</td>
                                        <td></td>
                                    </tr>
                                   <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr> 
                                        <td>BOITE POSTALE</td>
                                        <td><?php echo $responseContrat[0]['boitepostalAssure'];?></td>
                                        <td></td>
                                        <td>VILLE</td>
                                        <td>COTONOU</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>N° Acte de Naissance ou jugement Suppletif</td>
                                        <td><?php echo  $responseContrat[0]['numpieceAssure'];?></td>
                                        <td></td>
                                        <td>TELEPHONE</td>
                                        <td><?php echo $responseContrat[0]['telephoneAssure'];?></td></tr>
                                   <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>DATE DE NAISSANCE:</td>
                                        <td><?php echo dateUS2FR($responseContrat[0]['datenaissanceAssure']); ?></td>
                                        <td></td>
                                        <td>Email:</td>
                                        <td><?php echo $responseContrat[0]['emailAssure']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                         <td>Preofession de l'assuré</td>
                                         <td><?php if(isset($responseContrat[0]['profession'])) echo $responseContrat[0]['profession'];else echo '';?></td>
                                        <td></td>
                                        <td>Description de l'activite ou structure de l'emploi</td>
                                        <td>---</td>
                                    </tr>
                                    <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;font-weight: bold;">BENEFICIAIRES DES GARANTIES SOUSCRITES</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td> Du capital, l'assuré etant en vie</td>
                                    </tr>
                                      <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td><div class="case case10"></div> Souscripteur 
                                            <div class="case case10"></div> L'assuré(e)
                                            <div class="case case10"></div> Autre personne
                                        </td>
                                    </tr>
                                      <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                     <tr> 
                                        <td colspan="5">
                                                <div class="case case10"></div> Le conjoint , à défaut les enfants nés et à naîttre, à défaut les héritiers de l'assuré(e).
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                    <tr>
                                         <td colspan="5">
                                            <div class="case case10"></div> Autre personne : <?php echo $responseContrat[0]['civilite'].'  '.$responseContrat[0]['nom1'].' '.$responseContrat[0]['prenom1'];?>
                                        </td>
                                    </tr>
                                      <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;font-weight: bold;">NATURES DES GARANTIES</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>Rente en cas de deces</td>
                                        <td><?php echo $responseContrat[0]['pourcentagerente'].'%';?></td>
                                        <td></td>
                                        <td>Montant</td>
                                       <td><?php echo number_format($responseContrat[0]['renteannuelle'])?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>Rente en cas de vie (*)</td>
                                        <td><?php echo $responseContrat[0]['renteannuelle'].' FCFA'; ?></td>
                                        <td></td>
                                        <td>Date d'effet</td>
                                        <td><?php echo dateUS2FR($responseContrat[0]['dateeffet']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Duree de differe</td>
                                        <td><?php echo $responseContrat[0]['dureecontrat'];?></td> 
                                        <td></td>
                                        <td >Duree Totale (Rente+Differe)</td>
                                        <td>50</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;font-weight: bold;">PRIMES</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>Le prélèvement des prime sera : </td>
                                        <td><?php echo $responseContrat[0]['periodicite']?></td>
                                        <td></td>
                                        <td>Montant prime fractionnée(*):</td>
                                        <td><?php echo number_format($responseContrat[0]['prime']).' FCFA'?></td>
                                    </tr>
                                      <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5">(*) Montant susceptible de majoration après analyse de la présente proposition 
                                               
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                     <tr>
                                        <td>Je soussigné (e) </td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5">demande &agrave; SAHAM ASSURANCE VIE, l'etablissement des conditions particulières du contrat.</td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                     <tr>
                                        <td colspan="5">
                                            Fait &agrave; <div class="case200"></div> Le<div class="case200"></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                    <tr>
                                        <td> Le souscripteur.</td>
                                        <td colspan="3" style="text-align:center;">L'assuree</td>
                                        <td style="text-align:right;">Le realisateur</td>
                                    </tr>
                                     <tr>
                                        <td colspan="5"><br><br><br></td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:center;font-weight: bold;">ORDRE DE VIREMENT PERMANENT</td>
                                    </tr>
                                     <tr class="lg">
                                        <td colspan="5"></td>
                                    </tr>   
                                    <tr>
                                            <td>Code interbancaire</td>
                                            <td>125</td>
                                            <td></td>
                                            <td>N° de compte</td>
                                            <td>002016</td>
                                    </tr> 
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td>Clé :</td>
                                        <td>01254</td>
                                        <td></td>
                                        <td>Domiciliation</td>
                                        <td>ORABANK</td>
                                    </tr>
                                    <tr>
                                            <td colspan="5"></td>    
                                    </tr>
                                     <tr>
                                        <td>Titulaire du compte</td>
                                        <td>GBAMMAN ROSEBELLE</td>
                                        <td></td>
                                        <td>Montant </td>
                                        <td>1 000 000</td>
                                    </tr>
                                    <tr>
                                            <td colspan="5"></td>    
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>   
                                            <td>Date effet</td>
                                            <td><?php echo dateUS2FR($responseContrat[0]['dateeffet']); ?></td>    
                                            <td></td>    
                                            <td>Durée</td> 
                                             <td><?php echo $responseContrat[0]['dureecontrat']; ?></td>  
                                    </tr>
                                     <tr>
                                        <td colspan="5"></td>
                                    </tr>  
                                    <tr>
                                            <td>Periodicite</td> 
                                            <td><?php echo $responseContrat[0]['periodicite']; ?></td> 
                                            <td></td>
                                            <td>Date</td> 
                                            <td>10/02/2016</td>   
                                               
                                    </tr>
                                     <tr>
                                        <td colspan="5"><br></td>
                                    </tr>
                                    <tr>
                                            <td colspan="5">Signature</td>    
                                               
                                    </tr>

                                      <tr>
                                        <td colspan="5"><br><br><br></td>
                                    </tr>
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
                                        </td></tr>
                                  
                                     <tr>
                                        <td colspan="5"> Je vous prie de bien vouloir debiter &agrave; la condition qu'il presente les provisions nécessaires,mon compte du montant de l'ordre de virement permanent que j'ai émis en la faveur de SAHAM ASSURRANCE VIE. En cas de litige sur le montant ou pour autre motif, je reglerai le differend avec SAHAM ASSURANCE VIE. </td>
                                    </tr>
                                     
                            </table>
                            </div>   
                           
</page>
<page_footer style="padding-left:20% !important; text-align:center; ">

                                        <?php foreach ($coassureurList as $key => $value) {
                                                   // echo ' <img src="../typepretFolder/imagecoassureur/'.$value['logo'].'" alt="Logo Saham ASSURANCE" width="134" height="50" style="margin-left:20px !important; display:none;" />';
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
