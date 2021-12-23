<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:10%;
            margin-right:10%;
        }
        table, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        th {
            font-weight: bold;
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
<h6>CONFIRM APPROVAL STATUS</h6>
<br>

<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>

<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }

            $sample_count=0;
            if($_GET['sample_count']){
                $sample_count=$_GET['sample_count'];
            }
            ?>
        </td>
    </tr>
</table>

<?php
$run=$_GET['run'];
$_SESSION["run"] = $run;
$column=array("run","Approval","tmp_id","cell_type","identity_marker","metal_element","remark","staining","Submitter","Lab","Email","Date");
$col=count($column);
$search_result=search("select * from cytof where run='$run'");


//if(!$_GET['cell_type']){
    $count_search_result=count($search_result);
    if($count_search_result>0) {
        echo "<form action=\"cytof_confirm_action.php\" method=\"get\">";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"center\">";
        echo "<td width=\"100px\">Run</td>";
        echo "<td width=\"100px\"><span style=\"color:red\">Approval status</span></td>";
        echo "<td width=\"40px\">No.</td>";
        echo "<td width=\"100px\">Type of cell line</td>";
        echo "<td width=\"100px\">Identity marker(s)</td>";
        echo "<td width=\"100px\">Metal element</td>";
        echo "<td width=\"150px\">Remark</td>";
        echo "<td width=\"200px\">Staining property</td>";
        echo "<td width=\"100px\">Submitter</td>";
        echo "<td width=\"100px\">Lab</td>";
        echo "<td width=\"100px\">Email</td>";
        echo "<td width=\"100px\">Date</td>";
        echo "</tr>";

        for ($i = 0; $i < $count_search_result; $i++) {
            echo "<tr align=\"center\">";

            for($ii=0;$ii<$col;$ii++){

                echo "<td>";
                if($search_result[$i][$column[$ii]]==""){
                    echo "&nbsp;";
                }
                else{
                    echo $search_result[$i][$column[$ii]];
                }
                echo "</td>";

            }

            echo "</tr>";
        }
        echo "</table>";

        $runid=$search_result[0]['run'];
        echo "<br><p>Please select $runid approval status: </p>";
        echo "<select name=\"Approval\" id=\"Approval\">";
        if ($search_result[0]['Approval'] == "Rejected") {
            echo "<option value=\"Rejected\" selected=\"selected\">Rejected</option>";
            echo "<option value=\"Confirmed\">Confirmed</option>";
            echo "<option value=\"Pending\">Pending</option>";
        } elseif ($search_result[0]['Approval'] == "Confirmed") {
            echo "<option value=\"Confirmed\" selected=\"selected\">Confirmed</option>";
            echo "<option value=\"Rejected\">Rejected</option>";
            echo "<option value=\"Pending\">Pending</option>";
        } else {
            echo "<option value=\"Pending\" selected=\"selected\">Pending</option>";
            echo "<option value=\"Rejected\">Rejected</option>";
            echo "<option value=\"Confirmed\">Confirmed</option>";
        }
        echo "</select><br>";

        echo "<p><br>Remark (if the request is rejected): </p>";
        echo "<input type=\"text\" size=\"50\" value=\"" . $search_result[0]['remark_reject'] . "\" name=\"remark_reject\" id=\"remark_reject\">";

        echo "<p><br><br>Select available time slot (if the request is confirmed): </p>";
        echo "<input type=\"text\" name=\"date_run\" id=\"date_run\" class=\"tcal\"/>";

        echo "&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"time_run\" id=\"time_run\">";
        echo "<option value=\"NA\" selected=\"selected\">-</option>";
        echo "<option value=\"10am\">10am</option>";
        echo "<option value=\"2pm\">2pm</option>";
        echo "<option value=\"4pm\">4pm</option>";
        echo "</select><br><br><br>";


        echo "<p><font size=2>*Clicking Submit when approval status is 'Confirmed' or 'Rejected' will automatically send an email to user.</p>";
        echo "<br><br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<a href=\"del_info_mysql.php?database=cytof&id=" . $search_result[0]['run'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure to delete all samples of request " . $search_result[0]['run'] . "?');\"  value=\"Delete \" /></a>";

        echo "</form>";
    }
//}

/*
else{

    $run=$_GET['run'];
    $Approval=$_GET['Approval'];
    $remark_reject=$_GET['remark_reject'];
    $date_run=$_GET['date_run'];

    $conn = db_connect();
    mysqli_query($conn, "SET NAMES GB2312");

    $res = $conn->query("UPDATE genomics_core.cytof SET Approval = '$Approval' WHERE run='$run'");
    $res = $conn->query("UPDATE genomics_core.cytof SET remark_reject = '$remark_reject' WHERE run='$run'");
    $res = $conn->query("UPDATE genomics_core.cytof SET date_run = '$date_run' WHERE run='$run'");


    if (!$res) {
        echo "<p>Request $run failed to updated. Please contact Genomics Core support: siyunliu@um.edu.mo<br><br></p>" . mysql_error();
    } else {
        echo "<p>Request $run has been updated.<br><br></p>";
    }

}
*/

?>

</body>
</html>