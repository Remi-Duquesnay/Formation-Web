<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo1-Conjecture-Syracuse</title>
	</head>
	<body>
		
		<?php
			function syracuse($nbIntPos){
				if(is_int($nbIntPos) && $nbIntPos > 0){
					while($nbIntPos != 1){
						echo $nbIntPos . " ";
						if($nbIntPos % 2 == 0){
							$nbIntPos = $nbIntPos/2;
						}else{
							$nbIntPos = $nbIntPos*3+1;
						}
					}
					echo $nbIntPos;
				}
			}
			syracuse(25);
		?>
		
	</body>
</html>