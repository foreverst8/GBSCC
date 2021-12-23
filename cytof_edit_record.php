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
<h6>EDIT RECORDS</h6>
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
$column=array("tmp_id","cell_type","identity_marker","metal_element","remark","staining","cell_concentration","Submitter","Lab","Email","Date");
$col=count($column);
$search_result=search("select * from cytof where tmp_id='$tmp_id' and run='$run'");

if(!$_GET['cell_type']){
    $count_search_result=count($search_result);
    if($count_search_result>0) {
        echo "<form action=\"cytof_edit_record.php\" method=\"get\">";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"center\">";
        echo "<td width=\"100px\">Run</td>";
        echo "<td width=\"100px\"><span style=\"color:red\">Approval status</span></td>";
        echo "<td width=\"40px\">No.</td>";
        echo "<td width=\"100px\">Type of cell line</td>";
        echo "<td width=\"100px\">Identity marker(s)</td>";
        echo "<td width=\"100px\">Metal element</td>";
        echo "<td width=\"150px\">Remark</td>";
        echo "<td width=\"150px\">Staining property</td>";
        if($search_result[0]['Approval']==Confirmed){
            echo "<td width=\"150px\">Cell concentration</td>";
        }
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
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['Approval'] . "\" name=\"Approval\" id=\"Approval\">" . $search_result[$i]['Approval'];
            echo "</td>";
            echo "<td>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['tmp_id'] . "\" name=\"tmp_id\" id=\"tmp_id\">" . $search_result[$i]['tmp_id'];
            echo "</td>";

            for($ii=1;$ii<$col-5;$ii++){
                echo "<td>";
                echo "<input type=\"text\" value=\"".$search_result[$i][$column[$ii]]."\" name=\"".$column[$ii]."\" id=\"".$column[$ii]."\" size=\"18\">";
                echo "</td>";
            }

            if($search_result[0]['Approval']==Confirmed){
                echo "<td>";
                echo "<input type=\"text\" value=\"" . $search_result[$i]['cell_concentration'] . "\" name=\"cell_concentration\" id=\"cell_concentration\" size=\"18\">";
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

        echo "<br><br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
        echo "</form>";
    }
    else{
        echo "<p>There is no request of Run $run record no. $tmp_id.<br></p>";
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

    $res=$conn->query("UPDATE genomics_core.cytof SET $value WHERE tmp_id='$tmp_id' and run='$run'");
    if (!$res){
        echo "Error: mysql_1 " . mysql_error();

    }
    else{
        echo "<p style=\"color:red\">Run $run record no.$tmp_id has been updated.</p>";
    }
}
?>

</body>
</html>

