<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:10%;
            margin-right:10%;
        }
        table, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        th {
            font-weight: bold;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>CONFIRM APPROVAL STATUS</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }

            $sample_count=0;
            if($_GET['sample_count']){
                $sample_count=$_GET['sample_count'];
            }
            ?>
        </td>
    </tr>
</table>

<?php

$run_confirm=$_SESSION["run"];
$search_result1=search("select * from genomics_core.cytof where run='$run_confirm'");

$Approval=$_GET['Approval'];
$remark_reject=$_GET['remark_reject'];
$date_run=$_GET['date_run'];
$new_date_run = date('Y-m-d', strtotime($date_run));
$time_run=$_GET['time_run'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$res = $conn->query("UPDATE genomics_core.cytof SET Approval = '$Approval' WHERE run='$run_confirm'");
$res = $conn->query("UPDATE genomics_core.cytof SET remark_reject = '$remark_reject' WHERE run='$run_confirm'");
$res = $conn->query("UPDATE genomics_core.cytof SET date_run = '$new_date_run' WHERE run='$run_confirm'");
$res = $conn->query("UPDATE genomics_core.cytof SET time_run = '$time_run' WHERE run='$run_confirm'");


if (!$res) {
    echo "<p>Request $run_confirm failed to updated. Please contact Genomics Core support.<br><br></p>" . mysql_error();
} else {

    echo "<p>Request $run_confirm has been updated ($Approval).<br><br></p>";



    if($Approval==Confirmed){

        echo "<p>Date & Time: $new_date_run, at $time_run<br><br></p>";

        $result_lab = search("select * from genomics_core.lab where lab_name='" . $search_result1[0]['Lab'] . "'");
        $tomail = $result_lab[0]['director_email'] . "," . $search_result1[0]['Email'];
        $tomail_arr = explode(',', $tomail);
        require('email_CC.php');
        $CC_arr = explode(',', $CC);

        $Subject = "Confirmation for CyTOF submission of " . $search_result1[0]['Submitter'] . " from " . $search_result1[0]['Lab'] . " ($run_confirm).";

        if ($tomail != "") {

            $main_mesg = "Dear Core User,<br><br>Your CyTOF request <a href=\"http://161.64.198.12/GBSCC/cytof_search_result.php?run=$run_confirm\">$run_confirm</a> has been confirmed.<br><br>Date & Time of your CyTOF run: $new_date_run, at $time_run.<br><br>Please go to Core website and fill cell concentration information of each sample before/on the date of CyTOF run via this link:<br>http://161.64.198.12/GBSCC/cytof_search_result.php?run=$run_confirm<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

            $main_mesg .= $main_mesg_email;

            require './PHPMailer-master/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->CharSet    ="UTF-8";
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->Username   = "fhs.genomics.core@gmail.com";
            $mail->Password   = "genomicscore";
            $mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');
            $mail->Subject    = $Subject;
            $mail->MsgHTML($main_mesg);

            for ($i = 0; $i < count($tomail_arr); $i++) {
                $mail->AddAddress($tomail_arr[$i]);
            }

            for ($i = 0; $i < count($CC_arr); $i++) {
                $mail->AddCC($CC_arr[$i]);
            }

            if (!$mail->Send()) {
                echo "<p>Confirmation email failed. Please contact Genomics Core support.<br></p>" . $mail->ErrorInfo;
            } else {
                echo "<p>Confirmation email sent to: $tomail<br><br>CC: $CC<br></p>";
            }
        }
    }


    if($Approval==Rejected){

        echo "<p>Rejected remarks: $remark_reject<br><br></p>";

        $result_lab = search("select * from genomics_core.lab where lab_name='" . $search_result1[0]['Lab'] . "'");
        $tomail = $result_lab[0]['director_email'] . "," . $search_result1[0]['Email'];
        $tomail_arr = explode(',', $tomail);
        require('email_CC.php');
        $CC_arr = explode(',', $CC);

        $Subject = "CyTOF request of " . $search_result1[0]['Submitter'] . " from " . $search_result1[0]['Lab'] . " ($run_confirm).";

        if ($tomail != "") {

            $main_mesg = "Dear Core User,<br><br>Your CyTOF request <a href=\"http://161.64.198.12/GBSCC/cytof_search_result.php?run=$run_confirm\">$run_confirm</a> has been rejected. Please check the remarks and resubmit when needed. You may check for your submission details at <a href=\"http://161.64.198.12/GBSCC/cytof_search_result.php?run=$run_confirm\">Core website</a>.<br><br>Remark: $remark_reject<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

            $main_mesg .= $main_mesg_email;

            require './PHPMailer-master/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->CharSet    ="UTF-8";
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->Username   = "fhs.genomics.core@gmail.com";
            $mail->Password   = "genomicscore";
            $mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');
            $mail->Subject    = $Subject;
            $mail->MsgHTML($main_mesg);

            for ($i = 0; $i < count($tomail_arr); $i++) {
                $mail->AddAddress($tomail_arr[$i]);
            }

            for ($i = 0; $i < count($CC_arr); $i++) {
                $mail->AddCC($CC_arr[$i]);
            }

            if (!$mail->Send()) {
                echo "<p>Email failed. Please contact Genomics Core support.<br></p>" . $mail->ErrorInfo;
            } else {
                echo "<p>Email sent to: $tomail<br><br>CC: $CC<br></p>";
            }
        }
    }



}

?>
</body>
</html>
