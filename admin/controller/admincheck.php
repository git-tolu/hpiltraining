<?php
    include_once ("config.php");
    include_once ("session.php");
    // calling session
    // $Email = $_SESSION['adminLog'];
    // echo $Email;
    // $adminCheck = "SELECT * FROM admin WHERE adminEmail = '$Email' ";
    // $adminResult = mysqli_query($conn, $adminCheck);
    // $result = mysqli_fetch_array($adminResult);
    // $int  = $result['id']; 

    if (isset($_POST['action']) && $_POST['action'] == 'politicalForm') {
        // echo $result['id']; 
        $i = 1;
        $sql4 = "SELECT * FROM admin WHERE id = '$int'";
        $records4 = mysqli_query($conn, $sql4);
        $sell = mysqli_fetch_array($records4);
        $creat = $sell['created'];
        $c = $creat + 1;
        $sql2 = "UPDATE admin SET created = $c  WHERE id = '$int'";
        $records = mysqli_query($conn, $sql2);
    }

    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        // echo $result['id']; 
        $i = 1;
        $sql4 = "SELECT * FROM admin WHERE id = '$int'";
        $records4 = mysqli_query($conn, $sql4);
        $sell = mysqli_fetch_array($records4);
        $creat = $sell['updated'];
        $c = $creat + 1;
        $sql2 = "UPDATE admin SET updated = $c  WHERE id = '$int'";
        $records = mysqli_query($conn, $sql2);
    }

    if (isset($_POST['deleteNote'])) {
        // echo $result['id']; 
        $i = 1;
        $sql4 = "SELECT * FROM admin WHERE id = '$int'";
        $records4 = mysqli_query($conn, $sql4);
        $sell = mysqli_fetch_array($records4);
        $creat = $sell['deleted'];
        $c = $creat + 1;
        $sql2 = "UPDATE admin SET deleted = $c  WHERE id = '$int'";
        $records = mysqli_query($conn, $sql2);
    }

    if (isset($_POST['viewProfile'])) {
        // echo $result['id']; 
        $in = $_POST['viewProfile'];
        $i = 1;
        $sql4 = "SELECT * FROM admin WHERE id = '$in'";
        $records4 = mysqli_query($conn, $sql4);
        $sell = mysqli_fetch_array($records4);
        $creat = $sell['view'];
        $c = $creat + 1;
        $sql2 = "UPDATE admin SET view = $c  WHERE id = '$in'";
        $records = mysqli_query($conn, $sql2);
    }

    if (isset($_POST['viewProfil'])) {
        $viewProfile = $_POST['viewProfil'];
        $sql5 = "SELECT * FROM detail WHERE firstname = '$viewProfile'";
        $records5 = mysqli_query($conn, $sql5);
        $sell1 = mysqli_fetch_array($records5);
        $in = $sell1['adminId'];
        $i = 1;
        $sql4 = "SELECT * FROM admin WHERE id = '$in'";
        $records4 = mysqli_query($conn, $sql4);
        $sell = mysqli_fetch_array($records4);
        $creat = $sell['view'];
        $c = $creat + 1;
        $sql2 = "UPDATE admin SET view = $c  WHERE id = '$in'";
        $records = mysqli_query($conn, $sql2);
    }
