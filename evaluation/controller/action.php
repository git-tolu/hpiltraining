<?php
    include_once "config.php";
    // login Code
    if (isset($_POST['action']) && $_POST['action'] == 'userLogin') {
        // var_dump($_POST);
       // $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // // validation
        //if(empty($username)){ echo 'email is required <br>';}
        if(empty($password)){ echo 'attendance code cannot be empty <br>';} else {
            $passh= md5($password);
          //  $sql="SELECT * FROM attendant WHERE user_i='$username' AND pincode='$password' AND status = 'active'";
            $sql="SELECT * FROM attendant WHERE pincode='$password' AND status = 'active'";
            $rez= mysqli_query($conn, $sql);
            $info = mysqli_fetch_assoc($rez);
           // $sql1="UPDATE attendant SET status = 'expired' WHERE user_i='$username' AND pincode='$password'";
           // $rez1= mysqli_query($conn, $sql1);    
            if ($rez) {
                // echo "hkijki";
                if(mysqli_num_rows($rez) == 1){
                   // $_SESSION['session2'] = $username;
                    $_SESSION['attendancecode'] = $password;
                    $_SESSION['program'] = $info['program'];
                    //$_SESSION['dbpresent'] = "present";
                    echo 'login';
                }else {
                        echo "<font color='white'>invalid attendance code</font> <br>";
                }
            }
            
        }
    }

            // candidate register
            if (isset($_POST['actionreg']) && $_POST['actionreg'] == 'reg') {
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
                // Remove all illegal characters from email
                // $sanitizedEmail = filter_var($user_email, FILTER_SANITIZE_EMAIL);
                
                // Validate email address
                // if($user_email == $sanitizedEmail && filter_var($user_email, FILTER_VALIDATE_EMAIL)){
                //     echo "The $email is a valid email address";
                // } else{
                //     echo "The $email is not a valid email address";
                // }

                //validation
                if(empty($user_date)){echo 'field is required <br>';}
                if(empty($user_venue)){echo 'field is required <br>';}
                if(empty($user_office)){echo 'field is required <br>';}
                if(empty($user_surname)){echo 'field is required <br>';}
                if(empty($user_firstname)){echo 'field is required <br>';}
                if(empty($user_company)){echo 'field is required <br>';}
                if(empty($user_email)){echo 'field is required <br>';}
                if(empty($user_number)){echo 'field is required <br>';}
                if(empty($user_number2)){echo 'field is required <br>';}
                if(empty($training)){echo 'field is required <br>';}
                if(empty($content)){echo 'field is required <br>';}
                if(empty($materials)){echo 'field is required <br>';}
                if(empty($knowledge)){echo 'field is required <br>';}
                if(empty($deployment)){echo 'field is required <br>';}
                if(empty($participartion)){echo 'field is required <br>';}
                if(empty($relevant)){echo 'field is required <br>';}
                if(empty($expectations)){echo 'field is required <br>';}
                if(empty($apply)){echo 'field is required <br>';}
                if(empty($course)){echo 'field is required <br>';}
                if(empty($user_suggestion)){echo 'field is required <br>';}
                if(empty($user_event)){echo 'field is required <br>';}
                if(empty($user_improvement)){echo 'field is required <br>';}
                if(empty($updates)){echo 'field is required <br>';}
                if(empty($Mentorship)){echo 'field is required <br>';}

                if(!empty($user_date) && !empty($user_venue) && !empty($user_office) && !empty($user_surname) && !empty($user_firstname) && !empty($user_company) && !empty($user_email) && !empty($user_number) && !empty($user_number2) && !empty($training) && !empty($content) && !empty($materials) && !empty($knowledge) && !empty($deployment) && !empty($participartion) && !empty($relevant) && !empty($expectations) && !empty($apply) && !empty($course) && !empty($user_suggestion) && !empty($user_event) && !empty($user_improvement) && !empty($updates) && !empty($Mentorship)){
                    $_SESSION['user_venue'] = $user_venue;
                    $sql = "INSERT INTO `userattendance` (`user_date`, `user_venue`, `user_office`, `user_surname`, `user_firstname`, `user_company`, `user_email`, `user_number`, `training`, `content`, `materials`, `knowledge`, `deployment`, `participartion`, `relevant`, `expectations`, `apply`, `course`, `user_suggestion`, `user_event`, `user_improvement`, `updates`, `Mentorship`) VALUES ('$user_date', '$user_venue', '$user_office', '$user_surname', '$user_firstname', '$user_company', '$user_email', '$user_number', '$training', '$content', '$materials', '$knowledge', '$deployment', '$participartion', '$relevant', '$expectations', '$apply', '$course', '$user_suggestion', '$user_event', '$user_improvement', '$updates', '$Mentorship')";
                    $result = mysqli_query($conn, $sql);
                    echo "submitted";
                } 
                
            }

            // candidate register
            if (isset($_POST['actionreg']) && $_POST['actionreg'] == 'short') {
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
                $user_job = mysqli_real_escape_string($conn, $_POST['user_job']);
                $user_department = mysqli_real_escape_string($conn, $_POST['user_department']);

                // // Remove all illegal characters from email
                // $sanitizedEmail = filter_var($user_email, FILTER_SANITIZE_EMAIL);

                // // Validate email address
                // if($user_email == $sanitizedEmail && filter_var($user_email, FILTER_VALIDATE_EMAIL)){
                //     echo "The email is a valid email address <br>";
                // } else{
                //     echo "The email is not a valid email address <br>";
                // }
                

                //validation
                if(empty($user_date)){echo 'field is required <br>';}
                if(empty($user_venue)){echo 'field is required <br>';}
                if(empty($user_office)){echo 'field is required <br>';}
                if(empty($user_surname)){echo 'field is required <br>';}
                if(empty($user_firstname)){echo 'field is required <br>';}
                if(empty($user_company)){echo 'field is required <br>';}
                if(empty($user_email)){echo 'field is required <br>';}
                if(empty($user_number)){echo 'field is required <br>';}
                if(empty($gender)){echo 'field is required <br>';}
                if(empty($user_job)){echo 'field is required <br>';}
                if(empty($user_department)){echo 'field is required <br>';}


                if(!empty($user_date) && !empty($user_venue) && !empty($user_office) && !empty($user_surname) && !empty($user_firstname) && !empty($user_company) && !empty($user_email) && !empty($user_number) && !empty($gender) && !empty($user_job) && !empty($user_department)){
                    $_SESSION['user_firstname'] = $user_firstname;
                    $sql = "INSERT INTO `form_review` (`user_date`, `user_venue`, `user_office`, `user_surname`, `user_firstname`, `user_company`, `user_email`, `user_number`, `gender`, `user_job`, `user_department`) VALUES ('$user_date', '$user_venue', '$user_office', '$user_surname', '$user_firstname', '$user_company', '$user_email', '$user_number', '$gender', '$user_job', '$user_department')";
                    $result = mysqli_query($conn, $sql);
                    $sql1="UPDATE attendant SET status = 'expired' WHERE user_i='".$_SESSION['session']."' AND pincode='".$_SESSION['password']."'";
                    $rez1= mysqli_query($conn, $sql1);            
                    if ($result) {
                        echo "submitted";
                        // header("location: ../attendance_form.php");
                    }
                } 

            }

       