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
<h6>Edit Equipment</h6>
<br>

<?php

$equipment_id=$_GET['equipment_id'];
$search_result=search("select * from genomics_core.equipment where equipment_id='$equipment_id'");
$count_search_result=count($search_result);

if($count_search_result>0) {

    echo "<form action=\"equipment_edit_action.php\" method=\"get\">";

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

    for ($i = 0; $i < $count_search_result; $i++) {

        echo "<tr align=\"center\">";
        echo "<td>";
        echo "<input type=\"hidden\" value=\"" . $search_result[$i]['equipment_id'] . "\" name=\"equipment_id\" id=\"equipment_id\">";
        echo "<input type=\"text\" style=\"height:70px;width:100px;\" value=\"" . $search_result[$i]['application'] . "\" name=\"application\" id=\"application\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" style=\"height:70px;width:100px;\" value=\"" . $search_result[$i]['brand'] . "\" name=\"brand\" id=\"brand\">";
        echo "</td>";

        echo "<td>";
        echo "<textarea style=\"height:70px;width:300px\" name=\"model\" id=\"model\">". $search_result[$i]['model'] ."</textarea>";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" style=\"height:70px;width:100px;\" value=\"" . $search_result[$i]['location'] . "\" name=\"location\" id=\"location\">";
        echo "</td>";

        echo "<td>";
        echo "<textarea style=\"height:70px;width:200px;\" name=\"serial_number\" id=\"serial_number\">". $search_result[$i]['serial_number'] ."</textarea>";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" style=\"height:70px;width:80px;\" value=\"" . $search_result[$i]['qty'] . "\" name=\"qty\" id=\"qty\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" style=\"height:70px;width:100px;\" value=\"" . $search_result[$i]['current_warranty'] . "\" name=\"current_warranty\" id=\"current_warranty\">";
        echo "</td>";

        echo "<td>";
        echo "<textarea style=\"height:70px;width:200px;\" name=\"UM_asset\" id=\"UM_asset\">". $search_result[$i]['UM_asset'] ."</textarea>";
        echo "</td>";

        echo "<td>";
        echo "<textarea style=\"height:70px;width:300px;\" name=\"remark\" id=\"remark\">". $search_result[$i]['remark'] ."</textarea>";
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
        echo "<input type=\"text\" style=\"height:60px;width:200px;\" value=\"" . $search_result[$i]['item_no'] . "\" name=\"item_no\" id=\"item_no\">";
        echo "</td>";

        echo "<td colspan=\"2\">";
        echo "<textarea style=\"height:60px;width:400px;\" name=\"pr_no\" id=\"pr_no\">". $search_result[$i]['pr_no'] ."</textarea>";
        echo "</td>";

        echo "<td colspan=\"2\">";
        echo "<input type=\"text\" style=\"height:60px;width:280px;\" value=\"" . $search_result[$i]['extended_warranty'] . "\" name=\"extended_warranty\" id=\"extended_warranty\">";
        echo "</td>";

        echo "<td colspan=\"2\">";
        echo "<input type=\"text\" style=\"height:60px;width:300px;\" value=\"" . $search_result[$i]['pm_service'] . "\" name=\"pm_service\" id=\"pm_service\">";
        echo "</td>";

        echo "<td>";
        echo "<textarea style=\"height:60px;width:300px;\" name=\"blue_sticker\" id=\"blue_sticker\">". $search_result[$i]['blue_sticker'] ."</textarea>";
        echo "</td>";
        echo "</tr>";

    }

    echo "</table>";
    echo "<br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href=\"del_info_mysql.php?database=equipment&id=" . $search_result[0]['equipment_id'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Delete this equipment " . $search_result[0]['application'] . $search_result[0]['brand'] . "?');\" value=\"Delete\" /></a>";
    echo "</form>";

} else {
    echo "No equipment found in database, please contact tech support.";
}



?>



</body>
</html>

