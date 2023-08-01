<?php
    session_start();
    $dbhost = "localhost";
    $dbname = "hpilgroupcom_attendance";
    $dbuser = "root";
    $dbpass = "";

    $conn =  mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

?>