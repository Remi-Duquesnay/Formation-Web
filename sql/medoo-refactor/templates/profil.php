<?php

include_once 'includes/functions.inc.php';

$user = getUser($_SESSION['userid']);
switch ($user['pro']) {
    case '0':
        $status = "Particulier";
        break;
    case '1':
        $status = "Professionel";
        break;
}
?>

<div class="container mt-5">
    <div class="row" id="profil">
        <div class="col-8 offset-2 border rounded text-white bg-dark">
            <h1 class="text-center">Mon Profil</h1>
            <hr>
            <div class="alert alert-secondary">
                <p>Nom : <?php echo $user['lastname'] ?></p>
                <p>Prénom : <?php echo $user['firstname'] ?></p>
                <p>Email : <?php echo $user['email'] ?></p>
                <p>Status : <?php echo $status ?></p>
            </div>
            <!-- modifier mon profil (ouvre modifyModal)-->
            <!-- changer mot de passe (ouvre modif password modal) -->
            <!-- supprimer mon compte (ouvre suppression confirmation modal)-->
        </div>
    </div>
</div>