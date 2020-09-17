<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo 3 - Compteur et Nombre de visite</title>
	</head>
	<body>
		
		<?php
			if(file_exists("counter.txt")){
				$file = fopen("counter.txt", "r");
				$count = fread($file,filesize("counter.txt"));
				fclose($file);
				$count++;
			}else{
				$count = "1";
			}
			$file = fopen("counter.txt", "w");
			fwrite($file, $count);
			fclose($file);
			echo $count." visites sur cette page.";
		?>
		
	</body>
</html>