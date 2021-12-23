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
<?php session_start();
require('login.php');?>
<hr>
<br>
<h6>Edit Item</h6>
<br>

<?php

$item_id=$_GET['item_id'];
$search_result=search("select * from genomics_core.chemical where item_id='$item_id'");
$count_search_result=count($search_result);

if($count_search_result>0) {

    echo "<form action=\"chemical_edit_action.php\" method=\"get\">";

    echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
    echo "<tr align=\"center\" style=\"font-size:18px;line-height:50px;\">";
    echo "<td><b>Chemical Name</td>";
    echo "<td><b>Brand</td>";
    echo "<td><b>CAS number</td>";
    echo "<td><b>Owner</td>";
    echo "<td><b>Quantity</td>";
    echo "<td><b>Size</td>";
    echo "<td><b>Unit</td>";
    echo "<td><b>Storage Location</td>";
    echo "<td><b>Remark</td>";
    echo "</tr>";

    for ($i = 0; $i < $count_search_result; $i++) {

        echo "<tr align=\"center\">";

        echo "<td>";
        echo "<input type=\"hidden\" value=\"" . $search_result[$i]['item_id'] . "\" name=\"item_id\" id=\"item_id\">";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['chemical_name'] . "\" name=\"chemical_name\" id=\"chemical_name\" size=\"50\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['brand'] . "\" name=\"brand\" id=\"brand\" size=\"25\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['cas_number'] . "\" name=\"cas_number\" id=\"cas_number\" size=\"25\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['owner'] . "\" name=\"owner\" id=\"owner\" size=\"25\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['quantity'] . "\" name=\"quantity\" id=\"quantity\" size=\"15\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['size'] . "\" name=\"size\" id=\"size\" size=\"15\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['unit'] . "\" name=\"unit\" id=\"unit\" size=\"15\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['location'] . "\" name=\"location\" id=\"location\" size=\"35\">";
        echo "</td>";

        echo "<td>";
        echo "<input type=\"text\" value=\"" . $search_result[$i]['remark'] . "\" name=\"remark\" id=\"remark\" size=\"35\">";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
    echo "<br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href=\"chemical_edit_delete.php?database=chemical&id=" . $search_result[0]['item_id'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Delete " . $search_result[0]['chemical_name'] . "?');\" value=\"Delete \" /></a>";

    echo "</form>";

} else {
    echo "No chemical found in database, please contact tech support.";
}



?>



</body>
</html>
