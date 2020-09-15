<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 2 - Opérations arithmétiques</title>
	</head>
	<body>
		
		<?php
			function somme($arg1, $arg2){
				return $arg1 + $arg2;
			}
			
			function soustraction($arg1, $arg2){
				return $arg1 - $arg2;
			}
			
			function multiplication($arg1, $arg2){
				return $arg1 * $arg2;
			}
			
			echo somme(6, 7);
			echo "<br>";
			echo soustraction(4, 8);
			echo "<br>";
			echo multiplication(5, 6);
		?>
		
	</body>
</html>