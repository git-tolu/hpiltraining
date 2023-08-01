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
                        <form id="adminRegister" class="needs-validation" method="post" novalidate>
                            <span class="login100-form-title">
                                Registration
                            </span>
                            <div id="error" style="border-radius: 50px;" class="bg-danger d-flex justify-content-center aligin-items-center text-dark"></div>
                            <div class="form-group">
                                <label class="form-label">Date<span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="user_date"
                                    placeholder="Your answer required" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Venue<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_venue" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Office Ext<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_office" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Surname<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_surname" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">First name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_firstname" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_company" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email<span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="user_email" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile phone number<span class="text-red">*</span></label>
                                <input type="number" class="form-control" name="user_number" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The training objective for each topic were identified and
                                    achieved<span class="text-red">*</span></label>
                                <input type="radio" name="training" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="training" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="training" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="training" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="training" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The content was organized and easy to follow<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="content" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="content" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="content" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="content" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="content" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The materials usefull were relevant and usefull<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="materials" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="materials" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="materials" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="materials" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="materials" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The trainer had good knowledge of the subject matter<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="knowledge" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="knowledge" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="knowledge" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="knowledge" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="knowledge" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The mode of deployment and quality of instuction was good<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="deployment" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="deployment" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="deployment" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="deployment" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="deployment" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">There was a good level of online participartion and
                                    interaction<span class="text-red">*</span></label>
                                <input type="radio" name="participartion" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="participartion" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="participartion" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="participartion" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="participartion" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The learning event was relevant<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="relevant" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="relevant" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="relevant" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="relevant" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="relevant" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">The learning event met my expectations<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="expectations" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="expectations" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="expectations" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="expectations" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="expectations" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">I will be able to apply the knowledge acquired<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="apply" value="strongly disagree"><label
                                    class="form-label">strongly disagree</label><br>
                                <input type="radio" name="apply" value="disagree"><label
                                    class="form-label">disagree</label><br>
                                <input type="radio" name="apply" value="indifferent"><label
                                    class="form-label">indifferent</label><br>
                                <input type="radio" name="apply" value="agree"><label
                                    class="form-label">agree</label><br>
                                <input type="radio" name="apply" value="strongly agree"><label
                                    class="form-label">strongly agree</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">What are your two expectations for this course<span
                                        class="text-red">*</span></label>
                                <select name="course" id="">
                                    <option value="option">choose</option>
                                    <option value="option 1">option 1</option>
                                    <option value="option 2">option 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">What suggestion do you have to improve on this learning
                                    event?<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_suggestion" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">What aspect of the learning event kindled your interst most
                                    <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_event" placeholder="Your answer"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Suggestion for improvement<span
                                        class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_improvement"
                                    placeholder="Your answer" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Would you like to recieve updates and mentorship from us <span
                                        class="text-red">*</span></label>
                                <input type="radio" name="updates" value="latest updates"><label
                                    class="form-label">latest updates</label><br>
                                <input type="radio" name="updates" value="Further training and mentorship"><label
                                    class="form-label">Further training and mentorship</label><br>
                                <input type="radio" name="updates" value="other"><label
                                    class="form-label">other</label><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">List Areas you need further training and Mentorship<span
                                        class="text-red">*</span></label>
                                <input type="radio" name="Mentorship" value="option"><label class="form-label">option
                                    1</label><br>
                                <input type="radio" name="Mentorship" value="option"><label class="form-label">option
                                    2</label><br>
                                <input type="radio" name="Mentorship" value="option"><label class="form-label">option
                                    3</label><br>
                                <input type="radio" name="Mentorship" value="option"><label class="form-label">option
                                    4</label><br>
                                <input type="radio" name="Mentorship" value="option"><label
                                    class="form-label">other</label><br>
                            </div>

                            <div class="container-login100-form-btn d-flex justify-content-between">
                                <button id="adminRegisterBtn" class="btn btn-primary" type="submit">Submit form</button>
                                <button type="reset" class="btn btn-danger">reset</button>
                            </div>
                        </form>
                        <form class="needs-validation" novalidate>
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