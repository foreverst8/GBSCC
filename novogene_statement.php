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
<hr>
<br>
<h6>Novogene Service Statement</h6>


<?php

$result_statement=search("select * from novo_statement order by statement_id");
$asw = 0;
$asd = 0;
$as = 80000;


if ($result_statement != "") {

    echo "<p style=\"color:#002A60;font-size:12px\">*only confirmed requests shown in Novogene service statement.</p>";
    echo "<br><br><br>";
    echo "<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";

    echo "<tr align=\"center\">";
    echo "<td colspan=\"5\" align=\"left\" height=\"50px\"><b>&nbsp&nbspOpening Balance (USD)</b></td>";
    echo "<td colspan=\"1\" align=\"center\" height=\"50px\"><b>80000.00</b></td>";
    echo "</tr>";

    echo "<tr align=\"center\">";
    echo "<td align=\"center\" width=\"150px\" height=\"50px\"><b>Date</b></td>";
    echo "<td align=\"center\" width=\"400px\"><b>Person</b></td>";
    echo "<td align=\"center\" width=\"300px\"><b>Description</b></td>";
    echo "<td align=\"center\" width=\"150px\"><b>Withdrawal</b></td>";
    echo "<td align=\"center\" width=\"150px\"><b>Deposit</b></td>";
    echo "<td align=\"center\" width=\"150px\"><b>Balance</b></td>";
    echo "</tr>";

    foreach ($result_statement as $data) {

        if ($data['type'] == "withdrawal"):
            echo "<tr height=\"40px\" class=\"asw\">";
            echo "<td align=\"center\">";
            echo $data['date'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo $data['person'];
            echo "&nbsp&nbspfrom&nbsp&nbsp";
            echo $data['lab'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo $data['description'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo number_format($data['cost'], 2, ".", "");
            echo "</td>";
            echo "<td align=\"center\">";
            echo "&nbsp&nbsp";
            echo "</td>";
            $balance = $data['cost'];
        endif;

        if ($data['type'] == "deposit"):
            echo "<tr height=\"40px\" class=\"asd\">";
            echo "<td align=\"center\">";
            echo $data['date'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo $data['person'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo $data['description'];
            echo "</td>";
            echo "<td align=\"center\">";
            echo "&nbsp&nbsp";
            echo "</td>";
            echo "<td align=\"center\">";
            echo number_format($data['cost'], 2, ".", "");
            echo "</td>";
            $balance = $data['cost'];
        endif;

        $as = ($data['type'] == "withdrawal") ? $as - $balance : $as + $balance;

        echo "<td align=\"center\">";
        echo number_format($as, 2, ".", "");
        echo "</td>";
        echo "</tr>";

    }


    echo "</table><br><br>";

    echo "<td><a class=\"button\" href=\"novogene_statement_edit.php\">Add Deposit</a></td>";


}

?>
