<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:5%;
            margin-right:5%;
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
<h6>EDIT RECORD</h6>
<br>
<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");

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
<br>

<?php
$tmp_id=$_GET['tmp_id'];
$run=$_GET['run'];
$column=array("tmp_id","tissue_type","identity_marker","metal_element","ROI_number","ROI_dimension","Ar_hours","remark","Submitter","Lab","Email","Date");
$col=count($column);
$search_result=search("select * from hyperion where tmp_id='$tmp_id' and run='$run'");

if(!$_GET['tissue_type']){
    $count_search_result=count($search_result);
    if($count_search_result>0) {
        echo "<form action=\"hyperion_edit_record.php\" method=\"get\">";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"center\">";
        echo "<td width=\"100px\">Run</td>";
        echo "<td width=\"40px\">No.</td>";
        echo "<td width=\"100px\">Type of tissues</td>";
        echo "<td width=\"100px\">Identity marker(s)</td>";
        echo "<td width=\"100px\">Metal element</td>";
        echo "<td width=\"100px\">Number of ROI(s) in total</td>";
        echo "<td width=\"100px\">Dimension of each ROI (mm*mm)</td>";
        echo "<td width=\"100px\">Expected hours of Ar usage</td>";
        echo "<td width=\"100px\">User Remark</td>";
        echo "<td width=\"100px\">Submitter</td>";
        echo "<td width=\"100px\">Lab</td>";
        echo "<td width=\"100px\">Email</td>";
        echo "<td width=\"100px\">Date</td>";
        echo "</tr>";

        for ($i = 0; $i < $count_search_result; $i++) {
            echo "<tr align=\"center\">";
            echo "<td>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['run'] . "\" name=\"run\" id=\"run\">" . $search_result[$i]['run'];
            echo "</td>";
            echo "<td>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['tmp_id'] . "\" name=\"tmp_id\" id=\"tmp_id\">" . $search_result[$i]['tmp_id'];
            echo "</td>";

            for($ii=1;$ii<$col-4;$ii++){
                echo "<td>";
                echo "<input type=\"text\" value=\"".$search_result[$i][$column[$ii]]."\" name=\"".$column[$ii]."\" id=\"".$column[$ii]."\" size=\"15\">";
                echo "</td>";
            }
            for($ii=$col-4;$ii<$col;$ii++){
                echo "<td>";
                echo $search_result[$i][$column[$ii]];
                echo "</td>";
            }


            echo "</tr>";
        }
        echo "</table>";

        echo "<br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<a href=\"del_info_mysql.php?database=hyperion&id=" . $search_result[0]['seq_id'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure you want to delete record " . $search_result[0]['run'] . "-" . $search_result[0]['tmp_id'] . "?');\"  value=\"Delete \" /></a>";

        echo "</form>";
    }
    else{
        echo "<p>There is no record of Run. $run , No. $tmp_id.<br></p>";
    }
}
else{

    $value="";

    for($ii=1;$ii<$col-4;$ii++){
        $value.="$column[$ii]='".$_GET[$column[$ii]]."',";
    }
    $value=preg_replace('/,$/',' ',$value);

    $conn = db_connect();
    mysqli_query($conn,"SET NAMES GB2312");

    $res=$conn->query("UPDATE genomics_core.hyperion SET $value WHERE tmp_id='$tmp_id' and run='$run'");
    #echo "UPDATE genomics_core.sangerseq_record SET $value WHERE tmp_id='$tmp_id' and run='$run''";
    if (!$res){
        echo "Error: mysql_1 " . mysql_error();

    }
    else{
        echo "Record Run $run,No. $tmp_id has been updated.";
    }
}
?>

</body>
</html>