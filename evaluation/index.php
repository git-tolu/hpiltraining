<?php 
    include_once "controller/config.php"; 
session_destroy();
unset($_SESSION['attendancecode'])  ;
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
    <title>HPIL Attendance Access</title>

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

                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="../assets/images/brand/logo-white.png" class="header-brand-img" alt="">
                    </div>
                </div>
                <!-- CONTAINER OPEN -->
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <div id="error" style="border-radius: 50px;"
                            class="bg-danger text-center justify-content-center aligin-items-center d-flex text-dark">
                        </div>
                        <form id="userLogin" class="login100-form validate-form">
                           <!-- <div class="wrap-input100 validate-input input-group"
                                data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" name="username" type="text"
                                    placeholder="User name" required>
                            </div> --->
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle"
                                data-bs-validate="Password is required">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" name="password" type="text"
                                    placeholder="Attendance Code" required>
                            </div>
                            <div class="container-login100-form-btn pt-0">
                                <a id="userLoginBtn" href="" class="login100-form-btn btn-primary">
                                    Give Me Access
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End GLOABAL LOADER -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="../assets/js/show-password.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>
    <!-- SWEET-ALERT JS -->
    <script src="../assets/js/sweet.js"></script>
    <!-- register ajax -->
    <script>
        $(document).ready(function () {
            // user login processing
            $("#userLoginBtn").click(function (e) {
                e.preventDefault()
                if ($('#userLogin')[0].checkValidity()) {
                    $("#userLoginBtn").val("please wait...")
                    $.ajax({
                        url: 'controller/action.php',
                        method: 'POST',
                        data: $("#userLogin").serialize() + '&action=userLogin',
                        success: function (data) {
                            console.log(data)
                            if (data == 'login') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Congratulations',
                                    text: 'Access Granted'
                                }).then(function () {
                                    location.href = "evaluation_form.php"
                                })
                            } else {
                                $("#error").html(data)
                                $("#userLoginBtn").val("")
                            }
                        },
                    })
                }
            })
        })
    </script>

</body>

</html>