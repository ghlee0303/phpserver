<?php
    session_start();
    if(!isset($_SESSION['userid'])) {
        echo "<script>location.replace('login.php');</script>";            
    }
    
    else {
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];
    }
