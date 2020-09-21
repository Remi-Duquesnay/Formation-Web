<?php
	include('upload.php');
	
	$succes = $player1Err = $player2Err = $idGameErr = $addressErr = $winnerErr = $imgErr = $winner = "";
	
	function test_input($data) {
		$data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
		$data = stripslashes($data); //Remove backslashes
		$data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// echo "<table border=1>";
		// foreach($_POST as $x => $x_value){
			// echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
		// }
		// echo "</table>";
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
		if($_FILES["screenshot"]["name"] != ""){
			$imgErr = checkFile();
			if($imgErr != "" ){
				$valid = false;
			}
		}else{
			$imgErr = "Veulliez selectionner un fichier.";
			$valid = false;
		}
		
		if($valid === true){
			foreach($_POST as $index => $value){
				if($index != "submit"){
					$personalInfo[$index] = test_input($_POST[$index]);
				}
			}
			if($personalInfo["winner"] == "player1"){
				$personalInfo["winner"] = $personalInfo["player1"];
			}else{
				$personalInfo["winner"] = $personalInfo["player2"];
			}
			
			// echo "<table border=1>";
			// foreach($personalInfo as $x => $x_value){
				// echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
			// }
			// echo "</table>";
			
			upload($personalInfo["player1"],$personalInfo["player2"],$personalInfo["winner"],$personalInfo["idGame"]);
			
			$succes = "Envoi du formulaire réussi, et screenshot uploadé!";
		}
	}
	
	
	
?>			