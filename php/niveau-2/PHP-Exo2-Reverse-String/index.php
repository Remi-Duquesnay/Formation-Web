<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo2-Reverse-String</title>
	</head>
	<body>
		
		<?php
			function reverse_str($str){
				$length = strlen($str);
				$newStr = "";
				for($i=$length;$i>=0;$i--){
					$newStr .= $str[$i];
				}
				echo $str;
				echo "<br>";
				echo $newStr;
			}
			
			reverse_str("oiqzief rqeon");
		?>
		
	</body>
</html>