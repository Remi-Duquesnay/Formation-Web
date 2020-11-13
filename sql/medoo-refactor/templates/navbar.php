<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Medoo</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['loggedIn'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?users">Utilisateurs</a>
                </li>
            <?php endif; ?>


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
                <a class="btn btn-primary mx-2" href="index.php?profil">Mon profil</a>
            </div>
            <div>
                <a class="btn btn-danger mx-2" href="index.php?disconnect">Se deconnecter</a>
            </div>
        <?php endif; ?>
        <form>
        </form>
    </div>
</nav>