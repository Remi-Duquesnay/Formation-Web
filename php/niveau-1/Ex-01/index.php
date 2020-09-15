<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 1 - chaine de charactères</title>
	</head>
	<body>
		
		<?php
			function helloWorld(){
				return "HelloWorld";
			}
			function quiEstLeMeilleurProf(){
				return "Mon super formateur de dev web";
			}
			function jeRetourneMonArgument($arg){
				return $arg;
			}
			function concatenation($arg1, $arg2){
				return $arg1 . $arg2;
			}
			function concatenationAvecEspace($arg1, $arg2){
				return $arg1 . " " . $arg2;
			}
			echo helloWorld();
			echo "<br>";
			echo quiEstLeMeilleurProf();
			echo "<br>";
			echo jeRetourneMonArgument("ceci est mon argument");
			echo "<br>";
			echo concatenation("james", "bond");
			echo "<br>";
			echo concatenationAvecEspace("james", "bond");
		?>
		
	</body>
</html>