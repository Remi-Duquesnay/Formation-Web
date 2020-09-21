<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Exo 4 - Traitement de formulaires</title>
		<style>
			.error{
			color:red;
			}
		</style>
	</head>
	<body>
		<?php
			$nameErr = $surnameErr = $birthLocationErr = "";
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				if(empty($_POST["name"])) {
					$nameErr = "Nom requis";
					$valid = false;
				}
				if(empty($_POST["surname"])) {
					$surnameErr = "Prénom requis";
					$valid = false;
				}
				if(empty($_POST["birthLocation"])) {
					$birthLocationErr = "Ville de naissance requise";
					$valid = false;
				}
				
			}
		?>
		<p>* Champs requis</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<p>
				<label>Nom :*
					<input type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"></input><span class="error"><?php echo $nameErr;?></span>
				</label>
			</p>
			<p>
				<label>Prénom :*
					<input type="text" name="surname" value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "" ?>"></input><span class="error"><?php echo $surnameErr;?></span>  <!--type text pour le test mais devrais etre email-->
				</label>
			</p>
			<p>
				<label>Ville de naissance : *
					<input type="text" name="birthLocation" value="<?php echo isset($_POST["birthLocation"]) ? $_POST["birthLocation"] : "" ?>"></input><span class="error"><?php echo $birthLocationErr;?></span>
				</label>
			</p>
			<button type="submit" name="submit">Envoyer</button><br>
			<span><?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo "<p>Bonjour ".$_POST["name"]." ".$_POST["surname"].", vous êtes né à ".$_POST["birthLocation"]."</p>";}?></span>
		</p>
	</form>
</body>
</html>

