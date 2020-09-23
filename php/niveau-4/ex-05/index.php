<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex-05</title>
</head>
<body>
    <form action="resultatImpot.php" method="GET">
        <label>Nom :
            <input type="text" name="name" value="<?php echo isset($_GET["name"]) ? $_POST["name"] : "" ?>">
            
        </label>
        <br>
        <label>Revenu :
            <input type="text" name="revenu" value="<?php echo isset($_GET["revenu"]) ? $_POST["revenu"] : "" ?>">
            
        </label>
        <br>
        <button type="submit" name="submit">OK</button>
    </form>
</body>
</html>