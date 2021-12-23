<html>
<head>
    <style>
        body {
            margin-left:15%;
            margin-right:15%;
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
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>CHROMIUM 10X GENOMICS - EDIT</h6>

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
<br><br>


<?php

$run=$_GET['run'];
$search_result=search("select * from Chromium_10x_Genomics where run='$run'");
$count_search_result=count($search_result);

if($count_search_result>0) {

    echo "<form action=\"chromium10x_edit_action.php\" method=\"get\">";
    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";

    echo "<tr align=\"center\" height=\"60px\">";
    echo "<td width=\"150px\">Run</td>";
    echo "<td>Sample<br>number</td>";
    echo "<td>Diameter<br>under 30µm</td>";
    echo "<td>Remark</td>";
    echo "<td width=\"100px\">Submitter</td>";
    echo "<td width=\"150px\">Lab</td>";
    echo "<td width=\"150px\">Email</td>";
    echo "<td width=\"100px\">Date</td>";
    echo "</tr>";

    for($i=0;$i<$count_search_result;$i++){
        echo "<tr align=\"center\" height=\"40px\">";
        echo "<td>";
        echo "<input type=\"hidden\" value=\"" . $search_result[$i]['run'] . "\" name=\"run\" id=\"run\">" . $search_result[$i]['run'];
        echo "</td>";
        echo "<td>";
        echo "<input type=\"text\" value=\"".$search_result[$i]['count']."\" name=\"count\" id=\"count\" size=\"15\">";
        echo "</td>";
        echo "<td>";
        echo "<input type=\"text\" value=\"".$search_result[$i]['diameter']."\" name=\"diameter\" id=\"diameter\" size=\"15\">";
        echo "</td>";
        echo "<td>";
        echo "<input type=\"text\" value=\"".$search_result[$i]['remark']."\" name=\"remark\" id=\"remark\" size=\"30\">";
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['user'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['lab'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['email'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['date'];
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href=\"del_info_mysql.php?database=Chromium_10x_Genomics&id=" . $search_result[0]['run'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Delete " . $search_result[0]['run'] . "?');\" value=\"Delete\" /></a>";
    echo "</form>";

} else {
    echo "<p>No record found.</p><br>";
}


?>