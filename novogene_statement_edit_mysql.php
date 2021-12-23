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
<h6>Novogene Service Add Deposit</h6>
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

$date=$_POST['date'];
$person=$_POST['person'];
$description=$_POST['description'];
$cost=$_POST['cost'];
$id_tmp=search("select max(statement_id) from genomics_core.novo_statement");

$value = "'" . ($id_tmp[0]['max(statement_id)'] + 1) . "','$date','$description','deposit','$cost','$person'";
$name = "statement_id,date,description,type,cost,person";

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res = $conn->query("INSERT INTO genomics_core.novo_statement ($name) VALUES (" . $value . ")");


if (!$res) {
    echo "<br><br><b><span style=\"font-family:sans-serif;font-size:20px;color:red\">Deposit failed to added. Please contact Genomics Core support.</span></b>";
} else {
    echo "<br><br><b><span style=\"font-family:sans-serif;font-size:20px;color:red\">Deposit has been added.</span></b>";
}


?>