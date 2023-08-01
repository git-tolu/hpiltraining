<?php
    include_once "controller/session.php";
	$pagetitle="Event Attendance Manager";
	$pagesub="Event Review";
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
    <title>HPIL – Attendance Manager </title>

    
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

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

        <?php 
		   include("includes/appheader.php");
		   ?>

            <!--APP-SIDEBAR-->
           <?php 
		   include("includes/appsidebar.php");
		   ?>

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

                        <!-- ROW-1 -->
                                        <div class="row">
                           
                        </div>
                        <!--End Row -->
                        <!--Row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header justify-content-between">
                                        <h3 class="card-title">Review Table</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="file-datatable"
                                                class="table table-bordered text-nowrap key-buttons border-bottom">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">s/n</th>
                                                        <th class="border-bottom-0">Date</th>
                                                        <th class="border-bottom-0">Venue</th>
                                                        <th class="border-bottom-0">Office</th>
                                                        <th class="border-bottom-0">Surname</th>
                                                        <th class="border-bottom-0">Firstname</th>
                                                        <th class="border-bottom-0">Company</th>
                                                        <th class="border-bottom-0">Email</th>
                                                        <th class="border-bottom-0">Phone</th>
                                                        <th class="border-bottom-0">The training objective for each topic were identified and achieved</th>
                                                        <th class="border-bottom-0">The content was organized and easy to follow</th>
                                                        <th class="border-bottom-0">The materials distributed were relevant and useful</th>
                                                        <th class="border-bottom-0">The trainer had good knowledge of the subject matter</th>
                                                        <th class="border-bottom-0">The mode of deployment and quality of instruction was good</th>
                                                        <th class="border-bottom-0">There was a good level of online participation and interaction</th>
                                                        <th class="border-bottom-0">The Learning event was relevant</th>
                                                        <th class="border-bottom-0">The Learning event met my expectation</th>
                                                        <th class="border-bottom-0">I will be able to apply the knowledge acquired</th>
                                                        <th class="border-bottom-0">What is your overall evaluation of this Learning event?</th>
                                                        <th class="border-bottom-0">What were your top two expectations for this course?</th>
                                                        <th class="border-bottom-0">What aspect of the learning event kindled your interest most?</th>
                                                        <th class="border-bottom-0">Suggestions for improvement</th>
                                                        <th class="border-bottom-0">Would you like to recieve latest updates and mentorship from us?</th>
                                                        <th class="border-bottom-0">List Areas you need further training and Mentorship</th>
													
													
													</tr>
                                                </thead>
                                                <tbody id="programsbody">
                                                    <?php
                                                    $sql="SELECT * FROM form_review";
                                                    $results=mysqli_query($conn, $sql);
                                                    $sn = 1;
                                                    while ($info = mysqli_fetch_array($results)) {
                                                        echo '<tr>
                                                            <td>'.$sn++.'</td>
                                                            <td>'.$info['user_date'].'</td>
                                                            <td>'.$info['user_venue'].'</td>
                                                            <td>'.$info['user_office'].'</td>
                                                            <td>'.$info['user_surname'].'</td>
                                                            <td>'.$info['user_firstname'].'</td>
                                                            <td>'.$info['user_company'].'</td>
                                                            <td>'.$info['user_email'].'</td>
                                                            <td>'.$info['user_number'].'</td>
                                                            <td>'.$info['training'].'</td>
                                                            <td>'.$info['content'].'</td>
                                                            <td>'.$info['materials'].'</td>
                                                            <td>'.$info['knowledge'].'</td>
                                                            <td>'.$info['deployment'].'</td>
                                                            <td>'.$info['participartion'].'</td>
                                                            <td>'.$info['relevant'].'</td>
                                                            <td>'.$info['expectations'].'</td>
                                                            <td>'.$info['apply'].'</td>
                                                            <td>'.$info['evaluation'].'</td>
                                                            <td>'.$info['topexpectation'].'</td>
                                                            <td>'.$info['user_event'].'</td>
                                                            <td>'.$info['user_improvement'].'</td>
                                                            <td>'.$info['updates'].'</td>
                                                            <td>'.$info['mentorship'].'</td>
                                                        </tr>';
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                       
                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <!-- Sidebar-right -->
        
        
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
    <!-- INTERNAL Edit-Table JS -->
    <script src="../assets/plugins/edit-table/bst-edittable.js"></script>
    <script src="../assets/plugins/edit-table/edit-table.js"></script>
    <!-- SWEET-ALERT JS -->
    <script src="../assets/js/sweet.js"></script>
    <script>
        $(document).ready(function () {
            // display the note of user in table 
            // displayAllNote()
            // function displayAllNote() {
            //     $.ajax({
            //         url: 'controller/shownote.php',
            //         method: 'POST',
            //         data: { action: 'displayNote' },
            //         success: function (response) {
            //             $("#programsbody").html(response)
            //         }
            //     })
            // }

            // registration processing
            $("#generateBtn").click(function (e) {
                e.preventDefault()
                if ($('#generate')[0].checkValidity()) {
                    $("#generateBtn").val("please wait...")
                    $("")
                    $.ajax({
                        url: 'controller/action.php',
                        method: 'POST',
                        data: $("#generate").serialize() + '&action=programs',
                        success: function (data) {
                            console.log(data)
                            if (data == 'registered') {
                                $("#modaldemo").modal("hide")
                                Swal.fire({
                                    icon: 'success',
                                    title: 'congratulations',
                                    text: 'program registered  successfully'
                                }).then(function () {
                                    location.reload()
                                    displayAllNote()
                                    $('#generate')[0].reset()
                                    $("#generateBtn").val("Register Programs")
                                })
                            } else {
                                $("#error").html(data)
                            }
                        }
                    })
                }
            })


            // delete note
            $('body').on('click', '.btnDelete', function (e) {
                e.preventDefault()
                deleteNote = $(this).attr('id')
                // console.log(deleteNote)

                Swal.fire({
                    title: 'Delete?',
                    text: 'Are you sure you want to delete this program?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#FF0000",
                    cancelButtonColor: "blue",
                    confirmButtonText: 'Delete Program'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'controller/shownote.php',
                            method: 'POST',
                            data: { deleteNote: deleteNote },
                            success: function (response) {
                                console.log(response)
                                Swal.fire({
                                    icon: 'success',
                                    text: 'You have successfully deleted a Program',
                                    title: 'Program Deleted'
                                }).then(function () {
                                    location.reload()
                                    displayAllNote()
                                })
                            }
                        })
                    }
                })
            })

            // grab contents to edit
            $('body').on('click', '.btnView', function (e) {
                e.preventDefault()
                view = $(this).attr('id')
                console.log(view)
                $.ajax({
                    url: 'controller/shownote.php',
                    method: 'POST',
                    data: { view: view },
                    success: function (response) {
                        console.log(response)
                        $("#modalForm").html(response)
                    }
                })
            })

            // grab contents to edit
            $('body').on('click', '.btnView1', function (e) {
                e.preventDefault()
                view2 = $(this).attr('id')
                console.log(view2)
                $.ajax({
                    url: 'controller/shownote.php',
                    method: 'POST',
                    data: { view2: view2 },
                    success: function (response) {
                        console.log(response)
                        $("#modalForm2").html(response)
                    }
                })
            })

            // update processing
            $("#programUpdateBtn").click(function (e) {
                e.preventDefault()
                if ($('#programUpdate')[0].checkValidity()) {
                    $("#programUpdateBtn").val("please wait...")
                    $.ajax({
                        url: 'controller/action.php',
                        method: 'POST',
                        data: $("#programUpdate").serialize() + '&action=programUpdate',
                        success: function (data) {
                            // console.log(data)
                            if (data == 'registered') {
                                $("#modaldemo8").modal("hide")
                                Swal.fire({
                                    icon: 'success',
                                    title: 'congratulations',
                                    text: 'program successfully edited'
                                }).then(function () {
                                    location.reload()
                                    displayAllNote()
                                    $('#programUpdate')[0].reset()
                                    $("#programUpdateBtn").val("Save changes")
                                })
                            } else {
                                $("#errors").html(data)
                            }
                        }
                    })
                }
            })


        })
    </script>

</body>

</html>