    <?php

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

  ?>