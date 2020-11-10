<?php
session_start();

if (isset($_GET['disconnect'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
}

$currentPage = "";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo $currentPage; ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Medoo</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <?php if (!isset($_SESSION['loggedIn'])) : ?>
                <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#loginModal">
                    Se connecter
                </button>
                <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#registerModal">
                    S'enregistrer
                </button>
            <?php else : ?>
                <div>
                    <a class="nav-link" href="index.php?profil">Mon profil</a>
                </div>
                <div>
                    <a class="nav-link" href="index.php?disconnect">Se deconnecter</a>
                </div>
            <?php endif; ?>
            <form>
            </form>
        </div>
    </nav>

    <!-- Login modal -->
    <div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php include_once "templates/loginModal.php" ?>

            </div>
        </div>
    </div>

    <!-- Register modal -->
    <div class="modal fade" id="registerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php include_once "templates/registerModal.php" ?>

            </div>
        </div>
    </div>