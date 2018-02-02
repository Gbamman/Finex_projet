<?php
	ini_set('memory_limit', '-1'); 
	session_start();
	extract($_POST); 
	require_once("connect_d_emprunt1.php");
	$Connex1= new Connexion1();
	$con1=$Connex1->connect_d();
	$psd=$_SESSION['pseudo'];
	$ag=$_SESSION['agence'];
	$date=date("d/m/Y"); 
	
	$dat=date("y"); 
	
?>


	
<page backtop="5mm" backbottom="5mm" backleft="1.5mm" backright="1.5mm" style="font-size: 10.5px">
 
<page_footer >
	<table style="width: 100%;font-size: 5px; margin-top:30px;">
		<tr>
			<td style="text-align: left;    width: 95%"><span> <i>[SAHGES PRESTATION] Edit&eacute; par <?php echo $psd; ?> le <?php echo date('d/m/Y').' A '. date('H').'H'.date('i'); ?> </i></span></td>
		</tr>
	</table>
</page_footer>   
<table>
	<thead class="first">	 
		<tr>
			<td colspan="2"  > <img src="assets/img/logo_saham.jpg" alt="Logo Saham ASSURANCE" width="150" height="35" /> </td>
			<td colspan="7" >ETAT DES PRESTATIONS> </td>
			<td style="text-align: right; ">Page : [[page_cu]]/[[page_nb]]</td>
		</tr>
		<tr> 
			<td ><?php echo ('NUMERO') ;?></td>
			<td ><?php echo ('AGENCE');?></td>
			<td> <?php echo ('STATUT') ;?></td>
			<td ><?php echo ('NOM');?></td> 
			<td ><?php echo ('PRENOM');?></td>
			<td ><?php echo(' CAPITAL');?></td>
			<td ><?php echo ('DATE EFFET');?></td>
			<td ><?php echo ('DUREE');?></td>
			<td ><?php echo ('PRIME');?></td>			
			<td ><?php echo ('COMMISSION');?></td>
		</tr>				
		 		
	</thead>
	<tbody> 
		
	</tbody> 
</table> 
</page> 
 



