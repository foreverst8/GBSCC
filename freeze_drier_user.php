<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:18%;
            margin-right:18%;
        }
        table, td {
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
<h6>Freeze-drier Booking History</h6><br>
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
$history=search("select * from genomics_core.freezedrier where user='".$_SESSION['username']."' order by id DESC");
echo "<p style=\"color:#002A60\">The table below shows booking history of user:&nbsp&nbsp</p>";
echo $_SESSION['username'];
echo "<br><br>";
echo "<p style=\"color:#002A60\">Your booking history listed from most recent to oldest</p><br><br><br>";

if(count($history)>0){

    echo "<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
    echo "<tr align=\"center\" style=\"font-size:18px;line-height:50px;\">";
    echo "<td width=\"100px\"></td>";
    echo "<td width=\"300px\"><b>Start</b></td>";
    echo "<td width=\"300px\"><b>End</b></td>";
    echo "<td width=\"300px\"></td>";
    echo "</tr>";

    for ($i = 0; $i < count($history); $i++) {

        echo "<tr align=\"center\" style=\"font-size:18px;line-height:50px;\">";
        echo "<td>";
        echo $i + 1;
        echo "</td>";

        echo "<td>";
        echo $history[$i]['startdate'];
        echo "&nbsp&nbsp";
        echo $history[$i]['starttime'];
        echo "</td>";

        echo "<td>";
        echo $history[$i]['enddate'];
        echo "&nbsp&nbsp";
        echo $history[$i]['endtime'];
        echo "</td>";

        echo "<td>";
        echo "<a href=\"freeze_drier_edit.php?&id=".$history[$i]['id']."\"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" value=\"Edit\" /></a>";
        echo "&nbsp&nbsp";
        echo "<a href=\"freeze_drier_delete.php?database1=freezedrier&database2=freezedrier_booking&id=" . $history[$i]['id'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" value=\"Cancel\" /></a>";
        echo "</td>";

    }

    echo "</table>";

} else {
    echo "No booking history.";
}


?>
<br>
<br>
