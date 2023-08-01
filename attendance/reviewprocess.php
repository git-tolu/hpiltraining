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
                $user_number2 = mysqli_real_escape_string($conn, $_POST['user_number2']);
                $training = mysqli_real_escape_string($conn, $_POST['training']);
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                $materials = mysqli_real_escape_string($conn, $_POST['materials']);
                $knowledge = mysqli_real_escape_string($conn, $_POST['knowledge']);
                $deployment = mysqli_real_escape_string($conn, $_POST['deployment']);
                $participartion = mysqli_real_escape_string($conn, $_POST['participartion']);
                $relevant = mysqli_real_escape_string($conn, $_POST['relevant']);
                $expectations = mysqli_real_escape_string($conn, $_POST['expectations']);
                $apply = mysqli_real_escape_string($conn, $_POST['apply']);
                $course = mysqli_real_escape_string($conn, $_POST['course']);
                $user_suggestion = mysqli_real_escape_string($conn, $_POST['user_suggestion']);
                $user_event = mysqli_real_escape_string($conn, $_POST['user_event']);
                $user_improvement = mysqli_real_escape_string($conn, $_POST['user_improvement']);
                $updates = mysqli_real_escape_string($conn, $_POST['updates']);
                $Mentorship = mysqli_real_escape_string($conn, $_POST['Mentorship']);
                $id=0;
				
				$sql = "INSERT INTO userattendance VALUES ('$id','$user_date', '$user_venue', '$user_office', '$user_surname', '$user_firstname', '$user_company', '$user_email', '$user_number', '$gender', '$jobrole', '$workgroup')";

if (mysqli_query($conn, $sql)) {
	$attendcode = $_SESSION['attendancecode'];
$sqlupdate="UPDATE attendant SET status = 'expired' WHERE pincode='$attendcode'";
if (mysqli_query($conn, $sqlupdate)) {
	header("location:successattendance.php");
}else{
	header("location:failureattendance.php");
}
}
                   
   }
?>