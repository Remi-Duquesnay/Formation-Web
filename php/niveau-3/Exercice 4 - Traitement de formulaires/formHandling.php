<?php
	$nameErr = $emailErr = $telErr = $addressErr = $zipCodeErr = "";
	
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
		if(empty($_POST["name"])) {
			$nameErr = "Le nom complet(Nom Prénom) est requis";
			$valid = false;
		}
		if(empty($_POST["email"])) {
			$emailErr = "Une adresse E-mail est requise";
			$valid = false;
			}else{
			$matches = preg_match_all("/@/", $_POST["email"]);
			if($matches != 1){
				$emailErr = "Une adresse E-mail doit contenire au moins un \"@\" mais pas plus.";
				$valid = false;
			}
		}
		if(empty($_POST["tel"])) {
			$telErr = "Le numéro de téléphone est requis";
			$valid = false;
			}else{
			if(!preg_match("/[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/", $_POST["tel"])){
				$telErr = "Le numero de téléphone doit être au format : 00 00 00 00 00";
				$valid = false;
			}
		}
		if(empty($_POST["address"])) {
			$addressErr = "L'adresse est requise";
			$valid = false;
		}
		if(empty($_POST["zipCode"])) {
			$zipCodeErr = "Le code postal est requis";
			$valid = false;
			}else{
			if(!preg_match("/[0-9]{5}/", $_POST["zipCode"])){
				$zipCodeErr = "Le code postale doit être su format : 00000";
				$valid = false;
			}
		}
		if($valid === true){
			$personalInfo["name"] = test_input($_POST["name"]);
			$personalInfo["email"] = test_input($_POST["email"]);
			$personalInfo["tel"] = test_input($_POST["tel"]);
			$personalInfo["address"] = test_input($_POST["address"]);
			$personalInfo["zipCode"] = test_input($_POST["zipCode"]);
			
			echo "<table border=1>";
			foreach($personalInfo as $x => $x_value){
				echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
			}
			echo "</table>";
		}
	}
	
	
?>