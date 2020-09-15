<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo5-Conjugaison</title>
	</head>
	<body>
		
		<?php
			function conjugaison($str){
				$index = strlen($str)-1;
				$strEnd = $str[$index-1] . $str[$index];
				if($index<=15 && !preg_match('/\s/',$str) && $strEnd == "er" ){
					$newStr = substr($str,0,$index-1);
					echo "Je " . $newStr ."e <br>";
					echo "Tu " . $newStr ."es <br>";
					echo "Il/elle " . $newStr ."e <br>";
					echo "Nous " . $newStr ."ons <br>";
					echo "Vous " . $newStr ."ez <br>";
					echo "Ils/elles " . $newStr ."ent <br><br>";
				}
			}
				conjugaison("programmer");
				conjugaison("manger");
				conjugaison("ceci est pour tester");
				conjugaison("pour tester");
				conjugaison("un test");
		?>
		
	</body>
</html>