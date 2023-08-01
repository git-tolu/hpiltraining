<?php
    include_once "config.php";

    // category registration
    if (isset($_POST['action']) && $_POST['action'] == 'generate') {
        // var_dump($_POST);
        // Grab info from form
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $int = 1;

        // Check for empty fields
        if(empty($category)){ echo  'category is required <br>';}


        if(!empty($category)){
            //    Finally register the ADMIN
            $sql = "INSERT INTO training_course_category (category) VALUES ('$category')";
            mysqli_query($conn, $sql);
            echo "registered"; 
        }
    }

    // course registration
    if (isset($_FILES['cover_image'])) {
        // var_dump($_POST);
        // Grab info from form
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $mode = mysqli_real_escape_string($conn, $_POST['mode']);
        $cover_image = mysqli_real_escape_string($conn, $_FILES['cover_image']['name']);

        // Check for empty fields
        if(empty($title)){ echo 'title cannot be empty <br>';}
        if(empty($category)){ echo  'category cannot be empty <br>';}
        if(empty($description)){ echo  'description is required <br>';}
        if(empty($amount)){ echo  'amount is required <br>';}
        if(empty($mode)){ echo  'mode is required <br>';}
        if(empty($cover_image)){ echo  'cover_image is required <br>';}

        if(!empty($title) && !empty($category) && !empty($description) && !empty($amount) && !empty($cover_image) && !empty($mode)){
            //    Finally register the program
            $cover_image_new = time().rand(1000, 900000);
            move_uploaded_file($_FILES['cover_image']['tmp_name'], 'coursePic/'.$cover_image_new);
            $order_code = 'hpil' . rand(1000, 9000);
            $sql1 = "INSERT INTO training_course (title, order_code, category, description, amount, cover_image, mode) VALUES ('$title', '$order_code', '$category', '$description', '$amount', '$cover_image_new', '$mode')";
            mysqli_query($conn, $sql1);
            echo "registered";
        }
    }

    // delete course
    if (isset($_POST['deleteNote'])) {
        $id = $_POST['deleteNote'];
        echo $id; 
        $sql = "DELETE FROM training_course WHERE id = '$id' ";
        $records = mysqli_query($conn, $sql);
    }
    if (isset($_POST['deleteONline'])) {
        $id = $_POST['deleteONline'];
        echo $id; 
        $sql = "DELETE FROM course_participant WHERE id = '$id' ";
        $records = mysqli_query($conn, $sql);
    }
    
     // edit course
     if(isset($_POST['editNote'])){
        $id = $_POST['editNote'];
        $sql="SELECT * FROM training_course where id  = '$id'";
        $results=mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($results);
        if ($result) {
            echo '<form id="programUpdate" class="form-horizontal">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Title of training <span
                                class="text-red">*</span></label>
                    <input type="hidden" class="form-control" name="id"  value="'.$result['id'].'">

                        <input type="text" name="title" class="form-control"
                            value="'.$result['title'].'">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Category Of training<span
                                class="text-red">*</span></label>
                            <select name="category" class="form-control" id="">
                                <option value="'.$result['category'].'">'.$result['category'].'</option>
                                ' ?><?php
                                    $sql5="SELECT * FROM training_course_category";
                                    $results5=mysqli_query($conn, $sql5);
                                    while ($info5 = mysqli_fetch_array($results5)) {
                                        echo '<option value="'.$info5['category'].'">'.$info5['category'].'</option>';
                                    }
                                ?><?php
                            echo '</select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Description Of training<span
                                class="text-red">*</span></label>
                        <input type="text" name="description" class="form-control"
                            value="'.$result['description'].'">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Amount Of training<span
                                class="text-red">*</span></label>
                        <input type="number" name="amount" class="form-control"
                            value="'.$result['amount'].'">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Mode Of training<span
                                class="text-red">*</span></label>
                            <select name="mode" class="form-control" id="">
                                <option value="">Select Mode</option>
                                <option value="Physical Training">Physical Training</option>
                                <option value="Virtual Training">Virtual Training</option>
                            </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Upload Image<span
                                class="text-red">*</span></label>
                        <input type="file" name="cover_image_update" class="form-control"
                            placeholder="Cover Image">
                    </div>
                </div>
        </form>';
        }else {
            echo"data not found";
        }
    }

    // course update 
    if (isset($_FILES['cover_image_update'])) {
        // var_dump($_POST);
        // Grab info from form
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $mode = mysqli_real_escape_string($conn, $_POST['mode']);
        $cover_image = mysqli_real_escape_string($conn, $_FILES['cover_image_update']['name']);

        // Check for empty fields
        if(empty($title)){ echo 'title cannot be empty <br>';}
        if(empty($category)){ echo  'category cannot be empty <br>';}
        if(empty($description)){ echo  'description is required <br>';}
        if(empty($amount)){ echo  'amount is required <br>';}
        if(empty($mode)){ echo  'mode is required <br>';}
        if(empty($cover_image)){ echo  'cover_image is required <br>';}

        if(!empty($title) && !empty($category) && !empty($description) && !empty($amount) && !empty($cover_image) && !empty($mode)){
            //    Finally register the program
            $cover_image_new = time().rand(1000, 900000);
            move_uploaded_file($_FILES['cover_image_update']['tmp_name'], 'coursePic/'.$cover_image_new);
            $sql1 = "UPDATE `training_course` SET `title` = '$title', `category` = '$category', `description` = '$description', `amount` = '$amount', `cover_image` = '$cover_image_new', `mode` = '$mode' WHERE id = '$id'";
            mysqli_query($conn, $sql1);
            echo "registered";
        }
    }

        // delete course
        if (isset($_POST['deleteCourse'])) {
            $id = $_POST['deleteCourse'];
            echo $id; 
            $sql = "DELETE FROM training_course_category WHERE id = '$id' ";
            $records = mysqli_query($conn, $sql);
        }

        // 
        if(isset($_POST['detail'])){
            $id = $_POST['detail'];
            $sql="SELECT * FROM shopping_cart where order_code  = '$id'";
            $results=mysqli_query($conn, $sql);
            $t = 0;

            if ($results) {
                echo '
                <div class="table-responsive">
                    <table id="basic-datatable"
                        class="table table-bordered  border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-capitalize">s/n</th>
                                <th class="border-bottom-0 text-capitalize">item code</th>
                                <th class="border-bottom-0 text-capitalize">title</th>
                                <th class="border-bottom-0 text-capitalize">no of seats</th>
                                <th class="border-bottom-0 text-capitalize"> unit price </th>
                                <th class="border-bottom-0 text-capitalize"> total price </th>
                            </tr>
                        </thead>
                        <tbody>
                            ' ?><?php
                            $sn = 1;
                            while ($info = mysqli_fetch_array($results)) {
                                $t += $info['total_price'];
                                echo '<tr>
                                    <td>'.$sn++.'</td>
                                    <td>'.$info['item_code'].'</td>
                                    <td>'.$info['title'].'</td>
                                    <td>'.$info['no_of_seats'].'</td>
                                    <td>'." ₦ " . number_format($info['unit_price'], 2).'</td>
                                    <td>'. " ₦ " . number_format($info['total_price'], 2).'</td>
                                    </tr>';
                            }
                            echo '
                                <tr>
                                    <td colspan="6" class="text-end">Grand Total : ' . " ₦ " . number_format($t, 2)  . '</td>
                                </tr>
                            ';
                            ?><?php echo '
                        </tbody>
                    </table>
                </div>
                ';
            }else {
                echo"data not found";
            }
        }
    