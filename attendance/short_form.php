<?php
include_once "controller/config.php";
// if (isset($_SESSION['user_firstname'])) {
//     header("location: attendance_form.php");
// }

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Sash</title>
    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- STYLE CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/dark-style.css" rel="stylesheet" />
    <link href="../assets/css/transparent-style.css" rel="stylesheet">
    <link href="../assets/css/skin-modes.css" rel="stylesheet" />
    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet" />
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center d-flex justify-content-center align-items-center">
                        <img src="../assets/images/brand/logo-white.png" class="header-brand-img" alt="">
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form id="adminRegister" class="needs-validation" method="post" novalidate style="width: 50vw;">
                            <span class="login100-form-title">
                                Registration
                            </span>
                            <div class="text-end d-flex justify-content-end align-items-end">
                                <a href="attendance_form.php" class="btn btn-primary">
                                    Form Review
                                </a>
                            </div>
                            <div id="error" style="border-radius: 50px;" class="bg-danger d-flex justify-content-center aligin-items-center text-dark"></div>
                            <div class="form-group">
                                <label class="form-label">Date<span class="text-red">*</span></label>
                                <input type="date" class="form-control" id="validationDefault01" name="user_date"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_dateerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Venue<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_venue" name="user_venue"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_venueerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Office Ext<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_office" name="user_office"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_officeerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Surname<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_surname" name="user_surname"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_surnameerr" required></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">First name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_firstname" name="user_firstname"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_firstnameerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company Name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_company" name="user_company"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_companyerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email<span class="text-red">*</span></label>
                                <input type="email" class="form-control" id="user_email" name="user_email"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_emailerr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile phone number<span class="text-red">*</span></label>
                                <input type="number" class="form-control" id="user_number" name="user_number"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_numbererr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sex<span class="text-red">*</span></label>
                                <input type="radio" class="form-radio" name="gender" value="male"><label
                                    class="form-label">male</label>
                                <input type="radio" class="form-radio" name="gender" value="female"><label
                                    class="form-label">female</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Job role<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_job" name="user_job"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_joberr"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Work Group/Department<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="user_department" name="user_department"
                                    placeholder="Your answer" required>
                                <span class="text-danger" id="user_departmenterr"></span>
                            </div>
                            <div class="container-login100-form-btn d-flex justify-content-between">
                                <button id="adminRegisterBtn" type="submit" class="btn btn-primary "
                                    value='success alert'>Submit</button>
                                <button type="reset" class="btn btn-danger">reset</button>
                                <!-- <input type='button' class="btn btn-success mt-2 "> -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="../assets/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="../assets/js/generate-otp.js"></script>


    <!-- INPUT MASK JS-->
    <script src="../assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- TypeHead js -->
    <script src="../assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="../assets/js/typehead.js"></script>

    <!-- SIDEBAR JS -->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

    <!-- FORMVALIDATION JS -->
    <script src="../assets/js/form-validation.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- Sticky js -->
    <script src="../assets/js/sticky.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>
    <!-- SWEET-ALERT JS -->
    <script src="../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <!-- <script src="../assets/js/sweet-alert.js"></script> -->

    <script>
        // $(document).on("click", ".click", function (e) {
        //     // e.preventDefault()
        //     // window.location.href= "attendance_form.php";
        //     swal('Congratulations!', 'Submitted Successfully', 'success').then(function(){
        //         window.open('attendance_form.php')
        //     })
        // });
        // registration processing
        $("#adminRegisterBtn").click(function (e) {
            if ($('#adminRegister')[0].checkValidity()) {
                $("#adminRegisterBtn").text("please wait...")
                // window.location.replace("attendance_form.php")
                e.preventDefault()
                $.ajax({
                    url: 'controller/action.php',
                    method: 'POST',
                    data: $("#adminRegister").serialize() + '&actionreg=short',
                    success: function (data) {
                        console.log(data)
                        if (data == 'submitted') {
                            swal('Congratulations!', 'Submitted Successfully', 'success').then(function () {
                                // location.href = "dashboard.php"
                            })
                            $("#adminRegisterBtn").addClass("click")
                            $('#adminRegister')[0].reset()
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'congratulations',
                            //     text: 'submitted successfully'
                            // }).then(function () {
                            //     location.href = "attendance_form.php"
                            // })
                        } else {
                            $("#error").html("check for empty radio fields")
                            $("#adminRegisterBtn").text("Submit")
                        }
                    }
                })
            }
        })
    </script>

</body>

</html>