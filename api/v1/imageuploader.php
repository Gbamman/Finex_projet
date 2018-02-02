<?php
if(isset($_FILES["file"]["name"])){
	$response = array();
		$fileName = $_FILES["file"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file"]["type"]; // The type of file it is
		$fileSize = $_FILES["file"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true 		 
		$extensions_valides = array('jpg','png','gif','jpeg','JPG','JPEG','PNG','GIF');  
		$extension =  strtolower(  substr( strrchr($_FILES['file']['name'], '.'),1));
		$dossier = '../../Banque/imagesBanque/'; 
		$nom = md5(uniqid(rand(), true));
		/*echo json_encode($data);*/
		/*echo $data;*/
		
		if (!$fileTmpLoc) 
		{ 
				 $response['status'] = "error";
            	$response['message'] = "Un petit Oubli: Attention vous devez choisir un fichier avant de lancer le chargerment.";
            	
			exit();
		}
		if(!in_array($extension, $extensions_valides)){
			 	$response['status'] = "error";
            	$response['message'] = "Vous devez choisir un fichier au format JPG,PNG ou GIF.";
			  
		}else{
					
		/*	if(file_exists($dossier.'Banque.'.$extension)){
				rename ($dossier.'Banque.'.$extension,$dossier.'Banque.'.$nom.'.'.$extension);
				$fileNameCallback= 'Banque.'.$nom.'.'.$extension;
			}*/
			if(rename ($fileTmpLoc,$dossier.'Banque'.$nom.'.'.$extension)){ 

				 	$response['status'] = "success";
            		$response['message'] = 'Chargement reussi';
            		$fileNameCallback='Banque'.$nom.'.'.$extension;
            	  }
            	}

}else{

		 $fileNameCallback='';
}
		
            	echo ($fileNameCallback);

?>
