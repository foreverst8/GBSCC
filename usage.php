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
<h6>Equipment Usage</h6>
<br>


<form method="get" action="usage.php">
    <table>
        <b>Select Equipment&nbsp;&nbsp;&nbsp;&nbsp;</b>
        <select name = "list" style="width:300px">
            <option selected="selected">-</option>
            <option value = "Freeze Drier">Freeze Drier</option>
            <option value = "Viia7 Real time PCR">Viia7 Real time PCR</option>
            <option value = "Bioanalyzer">Bioanalyzer</option>
        </select>
        &nbsp;&nbsp;
        <tr><colspan = "2">
            <input type="submit" value="Submit">
            </td>
        </tr>
    </table>
</form>
<br><br>



<?php

$spreadsheet_url='https://docs.google.com/spreadsheets/d/e/2PACX-1vQ2fBT1vYI8HxVVrlYelhfyTbM4uTnDkzDx8wPgj4jgeHILJiqDyERcx5P3mRP7zQd2pbES7wVMN0YK/pub?gid=1767519552&single=true&output=csv';

$file = fopen($spreadsheet_url,"r");
while($data = fgetcsv($file)){
    $spreadsheet_data[] = $data;
}
fclose($file);

array_shift($spreadsheet_data);


$keys = array('timestamp','name','lab','equipment','solvent','remark','water','glassware','date','time');

foreach($spreadsheet_data as $key=>$val)
{
    foreach($val as $k=>$v)
    {
        $spreadsheet_data[$key][$keys[$k]] = $v;
        unset($spreadsheet_data[$key][$k]);
    }
}



if ($_GET['list'] != "") {


    if ($_GET['list'] == "-") {

        echo "Please select equipment.<br><br>";

    } elseif ($_GET['list'] == "Freeze Drier") {

        $new = array_filter($spreadsheet_data, function ($var) {
            return ($var['equipment'] == $_GET['list']);
        });

        sort($new);
        
        $_SESSION["equipment_export"] = $_GET['list'];
        $_SESSION["table_export"] = $new;

        if (count($new) != 0) {

            echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
            echo "<tr align=\"center\" style=\"font-size:17px;line-height:50px;\">";
            echo "<td width=\"250px\"><b>Name</td>";
            echo "<td width=\"250px\"><b>Lab</td>";
            echo "<td width=\"300px\"><b>Equipment</td>";
            echo "<td width=\"200px\"><b>Date</td>";
            echo "<td width=\"200px\"><b>Time</td>";
            echo "<td width=\"300px\"><b>Types of solvent</td>";
            echo "<td width=\"300px\"><b>Remark (instrument status)</td>";
            echo "<td width=\"250px\"><b>Water drained?</td>";
            echo "<td width=\"250px\"><b>Glassware cleaned?</td>";
            echo "</tr>";

            for ($i = 0; $i < count($new); $i++) {
                echo "<tr align=\"center\" style=\"font-size:15px;line-height:30px;\">";
                echo "<td>";
                echo $new[$i]['name'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['lab'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['equipment'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['date'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['time'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['solvent'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['remark'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['water'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['glassware'];
                echo "</td>";
                echo "</tr>";
            }

            echo "</table><br><br>";
            
            echo "<td><a class=\"button\" href=\"usage_export.php\">Export</a></td>";
            
        } else {
            echo "No record of " . $_GET['list'];
            echo "<br><br>";
        }

    } else {

        $new = array_filter($spreadsheet_data, function ($var) {
            return ($var['equipment'] == $_GET['list']);
        });

        sort($new);
        $_SESSION["equipment_export"] = $_GET['list'];
        $_SESSION["table_export"] = $new;

        if (count($new) != 0) {

            echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
            echo "<tr align=\"center\" style=\"font-size:17px;line-height:50px;\">";
            echo "<td width=\"300px\"><b>Name</td>";
            echo "<td width=\"300px\"><b>Lab</td>";
            echo "<td width=\"300px\"><b>Equipment</td>";
            echo "<td width=\"300px\"><b>Date</td>";
            echo "<td width=\"300px\"><b>Time</td>";
            echo "</tr>";

            for ($i = 0; $i < count($new); $i++) {
                echo "<tr align=\"center\" style=\"font-size:15px;line-height:30px;\">";
                echo "<td>";
                echo $new[$i]['name'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['lab'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['equipment'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['date'];
                echo "</td>";

                echo "<td>";
                echo $new[$i]['time'];
                echo "</td>";
                echo "</tr>";
            }

            echo "</table><br><br>";
            
            echo "<td><a class=\"button\" href=\"usage_export.php\">Export</a></td>";
            
        } else {
            echo "No record of " . $_GET['list'];
            echo "<br><br>";
        }
    }


}



?>

</body>
</html>
