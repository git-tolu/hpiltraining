<?php
    session_start();
    session_destroy();
    unset($_SESSION['session']);
    header("location:../index.php");
?>