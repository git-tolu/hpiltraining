<?php
    include_once "config.php";
    // registration
    if (isset($_POST['action']) && $_POST['action'] == 'adminRegister') {
        // var_dump($_POST);
        // Grab info from form
        $adminUsername = mysqli_real_escape_string($conn, $_POST['adminUsername']);
        $adminEmail = mysqli_real_escape_string($conn, $_POST['adminEmail']);
        $adminPassword = mysqli_real_escape_string($conn, $_POST['adminPassword']);
        $adminConfirmPassword = mysqli_real_escape_string($conn, $_POST['adminConfirmPassword']);

        // $adminUsername = $_POST['adminUsername'];
        // $adminEmail = $_POST['adminEmail'];
        // $adminPassword = $_POST['adminPassword'];
        // $adminConfirmPassword = $_POST['adminConfirmPassword'];

        // Check for empty fields
        if(empty($adminUsername)){ echo 'Username cannot be empty <br>';}
        if(empty($adminEmail)){ echo  'E-MAIL cannot be empty <br>';}
        if(empty($adminPassword)){ echo  'Password is required <br>';}

        // Check password confirmation
        if($adminPassword != $adminConfirmPassword){
            echo  'Passwords do not match <br>';
        }else{
            //    Check if email exist
            $userCheck = "SELECT * FROM admin WHERE adminEmail = '$adminEmail' LIMIT 1";
            $userResult = mysqli_query($conn, $userCheck);
            $userFetch = mysqli_fetch_assoc($userResult);
    
            if (!empty($userFetch)) {
                if($userFetch['adminEmail'] == $adminEmail){
                    echo  'e-MAIL already exist <br>';
                }
            }else {
                if(!empty($adminUsername) && !empty($adminEmail) && !empty($adminPassword) && !empty($adminConfirmPassword)){
                    //    Finally register the ADMIN
                    //        HASH PASSWORD
                        $hpass= md5($adminPassword);
                        $sql = "INSERT INTO admin (adminUsername,  adminEmail, adminPassword) VALUES ('$adminUsername', '$adminEmail', '$hpass')";
                        mysqli_query($conn, $sql);
            
                        $_SESSION['session'] = $adminEmail;
                        echo "registered";
                } 
            }
        }
    }

    // login Code
    if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
        // var_dump($_POST);
        $adminEmail = mysqli_real_escape_string($conn, $_POST['adminEmail']);
        $adminPassword = mysqli_real_escape_string($conn, $_POST['adminPassword']);
        // // validation
        if(empty($adminEmail)){ echo 'email is required <br>';}
        if(empty($adminPassword)){ echo 'password cannot be empty <br>';} else {
            $passh= md5($adminPassword);
            $sql="SELECT * FROM admin WHERE adminEmail='$adminEmail' AND adminPassword='$passh'";
            $rez= mysqli_query($conn, $sql);
            if ($rez) {
                // echo "hkijki";
                if(mysqli_num_rows($rez) == 1){
                    $_SESSION['session'] = $adminEmail;
                    echo 'login';
                }else {
                        echo "invalid login <br>";
                }
            }else{
                echo "Query faild <br>";
            }
        }
    }

        // program registration
        if (isset($_POST['action']) && $_POST['action'] == 'programs') {
            // var_dump($_POST);
            // Grab info from form
            $program = mysqli_real_escape_string($conn, $_POST['program']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            $time = mysqli_real_escape_string($conn, $_POST['time']);
    
            // Check for empty fields
            if(empty($program)){ echo 'program cannot be empty <br>';}
            if(empty($date)){ echo  'date cannot be empty <br>';}
            if(empty($time)){ echo  'time is required <br>';}
    
            if(!empty($program) && !empty($date) && !empty($time)){
                //    Finally register the program
                $sql1 = "INSERT INTO programs (program, date, time) VALUES ('$program', '$date', '$time')";
                mysqli_query($conn, $sql1);
                echo "registered";
            }
        }

        // participants registration
        if (isset($_POST['action']) && $_POST['action'] == 'generate') {
            // var_dump($_POST);
            // Grab info from form
            $program = mysqli_real_escape_string($conn, $_POST['program']);
            $participants = mysqli_real_escape_string($conn, $_POST['participants']);
            $int = 1;
    
            // Check for empty fields
            if(empty($program)){ echo 'program cannot be empty <br>';}
            if(empty($participants)){ echo  'no of participants is required <br>';}
    
    
            if(!empty($program) && !empty($participants)){
                //    Finally register the ADMIN
                //        HASH PASSWORD
                for ($i=1; $i <= $participants; $i++) {
                    $user_id = "user".substr(rand(), 0, 9); 
                    $pincode = substr(rand(), 0, 9); 
                    // $user = "user" + $user_id;
                    $sql = "INSERT INTO attendant (program, participants, user_i, pincode, status) VALUES ('$program','$participants', '$user_id', '$pincode','active')";
                    mysqli_query($conn, $sql);
        
                }
                echo "registered"; 
            }
        }

        // Program Update
        if (isset($_POST['action']) && $_POST['action'] == 'programUpdate') {
            // var_dump($_POST);
            // Grab info from form
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $program = mysqli_real_escape_string($conn, $_POST['program']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            $time = mysqli_real_escape_string($conn, $_POST['time']);
    
            // Check for empty fields
            if(empty($program)){ echo 'program cannot be empty <br>';}
            if(empty($date)){ echo  'date cannot be empty <br>';}
            if(empty($time)){ echo  'time is required <br>';}
    
            if(!empty($program) && !empty($date) && !empty($time)){
                //    Finally register the program
                $sql1 = "UPDATE programs SET program = '$program', date = '$date', time = '$time' WHERE id = '$id'";
                mysqli_query($conn, $sql1);
                echo "registered";
            }
        }