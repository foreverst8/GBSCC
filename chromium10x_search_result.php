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
<h6>CHROMIUM 10X GENOMICS - SEARCH RESULT</h6>
<br>

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
            <p style="font-size:18px"> Users interested in the service are required to provide their own reagents and consumables. The Genomics core personnel will train and assist users interested in the technology to get familiar with the set up and use of the machine. For first time users, please contact us directly to set a time for consultation.<br><br></p>
        </td>
        <td valign="top">
            <?php require("search_10x.php");?>
        </td>
    </tr>
</table>
<br><hr><br>



<?php
$keywords=$_GET['Keywords'];

if($_GET['run']){
    if($_GET['Keywords']!=""){
        if($result_user[0]['main']==y){
            $search_result=search("select * from Chromium_10x_Genomics where run='".$_GET['run']."'");
            $search_run_result=search("select distinct(run) from Chromium_10x_Genomics");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from Chromium_10x_Genomics where lab ='".$result_user[0]['lab']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where lab='".$result_user[0]['lab']."'");

            } else{
                $search_result=search("select * from Chromium_10x_Genomics where user ='".$result_user[0]['user_name']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where user='".$result_user[0]['user_name']."'");
            }
        }
    }
    else{
        if($result_user[0]['main']==y){
            $search_result=search("select * from Chromium_10x_Genomics where run='".$_GET['run']."'");
            $search_run_result=search("select distinct(run) from Chromium_10x_Genomics");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from Chromium_10x_Genomics where lab ='".$result_user[0]['lab']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where lab='".$result_user[0]['lab']."'");

            } else{
                $search_result=search("select * from Chromium_10x_Genomics where user ='".$result_user[0]['user_name']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where user='".$result_user[0]['user_name']."'");
            }
        }
    }
}
else{
    if($_GET['Keywords']!=""){

        if($result_user[0]['main']==y){
            $search_result=search("select * from Chromium_10x_Genomics where run like '%$keywords%'");
            $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where run like '%$keywords%' ORDER BY run ASC");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from Chromium_10x_Genomics where lab ='".$result_user[0]['lab']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where lab='".$result_user[0]['lab']."'");

            } else{
                $search_result=search("select * from Chromium_10x_Genomics where user ='".$result_user[0]['user_name']."'");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where user='".$result_user[0]['user_name']."'");
            }
        }
    }
    else{
        if($result_user[0]['main']==y){
            $search_result=search("select * from Chromium_10x_Genomics ORDER BY seq_id DESC");
            $search_run_result=search("select distinct(run) from Chromium_10x_Genomics ORDER BY seq_id");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from Chromium_10x_Genomics where lab ='".$result_user[0]['lab']."' ORDER BY seq_id DESC");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where lab='".$result_user[0]['lab']."'ORDER BY seq_id ASC");

            } else{
                $search_result=search("select * from Chromium_10x_Genomics where user ='".$result_user[0]['user_name']."' ORDER BY seq_id DESC");
                $search_run_result=search("select distinct(run) from Chromium_10x_Genomics where user='".$result_user[0]['user_name']."' ORDER BY seq_id ASC");
            }
        }
    }
}



$last_run_order=count($search_run_result)-1;
$count_search_result=count($search_result);

if($count_search_result>0) {

    echo "<table border=\"1\"  cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
    echo "<tr align=\"center\">";
    echo "<td width=\"100px\">Total Run</td>";
    echo "<td width=\"250px\">";

    echo "<form action=\"chromium10x_search_result.php\" method=\"get\">";
    echo "<input type=\"hidden\" name=\"Keywords\" value=\"" . $keywords . "\" id=\"Keywords\">";
    echo "<select name=\"run\" onChange=\"MM_jumpMenu('parent',this,0)\">";
    for ($r = count($search_run_result) - 1; $r >= 0; $r--) {

        echo "<option value=\"" . $search_run_result[$r]['run'] . "\"";
        if ($r == count($search_run_result) - 1) {
            echo " selected = \"selected\" ";
        }
        echo ">" . $search_run_result[$r]['run'] . "</option>";
    }
    echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" class=\"button\" name=\"submit\"></form>";
    echo "</td></tr></table><br>";
    echo "<p>Selected Run: </p>";
    echo $_GET['Keywords'] . $_GET['run'] . "<br><br>";

    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
    echo "<tr align=\"center\" height=\"60px\">";
    if ($result_user[0]['main'] == y) {
        echo "<td width=\"10px\">&nbsp;</td>";
    }
    echo "<td width=\"150px\">Run</td>";
    echo "<td width=\"100px\">Sample number</td>";
    echo "<td width=\"150px\">Diameter under 30µm</td>";
    echo "<td width=\"200px\">Remark</td>";
    echo "<td width=\"100px\">Submitter</td>";
    echo "<td width=\"150px\">Lab</td>";
    echo "<td width=\"150px\">Email</td>";
    echo "<td width=\"100px\">Date</td>";
    echo "</tr>";

    for($i=0;$i<$count_search_result;$i++){
        if($search_result[$i]['run']!=$search_run_result[$last_run_order]['run'] and ($_GET['run']=="")){
            continue;
        }

        echo "<tr align=\"center\" height=\"40px\">";
        if($result_user[0]['main']==y){
            echo "<td width=\"10\"><a class=\"button\" href=\"chromium10x_edit.php?run=".$search_result[$i]['run']."\">>></a></td>";
        }
        echo "<td>";
        echo $search_result[$i]['run'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['count'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['diameter'];
        echo "</td>";
        echo "<td>";
        echo $search_result[$i]['remark'];
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

} else{
    echo "<p>No record found.</p><br>";
}






?>