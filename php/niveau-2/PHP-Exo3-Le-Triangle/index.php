<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo3-Le-Triangle</title>
	</head>
	<body>
		
		<?php
			function triangle($nbLigns){
				echo "<p style=\"text-align: center\">";
				$stars = 0;
				for($i=0;$i<$nbLigns;$i++){
					for($j=0;$j<=$stars;$j++){
						echo "**";
					}
					echo "<br>";
					$stars++;
				}
			}
			
			triangle(10);
		?>
		
	</body>
</html>