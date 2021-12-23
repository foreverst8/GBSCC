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
<h6>Edit Chemical List</h6>
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

<p><b>Search:&nbsp;&nbsp;</b></p>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="search for chemical.." title="Type in a name">
<br><br>


<?php

$result=search("select * from genomics_core.chemical ORDER BY chemical_name");

if ($result != "") {


    echo "<table id=\"myTable\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
    echo "<tr align=\"center\" style=\"font-size:18px;line-height:50px;\">";
    echo "<td width=\"30px\"></td>";
    echo "<td><b>Chemical Name</td>";
    echo "<td><b>Brand</td>";
    echo "<td><b>CAS number</td>";
    echo "<td><b>Owner</td>";
    echo "<td><b>Quantity</td>";
    echo "<td><b>Size</td>";
    echo "<td><b>Unit</td>";
    echo "<td><b>Location</td>";
    echo "<td><b>Remark</td>";
    echo "</tr>";


    for ($i = 0; $i < count($result); $i++) {
        echo "<tr style=\"font-size:15px;\">";

        echo "<td>";
        echo "<a class=\"button\" href=\"chemical_edit.php?item_id=" . $result[$i]['item_id'] . "\">>></a>";
        echo "</td>";

        echo "<td style=\"padding-left:5px\" width=\"500px\">";
        echo "<input type=\"hidden\" value=\"" . $result[$i]['item_id'] . "\" name=\"item_id\" id=\"item_id\">";
        echo $result[$i]['chemical_name'];
        echo "</td>";

        echo "<td align=\"center\" width=\"150px\">";
        echo $result[$i]['brand'];
        echo "</td>";

        echo "<td align=\"center\" width=\"150px\">";
        echo $result[$i]['cas_number'];
        echo "</td>";

        echo "<td align=\"center\" width=\"100px\">";
        echo $result[$i]['owner'];
        echo "</td>";

        echo "<td align=\"center\" width=\"100px\">";
        echo $result[$i]['quantity'];
        echo "</td>";

        echo "<td align=\"center\" width=\"70px\">";
        echo $result[$i]['size'];
        echo "</td>";

        echo "<td align=\"center\" width=\"70px\">";
        echo $result[$i]['unit'];
        echo "</td>";

        echo "<td align=\"center\" width=\"220px\">";
        echo $result[$i]['location'];
        echo "</td>";

        echo "<td style=\"padding-left:5px\" width=\"250px\">";
        echo $result[$i]['remark'];
        echo "</td>";
    }

    echo "</table><br><br>";

    echo "<td><a style=\"color:#002A60\" class=\"button\" href=\"Chemical_add.php\">Add Item</a></td>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<td><a style=\"color:#002A60\" class=\"button\" href=\"chemical_export.php\">Export</a></td>";

} else {
    echo "No chemical found in database, please contact tech support.";
}



?>




</body>
</html>
