<!DOCTYPE html>
<?php
	if(!isset($_COOKIE["dateVisite"])){
	$cokkieValue = date("d/m/Y H:i:s");
	}else{
	$cokkieValue =  $_COOKIE["dateVisite"]."-".date("d/m/Y H:i:s");
	}
	setcookie("dateVisite", $cokkieValue, time() + 60 * 60 *24);
?>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 1 - Les Cookies</title>
	</head>
	<body>
		<?php
			if(isset($_COOKIE["dateVisite"])){
				$visites = explode("-", $_COOKIE["dateVisite"]);
				$length = count($visites)-1;
				echo "Vous avez consulté cette page ".($length+1)." fois, voici les details :<br><ul>";
				for($i=0; $i<$length; $i++){
					echo "<li>".$visites[$i]."</li>";
				}
				echo "<li>".date("d/m/Y H:i:s")."</li>";
			}else{
				echo "C'est votre première visite : ".date("d/m/Y H:i:s");
			}
		?>	
		
	</body>
</html>