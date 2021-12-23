<html>
<head>
    <style>
        a, a:visited {
            color:#002A60; text-decoration:none;
        }
        body {
            margin-left:20%;
            margin-right:20%;
        }
        table {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
            border-collapse:collapse;
        }
        th {
            font-weight: bold;
        }
        td {
            border-width:3px;
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
<h6>Novogene Service Edit Record</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top" >
            <?PHP
            $result_user=search("select * from user where user_name='".$_SESSION['username']."'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            if(!($result_user[0]["lab"]=="General Office" or $result_user[0]["main"]=="y")){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            ?>
        </td>
    </tr>
</table>



<?php

$run = $_POST['run'];
$RNA_extraction = $_POST['RNA_extraction'];
$library_QC = $_POST['library_QC'];
$sequencing = $_POST['sequencing'];
$RNA6G=$_POST['RNA6G'];
$RNA12G=$_POST['RNA12G'];
$ChIP6G=$_POST['ChIP6G'];
$ChIP12G=$_POST['ChIP12G'];

$othername=$_POST['othername'];
$otherusd=$_POST['otherusd'];

$total_cost_usd = $_POST['total_cost_usd'];
$total_cost = $_POST['total_cost'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$result = $conn->query("UPDATE genomics_core.novo_hiseq SET RNA_extraction = '$RNA_extraction' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET library_QC = '$library_QC' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET sequencing = '$sequencing' WHERE run='$run'");

$result = $conn->query("UPDATE genomics_core.novo_hiseq SET RNA6G = '$RNA6G' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET RNA12G = '$RNA12G' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET ChIP6G = '$ChIP6G' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET ChIP12G = '$ChIP12G' WHERE run='$run'");

$result = $conn->query("UPDATE genomics_core.novo_hiseq SET othername = '$othername' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET otherusd = '$otherusd' WHERE run='$run'");

$result = $conn->query("UPDATE genomics_core.novo_hiseq SET total_cost_usd = '$total_cost_usd' WHERE run='$run'");
$result = $conn->query("UPDATE genomics_core.novo_hiseq SET total_cost = '$total_cost' WHERE run='$run'");

if (!$result) {
    echo "<p style=\"color:red;font-size:20px\">Request $run failed to update. Please contact Genomics Core support.</p>";
} else {
    echo "<p style=\"color:red;font-size:20px\">Request $run has been updated.<br><br></p>";
}



?>