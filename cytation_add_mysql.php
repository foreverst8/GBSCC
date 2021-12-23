<html>
<head>
    <style>
        body {
            margin-left:18%;
            margin-right:18%;
        }
    </style>
</head>

<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Cytation Imaging Reader Reservation</h6>
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
<br><br>

<?php

$startdate=$_GET['startdate'];
$starttime=$_GET['starttime'];
$enddate=$_GET['enddate'];
$endtime=$_GET['endtime'];

$first=strtotime($startdate.$starttime);
$last=strtotime($enddate.$endtime);
$diff=$last - $first;
$days=$diff/86400;

if ($startdate == "" || $starttime == "" || $enddate == "" || $endtime == ""){
    echo "<script>alert('Please select your start and/or end time.');window.history.back()</script>";
    exit;
}
if ($first >= $last){
    echo "<script>alert('Reminder: end time should be later than start time.');window.history.back()</script>";
    exit;
}
if ($days > 7){
    echo "<script>alert('Please do not book this equipment more than 7 days.');window.history.back()</script>";
    exit;
}

$overlap=search("select * from genomics_core.cytation");
$aaa = array_column($overlap, 'first');
$bbb = array_column($overlap, 'last');

foreach ($aaa as $a) {
    if ($a > $first && $a < $last){
        echo "<script>alert('Your select time slot has been booked, please check the availability calendar.');window.history.back()</script>";
        exit;
    }
}
foreach ($bbb as $b) {
    if ($b > $first && $b < $last){
        echo "<script>alert('Your select time slot has been booked, please check the availability calendar.');window.history.back()</script>";
        exit;
    }
}
foreach ($aaa as $k=> $va) {
    if ($va <= $first && $bbb[$k] >= $last){
        echo "<script>alert('Your select time slot has been booked, please check the availability calendar.');window.history.back()</script>";
        exit;
    }
    if ($va >= $first && $bbb[$k] <= $last){
        echo "<script>alert('Your select time slot has been booked, please check the availability calendar.');window.history.back()</script>";
        exit;
    }
}


$result_tmp=search("select max(id) from genomics_core.cytation");
if($result_tmp[0]['max(id)']==""){
    $result_tmp[0]['max(id)']=0;
}
$id=$result_tmp[0]['max(id)'] + 1;

$start=$startdate."T".$starttime;
$end=$enddate."T".$endtime;

$user=$result_user[0]['user_name'];
$lab=$result_user[0]['lab'];
$email=$result_user[0]['email'];
$date=date('Y-m-d');

$start1=date("m/d",strtotime($startdate));
$start2 = date('G:i',strtotime($starttime));
$start3=$start1." ".$start2;
$end1=date("m/d",strtotime($enddate));
$end2 = date('G:i',strtotime($endtime));
$end3=$end1." ".$end2;
$full=$start3." - ".$end3;
$title=$full." ".$user." (".$lab.")";


$value1 = "'" . ($result_tmp[0]['max(id)'] + 1) . "','$user','$lab','$email','$date','$startdate','$starttime','$enddate','$endtime','$first','$last'";
$name1 = "id,user,lab,email,date,startdate,starttime,enddate,endtime,first,last";

$value2 = "'" . ($result_tmp[0]['max(id)'] + 1) . "','$title','$start','$end'";
$name2 = "id,title,start,end";

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res1 = $conn->query("INSERT INTO genomics_core.cytation ($name1) VALUES (" . $value1 . ")");
$res2 = $conn->query("INSERT INTO genomics_core.cytation_booking ($name2) VALUES (" . $value2 . ")");



if (!$res1 && !$res2) {
    echo "<b><span style=\"font-family:sans-serif;font-size:17px;color:red\">Your booking submission failed. Please contact Genomics Core support.</span></b>";
} else {
    echo "<b><span style=\"font-family:sans-serif;font-size:17px;color:red;\">Your booking submitted successfully: </span></b>";
    echo "&nbsp&nbspfrom&nbsp&nbsp";
    echo $startdate;
    echo "&nbsp&nbsp";
    echo $starttime;
    echo "&nbsp&nbspto&nbsp&nbsp";
    echo $enddate;
    echo "&nbsp&nbsp";
    echo $endtime;

	
    require('email_CC.php');
    $CC_arr=explode(',',$CC);

    $Subject="Cytation Imaging Reader reservation: $user from $lab";

    if($email != ""){

        $main_mesg = "Dear Core User,<br><br>Your booking for Cytation Imaging Reader is confirmed. Time slot: $startdate $starttime to $enddate $endtime.<br><br>You can edit your booking by clicking <a href=\"http://161.64.198.12/GBSCC/cytation_edit.php?id=$id\">this link</a>. If you would like to cancel this booking, please click <a href=\"http://161.64.198.12/GBSCC/cytation_user.php\">this link</a>.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

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
        $mail->AddAddress($email);

        for($i=0;$i<count($CC_arr);$i++){
            $mail->AddCC($CC_arr[$i]);
        }

        if(!$mail->Send()) {
            echo "<br><br>Booking email failed. Please contact Genomics Core support.<br><br>" . $mail->ErrorInfo;
        } else {
            echo "<p><br><br>Booking email send to: $email<br><br>Booking email CC: $CC<br><br></p>";
        }
    }
	


}

?>