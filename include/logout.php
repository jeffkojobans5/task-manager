<?php
    function login () {
        if(isset($_SESSION['id'])){
            return true;
        }
    }

    function login_confirm () {
        if(!login()){
            header('location:login.php');
            exit;
        }
    }

    login_confirm();
?>