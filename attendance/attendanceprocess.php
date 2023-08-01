<?php
    include_once "controller/config.php"; 
// candidate register
            if (isset($_POST['attendancereg'])) {
                // var_dump($_POST);
                // Grab info from form
                $user_date = mysqli_real_escape_string($conn, $_POST['user_date']);
                $user_venue = mysqli_real_escape_string($conn, $_POST['user_venue']);
                $user_office = mysqli_real_escape_string($conn, $_POST['user_office']);
                $user_surname = mysqli_real_escape_string($conn, $_POST['user_surname']);
                $user_firstname = mysqli_real_escape_string($conn, $_POST['user_firstname']);
                $user_company = mysqli_real_escape_string($conn, $_POST['user_company']);
                $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
                $user_number = mysqli_real_escape_string($conn, $_POST['user_number']);
                $gender = mysqli_real_escape_string($conn, $_POST['gender']);
                $jobrole = mysqli_real_escape_string($conn, $_POST['jobrole']);
                $workgroup = mysqli_real_escape_string($conn, $_POST['workgroup']);
                $eventname = mysqli_real_escape_string($conn, $_POST['eventname']);
                $id=0;
				
				$sql = "INSERT INTO userattendance VALUES ('$id','$user_date', '$user_venue', '$user_office', '$user_surname', '$user_firstname', '$user_company', '$user_email', '$user_number', '$gender', '$jobrole', '$workgroup','$eventname')";

if (mysqli_query($conn, $sql)) {
	$attendcode = $_SESSION['attendancecode'];
//$sqlupdate="UPDATE attendant SET status = 'expired' WHERE pincode='$attendcode'";
//if (mysqli_query($conn, $sqlupdate)) {
	header("location:successattendance.php");
}else{
	header("location:failureattendance.php");
}
}
                   
 
?>