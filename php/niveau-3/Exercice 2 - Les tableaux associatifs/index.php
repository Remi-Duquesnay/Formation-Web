<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 2 - Les tableaux associatifs</title>
	</head>
	<body>
		<?php
		
			$grades = array("Peter" => "15","Max" => "14","Sophie" => "18","Martin" => "10","Leo" => "13","Pierre" => "16","Mathieu" => "16","Lea" => "19");
			
			function displayGrades($array){
				$lowerGrade = min(array_filter($array));
				$higherGrade = max($array);
				echo "<table border=1 style=\"margin-right:5px\">";
				echo "<tr><td>Clé</td><td>Valeur</td></tr>";
				foreach($array as $x => $x_value){
					if($x_value == $lowerGrade){
						echo "<tr style=\"background-color: rgba(242, 70, 70,.5)\"><td>".$x."</td><td>".$x_value."</td></tr>";
					}else if($x_value == $higherGrade){
						echo "<tr style=\"background-color: rgba(111, 214, 71,.5)\"><td>".$x."</td><td>".$x_value."</td></tr>";
					}else{
						echo "<tr><td>".$x."</td><td>".$x_value."</td></tr>";
					}
				}
				echo "</table>";
			}
			echo "<div style=\"display:flex\">";
			displayGrades($grades);
			$grades["Anton"] = "10";
			displayGrades($grades);
			$grades["Sophie"] = "";
			displayGrades($grades);			
			ksort($grades,0);
			displayGrades($grades);
			arsort($grades,1);
			displayGrades($grades);
			echo "La moyenne de la classe est : " .array_sum(array_filter($grades)) / count(array_filter($grades));
			
			echo "</div>";
			
		?>	
		
	</body>
</html>