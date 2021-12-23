<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
    <style>
        body {
            margin-left:10%;
            margin-right:10%;
        }
        table, th, td {
            color: #002A60;
            font-family: sans-serif;
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
<?php session_start();
require('login.php');?>
<hr>
<br>
<h6>Add Equipment</h6>
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

echo "<form action=\"equipment_add_action.php\" method=\"post\" enctype=\"multipart/form-data\">";

echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr align=\"center\" style=\"font-size:13px;\">";
echo "<td><b>Name</td>";
echo "<td><b>Brand</td>";
echo "<td><b><br>Model no. + part / cat. numbers<br>or<br>Detail Specification Requirement<br><br></td>";
echo "<td><b>Current<br>Location</td>";
echo "<td><b>Serial<br>Number</td>";
echo "<td><b>Qty.</td>";
echo "<td><b>Current<br>Warranty<br>Period</td>";
echo "<td><b>UM Asset<br>Number</td>";
echo "<td><b>Remark</td>";
echo "</tr>";


echo "<tr align=\"center\">";
echo "<td>";
echo "<input type=\"text\" style=\"height:70px;width:100px;\" name=\"application\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:70px;width:100px;\" name=\"brand\"/>";
echo "</td>";

echo "<td>";
echo "<textarea style=\"height:70px;width:300px\" name=\"model\"></textarea>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:70px;width:100px;\" name=\"location\"/>";
echo "</td>";

echo "<td>";
echo "<textarea style=\"height:70px;width:200px\" name=\"serial_number\"></textarea>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:70px;width:80px;\" name=\"qty\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:70px;width:100px;\" name=\"current_warranty\"/>";
echo "</td>";

echo "<td>";
echo "<textarea style=\"height:70px;width:200px\" name=\"UM_asset\"></textarea>";
echo "</td>";

echo "<td>";
echo "<textarea style=\"height:70px;width:300px\" name=\"remark\"></textarea>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan=\"9\" style=\"font-size:13px;padding-left:5px;border-bottom:#999999;\">";
echo "<b>>> more info</b>";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" style=\"font-size:13px;line-height:40px;\">";
echo "<td colspan=\"2\"><b>Item no.</td>";
echo "<td colspan=\"2\"><b>PR no. / PIDDA</td>";
echo "<td colspan=\"2\"><b>Extended Warranty Period</td>";
echo "<td colspan=\"2\"><b>PM Service checking date</td>";
echo "<td><b>Blue Stickers 2016-2017</td>";
echo "</tr>";

echo "<tr align=\"center\">";
echo "<td colspan=\"2\">";
echo "<input type=\"text\" style=\"height:60px;width:200px;\" name=\"item_no\"/>";
echo "</td>";

echo "<td colspan=\"2\">";
echo "<textarea style=\"height:60px;width:400px\" name=\"pr_no\"></textarea>";
echo "</td>";

echo "<td colspan=\"2\">";
echo "<input type=\"text\" style=\"height:60px;width:280px;\" name=\"extended_warranty\"/>";
echo "</td>";

echo "<td colspan=\"2\">";
echo "<input type=\"text\" style=\"height:60px;width:300px;\" name=\"pm_service\"/>";
echo "</td>";

echo "<td>";
echo "<textarea style=\"height:60px;width:300px\" name=\"blue_sticker\"></textarea>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br><br><b><span style=\"color:#002A60;font-family:sans-serif;\">Upload equipment image:</span></b><br><br>";
echo "<input name=\"photo\" id=\"photo\" type=\"file\" />";

echo "<br><br><br><input class=\"button\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
echo "</form>";

?>

</body>
</html>