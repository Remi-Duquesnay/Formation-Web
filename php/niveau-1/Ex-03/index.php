<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 3 - Comparaisons</title>
	</head>
	<body>
		
		<?php
			function estIlMajeur(int $age){
				$majeur = false;
				if($age >= 18){
					$majeur = true;
				}
				return $majeur;
			}
			echo estIlMajeur(25);
			echo "<br>";
			echo estIlMajeur(7);
			echo "<br>";
			
			function plusGrand($arg1, $arg2){
				return max($arg1,$arg2);
			}
			echo plusGrand(15,35);
			echo "<br>";
			echo plusGrand(35,15);
			echo "<br>";
			
			function plusPetit($arg1, $arg2){
				return min($arg1,$arg2);
			}
			echo plusPetit(15,35);
			echo "<br>";
			echo plusPetit(35,15);
			echo "<br>";
			
			function lePlusPetit($arg1, $arg2, $arg3){
				return min($arg1,$arg2,$arg3);
			}
			
			echo lePlusPetit(10, 20, 30);
			echo "<br>";
			echo lePlusPetit(22, 33, 11);
			echo "<br>";
			echo lePlusPetit(35, 15, 25);
		?>
		
	</body>
</html>