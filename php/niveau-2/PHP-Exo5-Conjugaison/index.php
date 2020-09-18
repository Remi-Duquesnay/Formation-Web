<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo5-Conjugaison</title>
	</head>
	<body>
		
		<?php
			function conjugaison($str){
				$size = strlen($str)-1;
				if($size<=15 && !preg_match('/\s/',$str)){
					$newStr = substr($str,0,$size-1) ;
					echo "Je " . $newStr ."e <br>";
					echo "Tu " . $newStr ."es <br>";
					echo "Il/elle " . $newStr ."e <br>";
					if(substr($str, $size-2)== "ger" ){
						echo "Nous " . $newStr ."eons <br>";
					}else{
						echo "Nous " . $newStr ."ons <br>";
					}
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