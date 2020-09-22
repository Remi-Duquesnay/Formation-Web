<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex-05</title>
    <style>
			.error{
			color:red;
			}
		</style>
    <?php
        include "resultatImpot.php";
    ?>
</head>
<body>
    <form action="resultatImpot.php" method="get">
        <label>Nom :
            <input type="text" name="name" value="<?php echo isset($_GET["name"]) ? $_POST["name"] : "" ?>">
            <span class="error"><?php echo $nameErr;?></span> 
        </label>
        <br>
        <label>Revenu :
            <input type="text" name="revenu" value="<?php echo isset($_GET["revenu"]) ? $_POST["revenu"] : "" ?>">
            <span class="error"><?php echo $revenuErr;?></span> 
        </label>
        <br>
        <button type="submit" name="submit">OK</button>
    </form>
</body>
</html>