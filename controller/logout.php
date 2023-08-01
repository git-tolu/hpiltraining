<?php
    session_start();
    session_destroy();
    unset($_SESSION['session2']);
    unset($_SESSION['user_firstname']);
    unset($_SESSION['user_venue']);
    header("location:../index.php");
?>