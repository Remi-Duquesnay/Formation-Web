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
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"  enctype="multipart/form-data">
			<p>
				<label>Nom ou pseudo du Joueur 1 :*
					<input type="text" name="player1" value="<?php echo isset($_POST["player1"]) ? $_POST["player1"] : "" ?>"></input><span class="error"><?php echo $player1Err;?></span>
				</label>
			</p>
			<p>
				<label>Nom ou pseudo du Joueur 2*
					<input type="text" name="player2" value="<?php echo isset($_POST["player2"]) ? $_POST["player2"] : "" ?>"></input><span class="error"><?php echo $player2Err;?></span>  <!--type text pour le test mais devrais etre email-->
				</label>
			</p>
			<p>
				<label>Identifiant du match <small>(de 1 à 64)</small> :*
					<input type="tel" name="idGame" value="<?php echo isset($_POST["idGame"]) ? $_POST["idGame"] : "" ?>"></input><span class="error"><?php echo $idGameErr;?></span>
				</label>
			</p>
			<p style="display:flex; flex-direction:column; align-items:flex-start;">Vainqueur :
					<label>Joueur 1<input type="radio" name="winner" value="player1" <?php if(isset($_POST['winner']) && $_POST['winner'] == 'player1'){echo ' checked="checked"';} ?>></label>
					<label>Joueur 2<input type="radio" name="winner" value="player2" <?php if(isset($_POST['winner']) && $_POST['winner'] == 'player2'){echo ' checked="checked"';} ?>></label>
			</p>
			<p>
				<label for="screenshot">Screenshot :*</label><br>
				<input type="file" name="screenshot" id="screenshot"><span class="error"><?php echo $imgErr;?></span>
				
			</p>
			<p>
				<button type="submit" name="submit">Envoyer</button><br>
				<span><?php echo $succes;?></span>
			</p>
		</form>
	</body>
</html>

