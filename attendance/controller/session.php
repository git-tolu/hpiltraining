<?php
  include_once "config.php";
if (!isset($_SESSION['session'])) {
    header("location: index.php");
}

// calling session
  // $Email = $_SESSION['session'];
  // echo $Email;
  // $adminCheck = "SELECT * FROM admin WHERE adminEmail = '$Email' ";
  // $adminResult = mysqli_query($conn, $adminCheck);
  // $result = mysqli_fetch_array($adminResult);
  
  // $int  = $result['id']; 
  // echo $int; 