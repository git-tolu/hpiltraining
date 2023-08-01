<?php
include_once "controller/session.php";
$id = $_GET['id'];
$sql = "SELECT * FROM training_course WHERE id = $id";
$results = mysqli_query($conn, $sql);
$info = mysqli_fetch_assoc($results);

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
</style>

<body>
    <div class="wrapper" id="tbl_exporttable_to_xls">
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <td colspan="5">
                            <div class="logo-placer">Course Details</div>
                        </td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>title</th>
                        <th>category</th>
                        <th>description</th>
                        <th>amount</th>
                        <th>cover_image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $info['title'] ?></td>
                        <td><?= $info['category'] ?></td>
                        <td><?= $info['description'] ?></td>
                        <td><?= $info['amount'] ?></td>
                        <td><img src="controller/coursePic/<?=$info['cover_image'] ?>"  class="img-fluid"></td>
                    </tr>
                </tbody>
                <!-- <thead>
                    <tr>
                        <td colspan="7">
                            <div class="logo-placer">NMA O&M TRAINING FEEDBACK/EVALUATION FORM</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="form-placer">
                                <small style="text-align: center;">Please note that items marked (*) are optional</small>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p class="feedback-reply"><b>If Yes please provide details below</b> (Optional):</p>
                            <div class="holder1">
                                <div class="form-placer-two1">
                                    <p>*NAME(Last name first)</p>
                                    <p>WORKGROUP</p>
                                </div>
                                <div class="default1">
                                    <input type="text" class="inputs1" placeholder="<?= $info['user_firstname'] ?>"> <br>
                                    <input type="text" class="inputs1" placeholder="<?= $info['user_company'] ?>"> <br>

                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="holder">
                                <div class="form-placer-two">
                                    <p>*NAME(Last name first)</p>
                                    <p>WORKGROUP</p>
                                    <p>COURSE TITLE</p>
                                    <p>VENUE</p>
                                    <p>DATE(mm/dd/yy)</p>
                                </div>
                                <div class="default">
                                    <input type="text" class="inputs" placeholder="<?= $info['user_firstname'] ?>"> <br>
                                    <input type="text" class="inputs" placeholder="<?= $info['user_company'] ?>"> <br>
                                    <input type="text" class="inputs" placeholder="<?= $info['course'] ?>"> <br>
                                    <input type="text" class="inputs" placeholder="<?= $info['user_event'] ?>"> <br>
                                    <input type="text" class="inputs" placeholder="<?= $info['user_date'] ?>"> <br>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="feedback">
                                <p>Would you like to be contacted concerning your feedback </p> 
                                <input type="radio" name="check" id="radio" <?php if ($info['updates'] == 'Yes') {echo 'checked';} ?>>
                                <label for="">Yes</label> 
                                <input type="radio" name="check" id="radio" <?php if ($info['updates'] == 'No') {echo 'checked';} ?>> 
                                <label for="">No </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>S/N</th>
                        <th>Evaluation Questions</th>
                        <th>Strongly Disagree</th>
                        <th> Disagree</th>
                        <th>Indifferent</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td style="text-align:left;">The training objectives for each topic were identified and achieved</td>
                        <td><input type="radio" name="" id="" <?php if ($info['training'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['training'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['training'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['training'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['training'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td style="text-align:left;">The content was organized and easy to follow</td>
                        <td><input type="radio" name="" id="" <?php if ($info['content'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['content'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['content'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['content'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['content'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td style="text-align:left;">The materials distributed were relevant and useful</td>
                        <td><input type="radio" name="" id="" <?php if ($info['materials'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['materials'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['materials'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['materials'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['materials'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td style="text-align:left;">The trainer had good knowledge of the subject matter</td>
                        <td><input type="radio" name="" id="" <?php if ($info['knowledge'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['knowledge'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['knowledge'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['knowledge'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['knowledge'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td style="text-align:left;">The mode of deployment and quality of instruction was good</td>
                        <td><input type="radio" name="" id="" <?php if ($info['deployment'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['deployment'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['deployment'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['deployment'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['deployment'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td style="text-align:left;">There was a good level of Class participation and interaction</td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td style="text-align:left;">Logistics and Accommodation were adequate</td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td style="text-align:left;">Learning aids and environment were adequate</td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['participartion'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td style="text-align:left;">The Learning event was relevant</td>
                        <td><input type="radio" name="" id="" <?php if ($info['relevant'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['relevant'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['relevant'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['relevant'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['relevant'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td style="text-align:left;">The Learning event met my expectation</td>
                        <td><input type="radio" name="" id="" <?php if ($info['expectations'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['expectations'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['expectations'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['expectations'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['expectations'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td style="text-align:left;">I will be able to apply the knowledge acquired</td>
                        <td><input type="radio" name="" id="" <?php if ($info['apply'] == 'Strongly Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['apply'] == 'Disagree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['apply'] == 'Indifferent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['apply'] == 'Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['apply'] == 'Strongly Agree') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr style="background-color: gray;">
                        <td></td>
                        <td></td>
                        <td>Excellent</td>
                        <td>Good</td>
                        <td>Average</td>
                        <td>Poor</td>
                        <td>Very Poor</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td style="text-align: left;">What is your overall evaluation of this Learning event?</td>
                        <td><input type="radio" name="" id="" <?php if ($info['evaluation'] == 'Excellent') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['evaluation'] == 'Good') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['evaluation'] == 'Average') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['evaluation'] == 'Poor') {
                                                                    echo 'checked';
                                                                } ?>></td>
                        <td><input type="radio" name="" id="" <?php if ($info['evaluation'] == 'Very Poor') {
                                                                    echo 'checked';
                                                                } ?>></td>
                    </tr>
                    <tr style="background-color: gray;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>A</td>
                        <td style="text-align: left;" colspan="6">What were your top two expectations for this course?</td>
                    </tr>
                    <tr>
                        <td>i</td>
                        <td style="text-align: left;" colspan="6"> <?= $info['topexpectation'] ?></td>

                    </tr>
                    <tr>
                        <td>ii</td>
                        <td style="text-align: left;" colspan="6"></td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td style="text-align: left;" colspan="6">What suggestions do you have to improve on this learning event? </td>
                    </tr>
                    <tr>
                        <td>i</td>
                        <td style="text-align: left;" colspan="6"><?= $info['user_improvement'] ?></td>

                    </tr>
                    <tr>
                        <td>ii</td>
                        <td style="text-align: left;" colspan="6"></td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td style="text-align: left;" colspan="6">What aspect of the learning event kindled your interest most? </td>
                    </tr>
                    <tr>
                        <td>i</td>
                        <td style="text-align: left;" colspan="6"><?= $info['user_event'] ?></td>

                    </tr>
                    <tr>
                        <td>ii</td>
                        <td style="text-align: left;" colspan="6"></td>
                    </tr>
                    <tr>

                        <td style="text-align: center;" colspan="7"><b>Thanks for participating</b> </td>
                    </tr>
                </tbody> -->
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