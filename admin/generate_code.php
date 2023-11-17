<?php
    include_once "controller/session.php";
    $pagetitle="Training Attendance Manager";
	$pagesub="Generate Code";

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
    <title>HPIL – Attendance Manager</title>

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

<body class="app sidebar-mini ltr">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
             <?php 
		   include("includes/appheader.php");
		   ?>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
             <?php 
		   include("includes/appsidebar.php");
		   ?>
                <!--/APP-SIDEBAR-->
            </div>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <?php 
		   include("includes/pageheader.php");
		   ?>
                        <!-- PAGE-HEADER END -->
                        <!--Row -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header  justify-content-between">
                                        <h3 class="card-title">Users Detail</h3>
                                        <button class="modal-effect btn btn-primary btnView"
                                            data-bs-effect="effect-flip-vertical" data-bs-toggle="modal"
                                            href="#modaldemo">Generate Attendance Code</button>
                                    </div>
                                    <div class="card-body">
                                        
                                        <?php   ?>
                                            <div class="table-responsive">
                                                <table id="file-datatable"
                                                    class="table table-bordered text-nowrap key-buttons border-bottom">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">s/n</th>
                                                            <th class="border-bottom-0">program</th>
                                                            <th class="border-bottom-0">Date</th>
                                                            <th class="border-bottom-0">Time</th>
                                                            <!-- <th class="border-bottom-0">User_id</th> -->
                                                            <th class="border-bottom-0">Pincode</th>
                                                            <th class="border-bottom-0">Status</th>
                                                            <!-- <th class="border-bottom-0">Start date</th>
                                                            <th class="border-bottom-0">Salary</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="generatebody">
                                                        <?php
                                                            $sql="SELECT * FROM attendant";
                                                            $results=mysqli_query($conn, $sql);
                                                            $sn = 1;
                                                            while ($info = mysqli_fetch_array($results)) {
                                                                echo '<tr>
                                                                    <td>'.$sn++.'</td>
                                                                    <td>'.$info['program'].'</td>
                                                                    <td>'.$info['date'].'</td>
                                                                    <td>'.$info['time'].'</td>
                                                                    <td>'.$info['pincode'].'</td>
                                                                    <td>'.$info['status'].'</td>
                                                                    </tr>';
                                                                    // <td>'.$info['user_i'].'</td>
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php  ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--End Row-->
                    </div>
                    <!-- CONTAINER CLOSED -->

                </div>
            </div>
            <!--app-content closed-->
        </div>

                <!-- add Modal -->
                <div class="modal fade" id="modaldemo">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Generate Attendance Code</h6><button aria-label="Close" class="btn-close"
                                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                   
                                    <div class="card-body">
                                        <form id="generate">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Generate Attendance Code</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div id="error" style="border-radius: 50px;"
                                                        class="bg-danger text-center justify-content-center aligin-items-center d-flex text-dark">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Training <span
                                                                        class="text-red">*</span></label>
                                                                <select name="program" class="form-control" id="">
                                                                    <option value="">Select Training</option>
                                                                    <?php
                                                                        $sql="SELECT * FROM programs";
                                                                        $results=mysqli_query($conn, $sql);
                                                                        while ($info = mysqli_fetch_array($results)) {
                                                                            echo '<option value="'.$info['program'].'">'.$info['program'].'</option>
                                                                            ';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Learning Page <span
                                                                        class="text-red">*</span></label>
                                                                <input type="text" name="learningpage" class="form-control"
                                                                    placeholder="https://www.bing.com/">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Date Of Program<span
                                                                class="text-red">*</span></label>
                                                        <input type="date" class="form-control" name="date"
                                                            autocomplete="username">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Time Of Program<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" name="time" class="form-control"
                                                            placeholder="8am to 10pm">
                                                    </div>
                                                </div>
                                                        <!-- <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">No of Participants <span
                                                                        class="text-red">*</span></label>
                                                                <input type="number" name="participants" class="form-control"
                                                                    placeholder="no of participants">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center justify-content-center d-flex align-items-center">
                                <button id="generateBtn" class="btn btn-primary">Generate Now</button> <button
                                    class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add Modal -->

        <!-- Sidebar-right -->
      
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        <div class="modal fade" id="country-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row p-3">
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags/us_flag.jpg"
                                            class="me-3 language"></span>USA
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/italy_flag.jpg"
                                            class="me-3 language"></span>Italy
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/spain_flag.jpg"
                                            class="me-3 language"></span>Spain
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/india_flag.jpg"
                                            class="me-3 language"></span>India
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/french_flag.jpg"
                                            class="me-3 language"></span>French
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/russia_flag.jpg"
                                            class="me-3 language"></span>Russia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/germany_flag.jpg"
                                            class="me-3 language"></span>Germany
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                            src="../assets/images/flags/argentina.jpg"
                                            class="me-3 language"></span>Argentina
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags/malaysia.jpg"
                                            class="me-3 language"></span>Malaysia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags/turkey.jpg"
                                            class="me-3 language"></span>Turkey
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Country-selector modal-->

        <!-- FOOTER -->
       <?php 
		   include("includes/footer.php");
		   ?>
        <!-- FOOTER END -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

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

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- Sticky js -->
    <script src="../assets/js/sticky.js"></script>
    <script src="../assets/js/select2.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../assets/js/table-data.js"></script>

    <!-- SWEET-ALERT JS -->
    <script src="../assets/js/sweet.js"></script>

    <script>
        $(document).ready(function () {
            // display the note of user in table 

            // displayUsers()
            // function displayUsers() {
            //     $.ajax({
            //         url: 'controller/shownote.php',
            //         method: 'POST',
            //         data: { action: 'displayUsers' },
            //         success: function (response) {
            //             $("#generatebody").html(response)
            //         }
            //     })
            // }

            // registration processing
            $("#generateBtn").click(function (e) {
                e.preventDefault()
                if ($('#generate')[0].checkValidity()) {
                    $("#generateBtn").val("please wait...")
                    $.ajax({
                        url: 'controller/action.php',
                        method: 'POST',
                        data: $("#generate").serialize() + '&action=generate',
                        success: function (data) {
                            console.log(data)
                            if (data == 'registered') {
                                $("#modaldemo").hide()
                                Swal.fire({
                                    icon: 'success',
                                    title: 'congratulations',
                                    text: 'generated  successfully'
                                }).then(function () {
                                    location.reload()
                                    displayUsers()
                                    $('#generate')[0].reset()
                                    $("#generateBtn").val("Register Participants")
                                })
                            } else {
                                $("#error").html(data)
                            }
                        }
                    })
                }
            })

        })
    </script>

</body>

</html>