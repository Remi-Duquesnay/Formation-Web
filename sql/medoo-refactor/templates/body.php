<body class="d-flex flex-column min-vh-100">
    <?php
    
    include_once "templates/navbar.php";
    
    ?>
<main class="mt-5">

<?php


if(!empty($_GET)){
    if(isset($_GET['users'])){
        include_once "templates/users.php";
    }else if(isset($_GET['profil'])){
        include_once "templates/profil.php";
    }
}else{
    include_once "templates/home.php";
}

?>

</main>