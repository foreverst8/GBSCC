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
<br>

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

$id=$_GET['id'];
$overlap=search("select * from genomics_core.cytation where not id='$id'");
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

$start=$startdate."T".$starttime;
$end=$enddate."T".$endtime;

$user=$_GET['user'];
$lab=$_GET['lab'];

$start1=date("m/d",strtotime($startdate));
$start2 = date('G:i',strtotime($starttime));
$start3=$start1." ".$start2;
$end1=date("m/d",strtotime($enddate));
$end2 = date('G:i',strtotime($endtime));
$end3=$end1." ".$end2;
$full=$start3." - ".$end3;
$title=$full." ".$user." (".$lab.")";



$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res = $conn->query("UPDATE genomics_core.cytation SET startdate = '$startdate' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation SET starttime = '$starttime' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation SET enddate = '$enddate' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation SET endtime = '$endtime' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation SET first = '$first' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation SET last = '$last' WHERE id='$id'");

$res = $conn->query("UPDATE genomics_core.cytation_booking SET title = '$title' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation_booking SET start = '$start' WHERE id='$id'");
$res = $conn->query("UPDATE genomics_core.cytation_booking SET end = '$end' WHERE id='$id'");


if (!$res) {
    echo "<p>Your booking failed to update, please contact tech support.</p>";
} else {
    echo "<p><span style=\"font-size:18px;color:red\">Your booking has been updated to: </p>";
    echo "&nbsp&nbsp";
    echo $startdate;
    echo "&nbsp&nbsp";
    echo $starttime;
    echo "&nbsp&nbsp-&nbsp&nbsp";
    echo $enddate;
    echo "&nbsp&nbsp";
    echo $endtime;
    echo "<br><br>";
    echo "<p><span style=\"font-size:18px;color:red\">Please open a new window in browser if you would like to make a new reservation.</p>";
}


?>