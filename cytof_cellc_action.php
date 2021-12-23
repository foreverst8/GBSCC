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
<h6>EDIT RECORDS</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");

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

$run_cc=$_SESSION["run_cc"];
$tmpid_cc=$_SESSION["tmpid_cc"];

$count=0;
$added_count = 0;
$err_count=0;

$count = 0;

while ($count < $tmpid_cc) {

    $cell_concentration = $_GET["cell_concentration-$count"];
    $tid = $count + 1;

    $conn = db_connect();
    mysqli_query($conn, "SET NAMES GB2312");
    $res = $conn->query("UPDATE genomics_core.cytof SET cell_concentration = '$cell_concentration' WHERE run='$run_cc' and tmp_id='$tid'");

    if (!$res) {
        $err_count++;
        echo "<p>Request $run_cc failed to updated.<br><br></p>" . mysql_error();
    } else {
        $added_count++;
    }
    
    $count++;
}

if ($err_count > 0) {
    echo "<p>$err_count records failed. Please contact Genomics Core support.<br></p>";
}

if ($added_count > 0) {
    echo "<p>Request $run_cc has been updated.<br><br></p>";
}


?>