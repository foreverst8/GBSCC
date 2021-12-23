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
        div{
            text-align: center;
        }
    </style>
</head>


<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Edit Opening Balance</h6>
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
$balance_2019=$_POST['balance_2019'];
$balance_2020=$_POST['balance_2020'];
$balance_2021=$_POST['balance_2021'];
$balance_2022=$_POST['balance_2022'];
$balance_2023=$_POST['balance_2023'];
$balance_2024=$_POST['balance_2024'];
$balance_2025=$_POST['balance_2025'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2019' WHERE year='2019'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2020' WHERE year='2020'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2021' WHERE year='2021'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2022' WHERE year='2022'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2023' WHERE year='2023'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2024' WHERE year='2024'");
$result = $conn->query("UPDATE genomics_core.novo_balance SET balance = '$balance_2025' WHERE year='2025'");


if (!$result) {
    echo "<p>The opening balance failed to update. Please contact Genomics Core support.</p>";
} else {
    echo "<p>The opening balance has been updated.<br><br></p>";
}

?>