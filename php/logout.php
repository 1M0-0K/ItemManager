<?php

    session_start();

    if(isset($_GET['logout']) && $_GET['logout'] == 1){
        if(isset($_SESSION['user_id'])){
            session_unset();
            session_destroy();
            echo true;
        }
    }
?>
