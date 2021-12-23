<html>
<head>
    <style>
        body {
            margin-left:15%;
            margin-right:15%;
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
<h6>CHROMIUM 10X GENOMICS - EDIT</h6>

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

$run = $_GET['run'];
$count=$_GET['count'];
$diameter=$_GET['diameter'];
$remark=$_GET['remark'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$result = $conn->query("UPDATE genomics_core.Chromium_10x_Genomics SET count = '$count' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.Chromium_10x_Genomics SET diameter = '$diameter' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.Chromium_10x_Genomics SET remark = '$remark' WHERE run='$run'");

if (!$result) {
    echo "<p style=\"color:red;font-size:20px\">Request $run failed to update. Please contact Genomics Core support.</p>";
} else {
    echo "<p style=\"color:red;font-size:20px\">Request $run has been updated.<br><br></p>";
}

?>