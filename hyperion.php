<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:20%;
            margin-right:20%;
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
        .test {
		    font-family: sans-serif;
		    font-size: 17px;
		    font-weight: 100;
		    display: inline;
		    background-color: #ffffff;
		    border: 2px solid #002A60;
		    border-radius: 10px;
		    color: #002A60;
		    padding: 5px 5px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    -webkit-transition-duration: 0.4s; /* Safari */
		    transition-duration: 0.4s;
		    cursor: pointer;
		}
		.test:hover {
		    background-color: #002A60;
		    color: #e6ecff;
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
<h6>HYPERION REQUEST INSTRUCTIONS</h6>
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
        <td valign="top">
            <?php require("hyperion_search.php");?>
        </td>
    </tr>
</table>
<br>

<form action="hyperion.php" method="get">
    <p>How many slides do you want to prepare?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" max="1000" min="0"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>
<br><br><hr><br>

<?php

    if($sample_count>0){

        $result_num=search("select max(tmp_id) from hyperion where run='$rr'");
        $max_num=$result_num[0]['max(tmp_id)']+1;

        $table_col_name=array("tissue_type","identity_marker","metal_element","ROI_number","ROI_dimension","Ar_hours","remark");

		echo "<p>$sample_count samples to be added</p><br><br>";

        echo "<form name=\"hyperion\" action=\"hyperion_add_mysql.php#top\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"run\" value=\"$rr\">";
        echo "<input type=\"hidden\" name=\"sample_count\" value=\"$sample_count\">";

        echo "<table border=\"1\" width=\"1000px\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"center\" height=\"70px\">";
        echo "<td width=\"100px\">Sample No.</td>";
        echo "<td>Type of tissues</td>";
        echo "<td>Identity marker(s) of interest</td>";
        echo "<td>Metal element</td>";
        echo "<td>Number of ROI(s) in total</td>";
        echo "<td>Dimension of each ROI (mm*mm)&nbsp;<br><font size=1>*separated by semicolon if multiple values applicable</font></td>";
        echo "<td>Expected hours of Ar usage</td>";
        echo "</tr>";

        for($i=0;$i<$sample_count;$i++){

            echo "<tr align=\"center\">";
            echo "<td>";
            echo $i+1;
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[0]."-".$i."\" size=\"14\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[1]."-".$i."\" size=\"23\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[2]."-".$i."\" size=\"16\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[3]."-".$i."\" size=\"20\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[4]."-".$i."\" size=\"26\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[5]."-".$i."\" size=\"22\"/>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<br>";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"left\" width=\"600 px\" height=\"40 px\">";
        echo "<td>&nbsp;&nbsp;Remarks<br><font size=1>&nbsp;&nbsp;*optional, if you need to explain in detail&nbsp;&nbsp;</font></td>";
        echo "<td>";
        echo "<textarea name=\"".$table_col_name[6]."\" rows=\"3\" style=\"width:520px\"></textarea>";
        echo "</td>";
        echo "</tr>";
        echo "</table><br><br>";

        echo "<button class=\"test\" id=\"demo\" onclick=\"javascript:{this.disabled=true;document.hyperion.submit();document.getElementById('demo').innerHTML='Waiting...';}\">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
        echo "</form>";
        
        echo "<br><p style=\"color:#002A60;font-size:12px;line-height:30px\">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p><br>";


    }
?>

</body>
</html>