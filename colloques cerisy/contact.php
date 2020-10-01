<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css" integrity="sha384-OLYO0LymqQ+uHXELyx93kblK5YIS3B2ZfLGBmsJaUyor7CpMTBsahDHByqSuWW+q" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/contact.css">
    <title>Contact</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-sm-6 offset-sm-3">
            <h1>Contact</h1>
            <img src="images/Buffet-froid.jpg" />

            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-6 input-surname m-0">
                            <label for="surname"><small><strong>Nom</strong> (requis)</small></label><br>
                            <input id="surname" type="text" name="surname" required value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "" ?>">
                        </div>
                        <div class="col-sm-6 input-name m-0">
                            <label for="name"><small><strong>Prénom</strong> (requis)</small></label><br>
                            <input id="name" type="text" name="name" required value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>">
                        </div>
                    </div>
                    <label for="email"><small><strong>Couriel</strong> (requis)</small></label><br>
                    <input id="email" type="email" name="email" required placeholder="exemple : robert.razosky@unemail.com" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>">
                    <hr />
                    <label for="subject"><small><strong>Objet</strong></small></label><br>
                    <select id="subject" name="subject" value="<?php echo isset($_POST["subject"]) ? $_POST["subject"] : "" ?>">
                        <option value="1">..1..</option>
                        <option value="2">..2..</option>
                        <option value="3">..3..</option>
                    </select>
                    <label for="msg"><small><strong>Message</strong> (requis)</small></label><br>
                    <textarea id="msg" name="msg" required value="<?php echo isset($_POST["msg"]) ? $_POST["msg"] : "" ?>"></textarea>
                    <div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button id="submit" type="submit" value="Submit"><i class="fas fa-arrow-right"></i> Envoyer ce message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>