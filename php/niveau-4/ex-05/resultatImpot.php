<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if(empty($_POST["name"])){
            $nameErr = "Le nom est requis";
        }





        $name = $_GET["name"];
        $revenu = $_GET["revenu"];
        $test = new impot();
    }
