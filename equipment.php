<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
    <style>
        body {
            margin-left:5%;
            margin-right:5%;
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
        .expand:after {
            content: " +";
        }
    </style>
</head>

<body>
<br>
<?php session_start();
require('login.php');?>
<hr>
<br>
<h6>Core Facility Equipment List</h6>
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

<script type="text/javascript">

    function myFunction() {
        const filter = document.querySelector('#myInput').value.toUpperCase();
        const trs = document.querySelectorAll('#myTable tr:not(.header)');
        trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.innerHTML.toUpperCase().includes(filter)) ? '' : 'none');
    }

</script>

<script type="text/javascript">

    function openAll() {
        var x = document.getElementsByTagName("details");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].setAttribute("open", "true");
        }
        document.getElementById("expand").setAttribute( "onClick", "javascript: closeAll();" );
        document.getElementById("expand").innerHTML = "Collapse All";
    }

    function closeAll() {
        var x = document.getElementsByTagName("details");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].removeAttribute("open");
        }
        document.getElementById("expand").setAttribute( "onClick", "javascript: openAll();" );
        document.getElementById("expand").innerHTML = "Expand All";
    }

</script>

<p><b>Search:&nbsp;&nbsp;</b></p>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="search for equipment.." title="Type in a name">
<br><br><br>


<?php

$result=search("select * from genomics_core.equipment");

if ($result != "") {


    echo "<table align=\"center\" id=\"myTable\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
    echo "<tr align=\"center\" style=\"font-size:13px;\">";
    echo "<td width=\"30px\"></td>";
    echo "<td><b>Photo</td>";
    echo "<td><b>Name</td>";
    echo "<td><b>Brand</td>";
    echo "<td><b><br>Model no. + part / cat. numbers<br>or<br>Detail Specification Requirement<br><br></td>";
    echo "<td><b>Current<br>Location</td>";
    echo "<td><b>Serial<br>Number</td>";
    echo "<td><b>Qty.</td>";
    echo "<td><b>Current<br>Warranty<br>Period</td>";
    echo "<td><b>UM Asset<br>Number</td>";
    echo "<td><b>Remark</td>";
    echo "<td><b>More Info<br><br><button type=\"button\" id=\"expand\" onclick=\"openAll()\">Expand All</button></td>";
    echo "</tr>";


    for ($i = 0; $i < count($result); $i++) {

        echo "<tr style=\"font-size:9px;border-bottom:#999999;\">";
        echo "<td align=\"center\" style=\"font-size:13px;padding-top:20px;padding-bottom:20px;\">";
        echo "<b>";
        echo $i + 1;
        echo "</b>";
        echo "<br><br>";
        echo "<a class=\"button\" href=\"equipment_edit.php?equipment_id=" . $result[$i]['equipment_id'] . "#top\">>></a>";
        echo "</td>";

        $a = "files/equipment/";
        $b = $result[$i]['equipment_id'];
        $c = ".png";
        $d = $a.$b.$c;
        echo "<td align=\"center\" width=\"300px\">";
        if($result[$i]['photo']==""){
                        echo "<br><br>";
        } else {
        	echo "<br><img src=$d width='80%'><br><br>";
        }
        echo "</td>";

        echo "<td style=\"font-size:14px;\" align=\"center\" width=\"100px\">";
        echo "<input type=\"hidden\" value=\"" . $result[$i]['item_id'] . "\" name=\"item_id\" id=\"item_id\">";
        echo "<b>";
        echo $result[$i]['application'];
        echo "</b>";
        echo "</td>";

        echo "<td align=\"center\" width=\"80px\">";
        echo $result[$i]['brand'];
        echo "</td>";

        echo "<td align=\"center\" style=\"padding-top:20px;padding-bottom:20px;padding-left:5px;padding-right:5px;\" width=\"300px\">";
        $y1=$result[$i]['model'];
        $y2=explode("\n",$y1);
        for($t=0;$t<count($y2);$t++){
            echo $y2[$t];
            echo "<br>";
        }
        echo "</td>";

        echo "<td align=\"center\" width=\"80px\">";
        echo $result[$i]['location'];
        echo "</td>";

        echo "<td style=\"padding-left:5px\" width=\"150px\">";
        $test1=$result[$i]['serial_number'];
        $test2=explode("\n",$test1);
        for($t=0;$t<count($test2);$t++){
            echo $test2[$t];
            echo "<br>";
        }
        echo "</td>";

        echo "<td align=\"center\" width=\"50px\">";
        echo $result[$i]['qty'];
        echo "</td>";

        echo "<td align=\"center\" width=\"100px\">";
        echo $result[$i]['current_warranty'];
        echo "</td>";

        echo "<td style=\"padding-left:5px\" width=\"130px\">";
        $t1=$result[$i]['UM_asset'];
        $t2=explode("\n",$t1);
        for($t=0;$t<count($t2);$t++){
            echo $t2[$t];
            echo "<br>";
        }
        echo "</td>";

        echo "<td style=\"padding-top:20px;padding-bottom:20px;padding-left:10px;padding-right:5px;\" width=\"300px\">";
        $x1=$result[$i]['remark'];
        $x2=explode("\n",$x1);
        for($t=0;$t<count($x2);$t++){
            echo $x2[$t];
            echo "<br>";
        }
        echo "</td>";

        echo "<td style=\"padding-top:20px;padding-bottom:20px;padding-left:5px;\" width=\"200px\">";
        echo "<details>";
        echo "<summary>Click</summary><br>";
        echo "<b>> Item no.</b><br>";
        echo $result[$i]['item_no'];
        echo "<br>";
        echo "<br>";
        echo "<b>> PR no. / PIDDA</b><br>";
        $e1=$result[$i]['pr_no'];
        $e2=explode("\n",$e1);
        for($t=0;$t<count($e2);$t++){
            echo $e2[$t];
            echo "<br>";
        }
        echo "<br>";
        echo "<b>> Extended Warranty Period</b><br>";
        echo $result[$i]['extended_warranty'];
        echo "<br>";
        echo "<br>";
        echo "<b>> PM Service checking date</b><br>";
        echo $result[$i]['pm_service'];
        echo "<br>";
        echo "<br>";
        echo "<b>> Blue Stickers (2016-2017)</b><br>";
        $s1=$result[$i]['blue_sticker'];
        $s2=explode("\n",$s1);
        for($t=0;$t<count($s2);$t++){
            echo $s2[$t];
            echo "<br>";
        }
        echo "<br>";
        echo "</details>";
        echo "</td>";
        echo "</tr>";


        
    }

    echo "</table><br><br>";

    echo "<td><a style=\"color:#002A60\" class=\"button\" href=\"equipment_add.php#top\">Add Equipment</a></td>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<td><a style=\"color:#002A60\" class=\"button\" href=\"equipment_export.php\">Export</a></td>";

} else {
    echo "No equipment found in database, please contact tech support.";
}



?>




</body>
</html>