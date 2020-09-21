<?php
	
	
	function checkFile(){
		$imgErr = "";
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["screenshot"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["screenshot"]["tmp_name"]);
			if($check == false) {
				$imgErr = "Le fichier n'est pas une image.";
			}
		}
		echo $target_file;
		// Check file size
		if ($_FILES["screenshot"]["size"] > 2000000) {
			$imgErr = "Fichier trop gros. 2Mo Max";
		} 
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$imgErr = "Seulement les formats jpg/jpeg/png sont autorisés";
		}
		return  $imgErr;
	}
	
	function upload($player1, $player2, $winner, $idGame){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["screenshot"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		echo  $target_file;
		// Check if file already exists
		if (file_exists($target_file)) {
			$i=1;
			while(file_exists($target_file)){
				$target_file.="$i";
				$i++;
			}
		}
		if (move_uploaded_file($_FILES["screenshot"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["screenshot"]["name"]). " has been uploaded.";
			$newFileName = $idGame."_".$player1."-VS-".$player2."_W-".$winner;
			if (file_exists($target_dir.$newFileName.".".$imageFileType)) {
				echo "file exist";
				$i=1;
				while(file_exists($target_dir.$newFileName."(".$i.")".".".$imageFileType)){
					echo $i;
					$i++;
				}
				$newFileName.="(".$i.")";
			}
			rename($target_file, $target_dir.$newFileName.".".$imageFileType );
			} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>