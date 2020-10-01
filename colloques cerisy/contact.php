<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contact</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-6 offset-3">
            <h1>Contact</h1>
            <img src="images/Buffet-froid.jpg" />

            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row m-0">
                        <div class="input-surname">
                            <label for="surname"><small><strong>Nom</strong> (requis)</small></label><br>
                            <input id="surname" type="text" name="surname" value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "" ?>">
                        </div>
                        <div class="input-name">
                            <label for="name"><small><strong>Prénom</strong> (requis)</small></label><br>
                            <input id="name" type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>">
                        </div>
                    </div>
                    <label for="email"><small><strong>Couriel</strong> (requis)</small></label><br>
                    <input id="email" type="email" name="email" placeholder="exemple : robert.razosky@unemail.com" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>">
                    <hr />
                    <div>
                    <label for="subject"><small><strong>Couriel</strong> (requis)</small></label><br>
                    <input list="suject-choice" id="subject" name="subject" value="<?php echo isset($_POST["subject"]) ? $_POST["subject"] : "" ?>">
                    <datalist id="subject-choice">
                        <option value="1">
                        <option value="2">
                        <option value="3">
                    </datalist>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>