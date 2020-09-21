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
		<?php
			include('formHandling.php');
		?>
	</head>
	<body>
		
		<p>* Champs requis</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<p>
				<label>Nom complet :*
					<input type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"></input><span class="error"><?php echo $nameErr;?></span>
				</label>
			</p>
			<p>
				<label>Email :*
					<input type="text" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"></input><span class="error"><?php echo $emailErr;?></span>  <!--type text pour le test mais devrais etre email-->
				</label>
			</p>
			<p>
				<label>N° de téléphone :*
					<input type="tel" name="tel" value="<?php echo isset($_POST["tel"]) ? $_POST["tel"] : "" ?>"></input><span class="error"><?php echo $telErr;?></span>
				</label>
			</p>
			<p>
				<label>Adresse :*
					<input type="text" name="address" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : "" ?>"></input><span class="error"><?php echo $addressErr;?></span>
				</label>
			</p>
			<p>
				<label>Code postal :*
					<input type="text" name="zipCode" value="<?php echo isset($_POST["zipCode"]) ? $_POST["zipCode"] : "" ?>"></input><span class="error"><?php echo $zipCodeErr;?></span>
				</label>
			</p>
			<p>
				<button type="submit">Envoyer</button>
			</p>
		</form>
	</body>
</html>

