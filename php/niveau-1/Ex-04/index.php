<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 4 - Tableaux</title>
	</head>
	<body>
		
		<?php
			function premierElementTableau($tab){
				if(empty($tab)){
					return "null";
				}else{
					return $tab[0];
				}
			}
			$test = array(25,65,85,45);
			$test2 = array();
			echo premierElementTableau($test);
			echo "<br>";
			echo premierElementTableau($test2);
			echo "<br>";
			
			function dernierElementTableau($leghtTest){
				if(empty($leghtTest)){
					return "null";
				}else{
					return end($leghtTest);
				}
			}
			$leghtTest = array(25,65,85,45);
			$leghtTest1 = array(25,65,85,45,15);
			$leghtTest2 = array(25,65,85,45,16,81);
			$leghtTest3 = array();
			echo dernierElementTableau($leghtTest);
			echo "<br>";
			echo dernierElementTableau($leghtTest1);
			echo "<br>";
			echo dernierElementTableau($leghtTest2);
			echo "<br>";
			echo dernierElementTableau($leghtTest3);
			echo "<br>";
			
			$biggestTest = array(25,86,95,745,566,58,1,2);
			$biggestTest1 = array(65,85,95,7,5,6,12,86,18);
			$biggestTest2 = array(156,8,156,865,1,5,1,981,1);
			$biggestTest3 = array();
			function plusGrand($biggestTest){
				if(empty($biggestTest)){
					return "null";
				}else{
					return max($biggestTest);
				}
			}
			echo plusGrand($biggestTest);
			echo "<br>";
			echo plusGrand($biggestTest1);
			echo "<br>";
			echo plusGrand($biggestTest2);
			echo "<br>";
			echo plusGrand($biggestTest3);
			echo "<br>";
		?>
		
	</body>
</html>