<?php
    include_once ("config.php");
    $username = '';
    $email = '';
    $errors = array();
    
    // login Code
    if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
        // var_dump($_POST);
        $adminPassword = $_POST['adminPassword'];
        $adminemail = $_POST['adminEmail'];
        // validation
        if(empty($adminemail)){ echo 'email is required <br>';}
        if(empty($adminPassword)){ echo 'password cannot be empty <br>';} else {
            $passh= md5($adminPassword);
            $sql="SELECT * FROM admin WHERE adminEmail='$adminemail' AND adminPassword='$passh'";
            $rez= mysqli_query($conn, $sql);
            if(mysqli_num_rows($rez) == 1){
                echo "loggedin";
                $_SESSION['adminLog'] = $adminemail;
            }else {
                    echo "invalid login <br>";
            }
        }
    }
    
    // register admin
    $adminName = '';
    $adminEmail = '';
    $errors = array();

    if (isset($_POST['action']) && $_POST['action'] == 'adminRegister' ) {
        // Grab info from form
            $adminName = $_POST['adminName'];
            $adminPassword = $_POST['adminPassword'];
            $adminPassword2 = $_POST['adminPassword2'];
            $adminEmail = $_POST['adminEmail'];

            // Check for empty fields
            if(empty($adminName)){ echo 'Name cannot be empty <br>';}
            if(empty($adminPassword)){ echo  'Password is required <br>';}
            if(empty($adminEmail)){ echo  'e-MAIL cannot be empty <br>';}

        // Check password confirmation
            if($adminPassword != $adminPassword2){
                echo  'Passwords do not match <br>';
            }
        
        //    Check if email exist
            $userCheck = "SELECT * FROM admin WHERE adminEmail = '$adminEmail' LIMIT 1";
            $userResult = mysqli_query($conn, $userCheck);
            $userFetch = mysqli_fetch_assoc($userResult);

        if($userFetch['adminEmail'] == $adminEmail){
            echo  'e-MAIL already exist <br>';
        }else {
            //    Finally register the ADMIN
                //    HASH PASSWORD
                $hpass= md5($adminPassword);
                $sql = "INSERT INTO admin (adminName, adminPassword, adminEmail) VALUES ('$adminName', '$hpass', '$adminEmail')";
                mysqli_query($conn, $sql);

                $_SESSION['adminLog'] = $adminEmail;
                echo "registered";
        }
    }

        // update code
       $firstname = '';
       $lastname = '';
       $middlename = '';
       $state = '';
       $lga = '';
       $armbition = '';
       $id = '';
       $update = '';
       $position = '';
       $qualification = '';
       $school = '';
       if (isset($_POST['action']) && $_POST['action'] == 'update' ) {
            //    var_dump($_POST);
           // Grab info from form
           $id = $_POST['idd'];
           $firstname = $_POST['firstname'];
           $lastname = $_POST['lastname'];
           $middlename = $_POST['middlename'];
           $gender = $_POST['gender'];
           $dob = $_POST['dob'];
           $age = $_POST['age'];
           $state = $_POST['state'];
           $lga = $_POST['lga'];
           $position = $_POST['position'];
           $qualification = $_POST['qualification'];
           $school = $_POST['school'];
           $ambition = $_POST['ambition'];
           $arm = $_POST['arm'];
            $image_name= "";
            //    $image_name = $_FILES['image']['name'];
   
           // Check for empty fields 
           if(empty($firstname)){echo 'firstname cannot be empty <br>'; }
           if(empty($lastname)){echo 'lastname cannot be empty <br>'; }
           if(empty($middlename)){echo 'middlename cannot be empty <br>'; }
           if(empty($gender)){echo 'gender cannot be empty <br>'; } 
           if(empty($dob)){echo 'dob cannot be empty <br>'; } 
           if(empty($age)){echo 'age cannot be empty <br>'; } 
           if(empty($state)){echo 'state cannot be empty <br>'; } 
           if(empty($lga)){echo 'lga cannot be empty <br>'; } 
           if(empty($position)){echo 'position cannot be empty <br>'; } 
           if(empty($qualification)){echo 'qualification cannot be empty <br>'; } 
           if(empty($school)){echo 'school cannot be empty <br>'; } 
           if(empty($ambition)){echo 'textarea cannot be empty <br>'; } 
           if(empty($arm)){echo 'arm cannot be empty <br>'; } 
            //    if(empty($image_name)){echo 'image cannot be empty <br>'; } 

           if(!empty($firstname) && !empty($lastname) && !empty($middlename) && !empty($gender) && !empty($dob) && !empty($age) && !empty($state) && !empty($lga) && !empty($position) && !empty($qualification) && !empty($school) && !empty($arm)){
                        //    image
            //    $target = "../plugins/profile/".$image_name;
            //    move_uploaded_file($_FILES['image']['tmp_name'], $target);
               $sql = "UPDATE detail SET firstname = '$firstname', lastname = '$lastname', middlename = '$middlename', gender = '$gender', dob = '$dob', age = '$age', state = '$state', lga = '$lga', position = '$position', qualification = '$qualification', school = '$school', ambition = '$ambition', arm = '$arm', image = '$image_name' WHERE id = '$id'";
               $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "updated";
                }
            }
        }

    // edit code
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        // echo "fuck me"; 
        $id = $_POST['idd'];
        $update = true;
        $sql2 = "SELECT * FROM detail WHERE id='$id'";
        $records = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($records) == 1) {
          $n = mysqli_fetch_array($records);
          $firstname = $n['firstname'];
          $lastname = $n['lastname'];
          $middlename = $n['middlename'];
          $state = $n['state'];
          $position = $n['position'];
          $qualification = $n['qualification'];
          $school = $n['school'];
          $lga = $n['lga'];
          $armbition = $n['ambition'];
          $image = $n['image'];
          }
    }
        // candidate register
    if (isset($_POST['action']) && $_POST['action'] == 'politicalForm') {
        // Grab info from form
        $image_name= "";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $age = $_POST['age'];
        $state = $_POST['state'];
        $lga = $_POST['lga'];
        $position = $_POST['position'];
        $qualification = $_POST['qualification'];
        $school = $_POST['school'];
        $ambition = $_POST['ambition'];
        $arm = $_POST['arm'];
        $int = $_POST['id'];
        // $image_name = $_FILES['image']['name'];
        $i = 1;

        // Check for empty fields 
        if(empty($firstname)){echo 'firstname cannot be empty <br>';}
        if(empty($lastname)){echo 'lastname cannot be empty <br>';}
        if(empty($middlename)){echo 'middlename cannot be empty <br>';}
        if(empty($gender)){echo 'gender cannot be empty <br>';} 
        if(empty($dob)){echo 'dob cannot be empty <br>';} 
        if(empty($age)){echo 'age cannot be empty <br>';} 
        if(empty($state)){echo 'state cannot be empty <br>';} 
        if(empty($lga)){echo 'lga cannot be empty <br>';} 
        if(empty($position)){echo 'position cannot be empty <br>';} 
        if(empty($qualification)){echo 'qualification cannot be empty <br>';} 
        if(empty($school)){echo 'school cannot be empty <br>';} 
        if(empty($arm)){echo 'arm cannot be empty <br>';}
        if(empty($ambition)){echo 'textarea cannot be empty <br>';}
        // if(empty($image_name)){echo 'image cannot be empty  <br>';}

        if(!empty($firstname) && !empty($lastname) && !empty($middlename) && !empty($gender) && !empty($dob) && !empty($age) && !empty($state) && !empty($lga) && !empty($position) && !empty($qualification) && !empty($school) && !empty($arm)){
            // image target folder
            // $target = "../plugins/profile/".$image_name;
            
            //    image
            // move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql1= "SELECT ";

            $result1 = mysqli_query($conn, $sql1);
            $sql= "INSERT INTO detail (adminId, firstname, lastname, middlename, gender, dob, age, state, lga, position, qualification, school, ambition, arm, image, created) VALUES ('$int', '$firstname', '$lastname', '$middlename', '$gender', '$dob', 
            '$age', '$state', '$lga', '$position', '$qualification', '$school', '$ambition', '$arm', '$image_name', ++$i)";

            $result = mysqli_query($conn, $sql);
            if ($result) {
            echo "submitted";
            }
        } 
    }


    // show profiles
    $Firstname = "NAME";
    $Lastname = "SURNAME";
    $Middlename = "middlename";
    $Gender = "gender";
    $Dob = "date of birth";
    $State = "state of origin";
    $Lga = "local government area";
    $Arm = "arm of government";
    $Aosition = "position holding";
    $Pualification = "qualification holding";
    $Qchool = "school  attended";
    $Smage_name = "silhouette-people-unknown-male-person-260nw-1372192277.jpg";
    $Imbition = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate nam exercitationem nihil
    officiis pariatur odio reiciendis at quas blanditiis facere officia inventore, atque
    enim. Aspernatur assumenda cum error eum dolor!";
    if (isset($_GET['detail'])) {
        $id = $_GET['detail'];
        $sql="SELECT * FROM detail  WHERE id='$id'";
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) == 1) {
            $n = mysqli_fetch_array($records);
            $Firstname = $n['firstname'];
            $Lastname = $n['lastname'];
            $Middlename = $n['middlename'];
            $Gender = $n['gender'];
            $Dob = $n['dob'];
            $State = $n['state'];
            $Lga = $n['lga'];
            $Ambition = $n['ambition'];
            $Arm = $n['arm'];
            $Position = $n['position'];
            $Qualification = $n['qualification'];
            $School = $n['school'];
            $Image_name = $n['image'];
        }
    }


?>