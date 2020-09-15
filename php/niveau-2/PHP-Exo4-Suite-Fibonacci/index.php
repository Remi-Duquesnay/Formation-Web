<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo4-Suite-Fibonacci</title>
	</head>
	<body>
		
		<?php
			function fibonacci($nbMonth){
			$nbr1 = 0;
			$nbr2 = 1;
				for($i = 0;$i < $nbMonth - 1; $i++){
					echo $nbr1." ".$nbr2." ";
					$next = $nbr1 + $nbr2;
					$nbr1 = $nbr2;
					$nbr2 = $next;
				}
				$rabbit = $next;
				echo "<br>" .$rabbit;
			}
			
			fibonacci(12);
		?>
		
	</body>
</html>