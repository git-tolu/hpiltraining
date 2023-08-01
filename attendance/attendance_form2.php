<?php
  include_once "controller/config.php";
//   if (isset($_SESSION['user_venue'])) {
//       header("location: dashboard.php");
//   }

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
                    <div class="text-center">
                        <img src="../assets/images/brand/logo-white.png" class="header-brand-img" alt="">

                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
					
					      <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Gerenal Elements</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Text</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="Typing.....">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="example-email">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email" autocomplete="username">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" value="password" autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Placeholder</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="text">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Readonly</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" readonly="" value="Readonly value">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Disabled</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" disabled value="Disabled value">
                                                </div>
                                            </div>
                                            <div class=" row mb-4 mb-4">
                                                <label class="col-md-3 form-label">Number</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="number" name="number">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">URL</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="url" name="url">
                                                </div>
                                            </div>
                                            <div class=" row mb-4">
                                                <label class="col-md-3 form-label">Search</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="search" name="search">
                                                </div>
                                            </div>
                                            <div class=" row mb-0">
                                                <label class="col-md-3 form-label">Tel</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="tel" name="tel">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
							
                        
                        
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

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- SWEET-ALERT JS -->
    <script src="../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="../assets/js/sweet-alert.js"></script>

    <!-- SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

    <!-- FORMVALIDATION JS -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- register ajax -->
    <script>
        // registration processing
        $("#adminRegisterBtn").click(function (e) {
            if ($('#adminRegister')[0].checkValidity()) {
                // $("#adminRegisterBtn").text("please wait...")
                e.preventDefault()
                // window.location.replace("dashboard.php")
                $.ajax({
                    url: 'controller/action.php',
                    method: 'POST',
                    data: $("#adminRegister").serialize() + '&actionreg=reg',
                    success: function (data) {
                        console.log(data)
                        if (data == 'submitted') {
                            swal('Congratulations!', 'Submitted Successfully', 'success').then(function () {
                            })
                            // $("#adminRegisterBtn").text("Submit")
                            $('#adminRegister')[0].reset()
                        } else {
                            $("#error").html("check for empty radio fields")
                            // $("#error").html(data)
                        }
                    }
                })
            }
        })
    </script>

</body>

</html>