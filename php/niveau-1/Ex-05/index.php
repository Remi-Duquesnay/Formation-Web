<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exercice 5</title>
	</head>
	<body>
		
		<?php
			function verificationPassword($str){
				$pass = "false";
				if(strlen($str) >= 8 && preg_match("~[0-9]~", $str) &&  preg_match("~[a-z]~", $str) &&  preg_match("~[A-Z]~", $str)){
						$pass = "true";
				}
				return $pass;
			}
			echo verificationPassword("testgh,jgh,");
			echo "<br>";
			echo verificationPassword("testgh,jg5,");
			echo "<br>";
			echo verificationPassword("tEstgh,jg5,");
			echo "<br>";
			echo verificationPassword("test65466");
			echo "<br>";
			echo verificationPassword("Test65466");
			echo "<br>";
			
			function capital($str){
				$str = strtolower($str) ;
				switch($str){
				case "allemagne":
					echo "Berlin<br>";
					break;
				case "italie":
					echo "Rome<br>";
					break;
				case "maroc":
					echo "Rabat<br>";
					break;
				case "espagne":
					echo "Madrid<br>";
					break;
				case "portugal":
					echo "Lisbonne<br>";
					break;
				case "angleterre":
					echo "Londres<br>";
					break;
				default:
					echo "Inconnu<br>";
				}
			}
			capital("Allemagne");
			capital("Italie");
			capital("Maroc");
			capital("Espagne");
			capital("Portugal");
			capital("Angleterre");
			capital("USA");
			
			function listHTML($title, $list){
				if(!$title || !$list){
					return "null<br>";
				}
				$theList = "<h2>".$title."</h2><ul>";
				for($i=0;$i<count($list)-1;$i++){
					$theList .= "<li>".$list[$i]."</li>";
				}
				$theList .= "</ul><br>";
				return $theList;
			}
			
			echo listHTML("Capitales", ["Paris","Berlin","Rome","Rabat","Madrid","Lisbonne","Londres"]);
			echo listHTML("", ["Paris","Berlin","Rome","Rabat","Madrid","Lisbonne","Londres"]);
			echo listHTML("Capitales", []);
			
			echo "<br>";
			
			function remplacerLettres($str){
				$str = str_replace("e","3",$str);
				$str = str_replace("i","1",$str);
				$str = str_replace("o","0",$str);
				return $str;
			}
			echo remplacerLettres("Bonjour les amis")."<br>";
			echo remplacerLettres("La programmation Web est trop cool")."<br>";
			
			function quelleAnnee(){
				$year = date("Y");
				return $year;
			}
			echo quelleAnnee()."<br>";
			
			function quelleDate(){
				echo date("d/m/Y");
			}
			quelleDate()
		?>
		
	</body>
</html>