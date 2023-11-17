<?php
include_once "controller/session.php";
// $id = $_GET['id'];
// $sql = "SELECT * FROM training_course WHERE id = $id";
// $results = mysqli_query($conn, $sql);
// $info = mysqli_fetch_assoc($results);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
    <title>Print here</title>
</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px auto;
    }

    .container {
        /* width: 100%; */
        width: 80%;
        padding: 5px;
        border-style: double;
        border-color: black;
        border-width: 10px;
        /* border: 2px double black; */
        background-color: white;
    }

    .logo-placer {
        border: 2px solid black;
        width: 70%;
        margin: 10px auto;
        background-color: blue;
        padding: 25px 50px;
        font-size: 30px;
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    small {
        text-align: center;
        color: red;
        margin: 0px auto;
    }

    .form-placer-two {
        /* display: flex; */
        background-color: rgb(158, 149, 149);
        width: 40%;
        /* padding: 5px; */
        height: auto;
        border-right: 3px solid black;
        border-top: 3px solid black;
        border-bottom: 3px solid black;
    }

    .form-placer-two p {
        line-height: 35px;
    }

    .holder {
        display: flex;
    }

    .inputs {
        width: 100%;
        height: 33px;
        margin-top: 6px;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid black;
        padding-left: 9px;
        /* background-color: yellow; */
    }

    .default {
        width: 100%;
        border: 3px solid black;
    }

    #radio {
        letter-spacing: 100px;
    }

    .feedback {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        font-size: 18px;
        border-bottom: 3px dotted black;
    }

    .feedback-reply {
        background-color: gray;
        padding: 2px 5px;
        font-weight: 900;
    }

    .form-placer-two1 {
        /* display: flex; */
        background-color: rgb(158, 149, 149);
        width: 40%;
        /* padding: 5px; */
        height: auto;
        border-right: 3px solid black;
        border-top: 3px solid black;
        border-bottom: 3px solid black;
    }

    .form-placer-two1 p {
        line-height: 35px;
    }

    .holder1 {
        display: flex;
    }

    .inputs1 {
        width: 100%;
        height: 33px;
        margin-top: 6px;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid black;
        padding-left: 9px;
        /* background-color: yellow; */
    }

    .default1 {
        width: 100%;
        border: 3px solid black;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        empty-cells: show;
    }

    th,
    td {
        padding: 0px 3px;
        border: 1px solid black;
        text-align: center;
    }

    #selectid {
        width: 100%;
        height: 25px;
        border-radius: 0px;

    }

    /* table,th,td,tr{
        border-color: black;
        border-width: 10px;

    } */
    .img-fluid{
        width:100%;
        height:200px;
        object-fit:cover;
        object-position:50% 50%;
        background-size: contain;
    }
    .rowtitle {
        font-weight: 900;
        font-size: 20px;
        text-transform: capitalize;
    }
</style>

<body>
<div class="wrapper" id="tbl_exporttable_to_xls">
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <td colspan="7">
                            <div class="logo-placer">NMA O&M TRAINING FEEDBACK/EVALUATION FORM</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="form-placer">
                                <small style="text-align: center; " class="rowtitle">TRAINING SUMMARY</small>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <?php
                            if (isset($_GET['usoff'])) {
                                $usoff = $_GET['usoff'];
                                $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
                                $results1 = mysqli_query($conn, $sql1);

                                $sn = 1;
                                $fetch = mysqli_fetch_assoc($results1);
                                echo '
                                    <tr>
                                        <td colspan="7"><h3>Training title: ' . $fetch['eventname'] . '<h3></td>
                                ';
                                // while ($fetch = mysqli_fetch_assoc($results1)) {
                                //     # code...
                                //     $usoffice = $fetch['user_office'];
                                //     $eventname = $fetch['eventname'];
                                //     $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                                //     $results = mysqli_query($conn, $sql);
                                //     while ($info = mysqli_fetch_array($results)) {
                                //         echo '
                                //             <tr>
                                //                 <td colspan="">Training title: ' . $fetch['eventname'] . '</td>
                                //         ';
                                //         //     <td colspan="">' . $info['user_firstname'] . '</td>
                                //         //     <td colspan="">' . $info['user_company'] . '</td>
                                //         // <tr>
                                //     }
                                //     //     echo '
                                        
                                //     //         <td colspan="">Batch Training '.$sn++ .'' . $fetch['eventname'] . '</td>
                                //     //     <tr>
                                //     // ';
                                // }
                            }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p class="feedback-reply"><b>If Yes please provide details below</b> (Optional):</p>
                            <div class="holder1">
                    <tr class="form-placer-two1">
                        <td colspan="3" class="rowtitle">*NAME(Last name first)</td>
                        <td colspan="3" class="rowtitle">WORKGROUP</td>
                    <tr>
                        <!-- <div class="form-placer-two1">
                                                                        <p>*NAME(Last name first)</p>
                                                                        <p>WORKGROUP</p>
                                                                    </div> -->
                        <div class="default1">
                            <?php
                            if (isset($_GET['usoff'])) {
                                $usoff = $_GET['usoff'];
                                $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
                                $results1 = mysqli_query($conn, $sql1);

                                while ($fetch = mysqli_fetch_assoc($results1)) {
                                    # code...
                                    $usoffice = $fetch['user_office'];
                                    $eventname = $fetch['eventname'];
                                    $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                                    $results = mysqli_query($conn, $sql);
                                    $sn = 1;
                                    while ($info = mysqli_fetch_array($results)) {
                                        echo '
                                                                                    <tr>
                                                                                        <td colspan="3">' . $info['user_firstname'] . '</td>
                                                                                        <td colspan="3">' . $info['user_company'] . '</td>
                                                                                    <tr>
                                                                                ';
                                    }
                                }
                            }
                            ?>

                        </div>
        </div>

        </td>
        </tr>
        <tr>
            <td colspan="7">
                <div class="holder">
                    <!-- <div >
                                                                        </div> -->
        <tr class="form-placer-two">
            <td class="rowtitle">*NAME(Last name first)</td>
            <td class="rowtitle">WORKGROUP</td>
            <td class="rowtitle">COURSE TITLE</td>
            <td class="rowtitle">VENUE</td>
            <td class="rowtitle">DATE(mm/dd/yy)</td>
        <tr>
            <div class="default">
                <?php
                if (isset($_GET['usoff'])) {
                    $usoff = $_GET['usoff'];
                    $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
                    $results1 = mysqli_query($conn, $sql1);

                    while ($fetch = mysqli_fetch_assoc($results1)) {
                        # code...
                        $usoffice = $fetch['user_office'];
                        $eventname = $fetch['eventname'];
                        $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                        $results = mysqli_query($conn, $sql);
                        $sn = 1;
                        while ($info = mysqli_fetch_array($results)) {
                            echo '
                                                                                    <tr>
                                                                                    <td>' . $info['user_firstname'] . '</td>
                                                                                    <td>' . $info['user_company'] . '</td>
                                                                                    <td>' . $fetch['eventname'] . '</td>
                                                                                    <td>' . $info['user_event'] . '</td>
                                                                                    <td>' . $info['user_date'] . '</td>
                                                                                    <tr>
                                                                                    ';
                        }
                    }
                }
                ?>

            </div>
    </div>
    </td>
    </tr>


    <!-- <tr>
                                                            <th>S/N</th>
                                                            <th>Evaluation Questions</th>
                                                            <th>Strongly Disagree</th>
                                                            <th> Disagree</th>
                                                            <th>Indifferent</th>
                                                            <th>Agree</th>
                                                            <th>Strongly Agree</th>
                                                        </tr> -->
    </thead>
    <tbody>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The training objectives for each topic were
                identified and achieved</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['training'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The content was organized and easy to follow
            </td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['content'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The materials distributed were relevant and
                useful</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['materials'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The trainer had good knowledge of the subject
                matter</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['knowledge'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The mode of deployment and quality of
                instruction was good</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['deployment'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">There was a good level of Class participation
                and interaction</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['participartion'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">Logistics and Accommodation were adequate</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['participartion'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">Learning aids and environment were adequate
            </td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['participartion'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The Learning event was relevant</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['relevant'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">The Learning event met my expectation</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['expectations'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">I will be able to apply the knowledge acquired
            </td>
        </tr>
        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['apply'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">What is your overall evaluation of this
                Learning event?</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td colspan="2">' . $info['user_surname'] . '</td>
                                                                            <td colspan="2">' . $info['user_firstname'] . '</td>
                                                                            <td colspan="2">' . $info['evaluation'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">What were your top two expectations for this
                course?</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['topexpectation'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>

        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">What suggestions do you have to improve on this
                learning event?</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['user_improvement'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>

        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">What aspect of the learning event kindled your
                interest most?</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['user_event'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle"> Suggestions for improvement</td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['user_improvement'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>

        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle"> Would you like to recieve latest updates and
                mentorship from us? </td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['updates'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>
            <td colspan="6" style="text-align: center;" class="rowtitle">List Areas you need further training and
                Mentorship </td>
        </tr>

        <?php
        if (isset($_GET['usoff'])) {
            $usoff = $_GET['usoff'];
            $sql1 = "SELECT DISTINCT  eventname,user_office FROM userattendance WHERE eventname LIKE '%" . $usoff . "%' ";
            $results1 = mysqli_query($conn, $sql1);

            while ($fetch = mysqli_fetch_assoc($results1)) {
                # code...
                $usoffice = $fetch['user_office'];
                $eventname = $fetch['eventname'];
                $sql = "SELECT * FROM form_review WHERE user_office='$usoffice'";
                $results = mysqli_query($conn, $sql);
                $sn = 1;
                while ($info = mysqli_fetch_array($results)) {
                    echo '
                                                                        <tr>
                                                                            <td>' . $info['user_surname'] . '</td>
                                                                            <td>' . $info['user_firstname'] . '</td>
                                                                            <td style="text-align: left;" colspan="6"> ' . $info['mentorship'] . '</td>
                                                                        </tr>
                                                                        ';
                }
            }
        }
        ?>
        <tr>

            <td style="text-align: center;" colspan="7"><b>Thanks for participating</b> </td>
        </tr>
    </tbody>
            </table>
        </div>
    </div>
    <button onclick="ExportToExcel('xlsx')">Export table to excel</button>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript">
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
        // var tableToExcel = (function() {
        //     var uri = 'data:application/vnd.ms-excel;base64,',
        //         template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
        //         base64 = function(s) {
        //             return window.btoa(unescape(encodeURIComponent(s)))
        //         },
        //         format = function(s, c) {
        //             return s.replace(/{(\w+)}/g, function(m, p) {
        //                 return c[p];
        //             })
        //         }
        //     return function(table, name) {
        //         if (!table.nodeType) table = document.getElementById(table)
        //         var ctx = {
        //             worksheet: name || 'Worksheet',
        //             table: table.innerHTML
        //         }
        //         window.location.href = uri + base64(format(template, ctx))
        //     }
        // })()
    </script>
</body>

</html>