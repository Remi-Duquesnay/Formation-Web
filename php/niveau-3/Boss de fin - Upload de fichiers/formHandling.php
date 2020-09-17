<?php
	$player1Err = $player2Err = $idGameErr = $addressErr = $winnerErr = $imgErr = $winner = "";
	
	function test_input($data) {
		$data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
		$data = stripslashes($data); //Remove backslashes
		$data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		echo "<table border=1>";
		foreach($_POST as $x => $x_value){
			echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
		}
		echo "</table>";
		$valid = true;
		if(empty($_POST["player1"])) {
			$player1Err = "Nom ou pseudo du Joueur 1 requis";
			$valid = false;
		}
		if(empty($_POST["player2"])) {
			$player2Err = "Nom ou pseudo du Joueur 2 requis";
			$valid = false;
			
		}
		if(strlen($_POST["idGame"]) == 0){
			$idGameErr = "Identifiant du match requis";
			$valid = false;
			}else if(strlen($_POST["idGame"]) != 0 && $_POST["idGame"] < 1|| $_POST["idGame"] > 64){
			$idGameErr = "De 1 à 64 !!";
			$valid = false;
			
		}
		if(!isset($_POST["winner"])){
			$_POST["winner"] = "unknown";
		}
		// if(!isset($_FILES["screenshot"])){
			// $_FILES["screenshot"] = "none";
		// }
		// print_r($_FILES);
		
		if($valid === true){
			foreach($_POST as $index => $value)
			$personalInfo[$index] = test_input($_POST[$index]);
			$personalInfo["player2"] = test_input($_POST["player2"]);
			$personalInfo["idGame"] = test_input($_POST["idGame"]);
			
			
			echo "<table border=1>";
			foreach($personalInfo as $x => $x_value){
				echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
			}
			echo "</table>";
			
		}
		
		if($_FILES["screenshot"]["name"] != ""){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["screenshot"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["screenshot"]["tmp_name"]);
				if($check != false) {
					$uploadOk = 1;
					} else {
					$imgErr = "Le fichier n'est pas une image.";
					$uploadOk = 0;
				}
			
			}
		}
	}
	
	
	
?>	