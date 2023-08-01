<?php
    include "config.php";

if(isset($_POST['action']) && $_POST['action'] == 'displayNote'){
    $sql="SELECT * FROM programs";
    $results=mysqli_query($conn, $sql);
    $sn = 1;
    $output = '';

    if ($results) {
        $output .= '';
        while ($info = mysqli_fetch_array($results)) {
            $output .= '<tr>
            <td>'.$sn++.'</td>
            <td>'.$info['program'].'</td>
            <td>'.$info['date'].'</td>
            <td>'.$info['time'].'</td>
            <td><button id="'.$info['id'].'" class="modal-effect btn btn-primary btnView" data-bs-effect="effect-flip-vertical" data-bs-toggle="modal" href="#modaldemo8"><span class="fe fe-edit"></span></button>
            <button id="'.$info['id'].'"  class="btn btn-danger btnDelete"><span class="fe fe-trash-2"></span></button></td>
        </tr>';
        }
        // foreach ($info as $infos) {
        //     $output .= '<tr>
        //     <td>'.$sn++.'</td>
        //     <td>'.$info['program'].'</td>
        //     <td>'.$info['date'].'</td>
        //     <td>'.$info['time'].'</td>
        //     <td><button  id="'.$info['id'].'" class="btn btn-primary"><span class="fe fe-edit"></span></button>
        //     <button id="'.$info['id'].'"  class="btn btn-danger"><span class="fe fe-trash-2"></span></button></td>
        // </tr>';
            
        // }
        echo $output;
        // ;
    }else{
        echo "no data found";
    } 
}

if(isset($_POST['action']) && $_POST['action'] == 'displayUsers'){
    $sql="SELECT * FROM attendant";
    $results=mysqli_query($conn, $sql);
    $sn = 1;
    $output = '';

    if ($results) {
        $output .= '';
        while ($info = mysqli_fetch_array($results)) {
            $output .= '<tr>
            <td>'.$sn++.'</td>
            <td>'.$info['program'].'</td>
            <td>'.$info['user_id'].'</td>
            <td>'.$info['pincode'].'</td>
        </tr>';
        }
        echo $output;
        // ;
    }else{
        echo "no data found";
    } 
}

    // delete note
    if (isset($_POST['deleteNote'])) {
        $id = $_POST['deleteNote'];
        echo $id; 
        $sql = "DELETE FROM programs WHERE id = '$id' ";
        $records = mysqli_query($conn, $sql);
    }

    
    // edit note
    if(isset($_POST['editNote'])){
        $id = $_POST['editNote'];
        $sql="SELECT * FROM programs where id  = '$id'";
        $results=mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($results);
        if ($result) {
            echo '<form id="programUpdate" class="form-horizontal">

            <div class=" row mb-4">
                <label for="inputName" class="col-md-3 form-label">Name of Program </label>'.$result['id'].'
                <div class="col-md-9">
                    <input type="hidden" class="form-control" name="id"  value="">
                    <input type="text" class="form-control" name="program"  value="'.$result['program'].'">
                </div>
            </div>
            <div class=" row mb-4">
                <label for="inputEmail3" class="col-md-3 form-label">Date Of Program</label>
                <div class="col-md-9">
                    <input type="date" class="form-control" name="date"  value="'.$result['date'].'"
                        >
                </div>
            </div>
            <div class=" row mb-4">
                <label for="inputPassword3" class="col-md-3 form-label">Time Of Program</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="time"  value="'.$result['time'].'"
                        >
                </div>
            </div>
        </form>';
        }else {
            echo"data not found";
        }
    }
    
    // edit note
    if(isset($_POST['view'])){
        $id = $_POST['view'];
        $sql="SELECT * FROM form_review where id  = '$id'";
        $results=mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($results);
        if ($result) {
            echo '
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Name of Program </label><h3>'.$result['user_date'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Venue</label><h3>'.$result['user_venue'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Office</label><h3>'.$result['user_office'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Surname</label><h3>'.$result['user_surname'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Firstname</label><h3>'.$result['user_firstname'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Company</label><h3>'.$result['user_company'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Email</label><h3>'.$result['user_email'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Number</label><h3>'.$result['user_number'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Gender</label><h3>'.$result['gender'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Job</label><h3>'.$result['user_job'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Department</label><h3>'.$result['user_department'].'</h3>
            </div>
        ';
        }else {
            echo"data not found";
        }
    }

    // form review note
    if(isset($_POST['view2'])){
        $id = $_POST['view2'];
        $sql="SELECT * FROM userattendance where id  = '$id'";
        $results=mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($results);
        if ($result) {
            echo '
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Name of Program </label><h3>'.$result['user_date'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Venue</label><h3>'.$result['user_venue'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Office</label><h3>'.$result['user_office'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Surname</label><h3>'.$result['user_surname'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Firstname</label><h3>'.$result['user_firstname'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Company</label><h3>'.$result['user_company'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Email</label><h3>'.$result['user_email'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Number</label><h3>'.$result['user_number'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Gender</label><h3>'.$result['gender'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Job</label><h3>'.$result['user_job'].'</h3>
            </div>
            <div class=" row mb-4">
                <label for="inputName" class=" form-label">Department</label><h3>'.$result['user_department'].'</h3>
            </div>
        ';
        }else {
            echo"data not found";
        }
    }
