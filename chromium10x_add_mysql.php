<html>
<head>
    <style>
        body {
            margin-left:20%;
            margin-right:20%;
        }
        table, th, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        ol{
            list-style:none;
        }
    </style>
</head>

<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>CHROMIUM 10X GENOMICS REQUEST</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");

            if(count($result_user)==0){
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }
            ?>
        </td>
    </tr>
</table>


<?php

$result_tmp=search("select max(seq_id) from genomics_core.Chromium_10x_Genomics");
if($result_tmp[0]['max(seq_id)']==""){
    $result_tmp[0]['max(seq_id)']=0;
}

$startdate = strtotime("today");
$rr="CHR";
$rtmp=str_pad(rand(1, 99), 2, "0", STR_PAD_LEFT);
$rr.=date("ymd", $startdate);
$rr.=$rtmp;

$count=$_GET['count'];
$diameter=$_GET['diameter'];
$remark=$_GET['remark'];

$user=$result_user[0]['user_name'];
$lab=$result_user[0]['lab'];
$email=$result_user[0]['email'];
$date=date('Y-m-d');



if ($count == "" || $count == 0){
    echo "<script>alert('Please input your sample number.');window.history.back()</script>";
    exit;
}

if ($count > 8){
    echo "<script>alert('Sample number cannot be greater than 8.');window.history.back()</script>";
    exit;
}

if ($diameter == "ss"){
    echo "<script>alert('Please select if your sample diameter under 30µm.');window.history.back()</script>";
    exit;
}



$value = "'" . ($result_tmp[0]['max(seq_id)'] + 1) . "','$rr','$count','$diameter','$remark','$user','$lab','$email','$date'";
$name = "seq_id,run,count,diameter,remark,user,lab,email,date";

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res = $conn->query("INSERT INTO genomics_core.Chromium_10x_Genomics ($name) VALUES (" . $value . ")");



if (!$res) {
    echo "<br><b><span style=\"font-family:sans-serif;font-size:20px;color:red\">Your request submission failed. Please contact Genomics Core support.</span></b>";
} else {
    echo "<br><b><span style=\"font-family:sans-serif;font-size:20px;color:red;\">Your Chromium 10x request submitted successfully.</span></b>";


    $result_lab=search("select * from lab where lab_name='$lab'");
    $tomail=$result_lab[0]['director_email'].",".$email;
    require('email_CC.php');
    $tomail_arr=explode(',',$tomail);
    $CC_arr=explode(',',$CC);

    $Subject="FYI: Chromium 10X Genomics Request of $user from $lab";

    if($tomail!=""){

        $main_mesg = "Dear Core User,<br><br>$user from $lab submitted samples for Chromium 10X (Run ID <a href=\"http://161.64.198.12/GBSCC/chromium10x_search_result.php?run=$rr\">$rr</a>). You can find sample information by clicking <a href=\"http://161.64.198.12/GBSCC/chromium10x_search_result.php?run=$rr\">Core Database</a>.<br><br>Please contact Tiffany (tiffanyiu@um.edu.mo) to schedule a time for your Chromium 10X Run.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

        $main_mesg.=$main_mesg_email;

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


        for($i=0;$i<count($tomail_arr);$i++){
            $mail->AddAddress($tomail_arr[$i]);
        }
        for($i=0;$i<count($CC_arr);$i++){
            $mail->AddCC($CC_arr[$i]);
        }

        if(!$mail->Send()) {
            echo "<br><br>Request email failed. Please contact Genomics Core support.<br><br>" . $mail->ErrorInfo;
        } else {
            echo "<p><br><br>Request email send to: $tomail<br><br>Request email CC: $CC<br><br></p>";
        }
    }
}



?>