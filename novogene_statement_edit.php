<html>
<head>
    <style>
        a, a:visited {
            color:#002A60; text-decoration:none;
            font-size: 5px;
        }
        body {
            margin-left:20%;
            margin-right:20%;
        }
        table, th, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 15px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        div{
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>


<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<?php
$result_user=search("select * from user where user_name='".$_SESSION['username']."'");

if(count($result_user)==0){
    echo 'You do not have permission to access this page.<br />';
    exit;
}
if(!($result_user[0]["lab"]=="General Office" or $result_user[0]["main"]=="y")){
    echo 'You do not have permission to access this page.<br />';
    exit;
}
?>

<hr>
<br>
<h6>Novogene Service Add Deposit</h6>
<br>


<?php

echo "<form action=\"novogene_statement_edit_mysql.php\" method=\"post\">";
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";

echo "<tr align=\"center\" height=\"50px\">";
echo "<td width=\"150px\"><b>Date</b></td>";
echo "<td width=\"150px\"><b>Person</b></td>";
echo "<td width=\"300px\"><b>Description</b></td>";
echo "<td width=\"150px\"><b>Type</b></td>";
echo "<td width=\"150px\"><b>Amount</b></td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo date('Y-m-d');
echo "<input type=\"hidden\" name=\"date\" value=\"".date('Y-m-d')."\"/>";
echo "</td>";
echo "<td>";
echo $result_user[0]['user_name'];
echo "<input type=\"hidden\" name=\"person\" value=\"".$result_user[0]['user_name']."\"/>";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" name=\"description\" size=\"50\"/>";
echo "</td>";
echo "<td>";
echo "Deposit";
echo "</td>";
echo "<td>";
echo "<input type=\"number\" min=\"0\" style=\"width: 80px;\" name=\"cost\" value=\"0\">";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br><input class=\"button\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
echo "</form>";

?>
