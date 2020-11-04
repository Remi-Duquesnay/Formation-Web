<?php

    include "includes/functions.inc.php";

    if(isPwdTokenValid("5ca744a08c792ebc", "c297ac48cd860a3761161351ceab2606292537950d8b0d0f601c1c0f0c2acf19")){
        echo "true";
    }else{
        echo "false";
    }

?>