<?php 
include_once "controller/config.php";
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
    <title>HPIL: Training Feedback/Evaluation Form </title>
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
                        <img src="../assets/images/brand/logo-white.png" class="header-brand-img m-0" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                         <form  class="needs-validation" method="post" action="reviewprocess.php" novalidate>
                            <span class="login100-form-title">
									<B><font color='red'>Training Feedback/Evaluation Form</font> 
									<?php 
									 $tdate=date("d-M-Y");
									?></B>
								</span>
                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                 <input type="text" class="form-control" name="user_date"
                                    value="<?php echo $tdate; ?>" readonly>
									<input type="hidden" class="form-control" name="user_date"
                                    value="<?php echo $tdate; ?>" required>
                            </div>
							
							
							
							 <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                 <input type="text" class="form-control" name="user_venue" placeholder="Venue"
                                    required>
                            </div>
							
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                 <input type="text" class="form-control" name="user_office" placeholder="Office Ext"
                                    required>
                            </div>
							
							 <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                 <input type="text" class="form-control" name="user_surname" placeholder="Surname"
                                    required>
                            </div>
							
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" name="user_firstname" placeholder="First name"
                                    required>
                            </div>
							
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" name="user_company" placeholder="Company"
                                    required>
                            </div>
							
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                 <input type="email" class="form-control" name="user_email" placeholder="Email"
                                    required>
                            </div>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="number" class="form-control" name="user_number" placeholder="Mobile Phone"
                                    required>
                            </div>
							
							<label class="form-label">The training objective for each topic were identified and
                                    achieved<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country" required>
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							
							<label class="form-label">The content was organized and easy to follow
<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							
							
							<label class="form-label">The materials distributed were relevant and useful

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							<label class="form-label">The trainer had good knowledge of the subject matter

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							
							
							<label class="form-label">The mode of deployment and quality of instruction was good


<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							<label class="form-label">There was a good level of online participation and interaction
<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							<label class="form-label">There was a good level of online participation and interaction
<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							
							
							<label class="form-label">The Learning event was relevant
<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
								<label class="form-label">The Learning event met my expectation
<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							<label class="form-label">I will be able to apply the knowledge acquired

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							<label class="form-label">What is your overall evaluation of this Learning event?

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Strongly Disagree">Strongly Disagree</option>
									<option value="Disagree">Disagree</option>
									<option value="Indifferent">Indifferent</option>
									<option value="Agree">Agree</option>
									<option value="Strongly Agree">Strongly Agree</option>
								  
								</select>
                            </div>
							
							
							
							<label class="form-label">What is your overall evaluation of this Learning event?

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Excellent">Excellent</option>
									<option value="Good">Good</option>
									<option value="Average">Average</option>
									<option value="Poor">Poor</option>
								
								  
								</select>
                            </div>
							
							
							<label class="form-label">What were your top two expectations for this course?

<span class="text-red"> *</span></label>
							<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
								
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Option 1">Option 1</option>
									<option value="Option 2">Option 2</option>
									
								
								  
								</select>
                            </div>
							
						
						<label class="form-label">What suggestions do you have to improve on this learning event?
<span class="text-red"> *</span></label>
						<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" name="user_firstname" placeholder="Your Answer"
                                    required>
                            </div>
							
							
							
						<label class="form-label">What aspect of the learning event kindled your interest most?
<span class="text-red"> *</span></label>
						<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" name="user_firstname" placeholder="Your Answer"
                                    required>
                            </div>
							
							<label class="form-label">Suggestions for improvement
<span class="text-red"> *</span></label>
						<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" name="user_firstname" placeholder="Your Answer"
                                    required>
                            </div>
							
							<label class="form-label">Would you like to recieve latest updates and mentorship from us?
<span class="text-red"> *</span></label>
						<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Latest Updates">Latest Updates</option>
									<option value="Further Training and Mentorship">Further Training and Mentorship</option>
									<option value="Further Training and Mentorship">Further Training and Mentorship</option>
									
								</select>
                            </div>
							
							
							<label class="form-label">List Areas you need further training and Mentorship
<span class="text-red"> *</span></label>
						<div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                               <select name="gender" class="form-control form-select form-select-sm select2" data-bs-placeholder="Select Country">
									<option value="">Select</option>
									<option value="Option 1">Option 1</option>
									<option value="Option 2">Option 2</option>
									<option value="Option 3">Option 3</option>
									<option value="Option 4">Option 4</option>
									
								
								  
								</select>
                            </div>
							
							
							
							
							
						
						
						
                            <div class="container-login100-form-btn">
                               
									 <button name="reviewsubmit" class="login100-form-btn btn-primary" type="submit">Submit</button>
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
    

</body>

</html>