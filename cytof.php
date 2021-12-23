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
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>FLUIDIGM HELIOS - REQUEST INSTRUCTIONS</h6>
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

            <ul>
                <li>For sample preparation, please refer to the CyTOF sample preparation instructions: <a class="button" href="cytof_sample_preparation.php">Click</a>.</li>
                <li>All samples should meet the following criteria:
                    <ol>
                        <li>Starting cell population for staining is 3 x10<sup>6</sup> cells/mL</li>
                        <li>Cells are required to be dissociated into single cell suspension</li>
                        <li>Antibody-stained cell population should be within a range of 2.5–5 x10<sup>5</sup> cells/mL</li>
                        <li>Cells should be counted and pelleted before submission</li>
                    </ol>
                </li>
            </ul>
        </td>
        <td valign="top">
            <?php require("cytof_search.php");?>
        </td>
    </tr>
</table>
<br>

<form action="cytof.php" method="get">
    <p>How many samples do you want to prepare?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" max="100" min="0"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>
<br><br><hr><br>

<?php

    if($sample_count>0){

        $result_num=search("select max(tmp_id) from cytof where run='$rr'");
        $max_num=$result_num[0]['max(tmp_id)']+1;

        $table_col_name=array("cell_type","identity_marker","metal_element","remark");

        echo "<p>$sample_count samples to be added</p><br><br>";

        echo "<form name=\"cytof\" action=\"cytof_add_mysql.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"run\" value=\"$rr\">";
        echo "<input type=\"hidden\" name=\"sample_count\" value=\"$sample_count\">";

        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"center\" height=\"40 px\">";
        echo "<td width=\"120px\">Sample No.</td>";
        echo "<td >Type of cell line</td>";
        echo "<td >Identity marker(s) of interest</td>";
        echo "<td >Metal element</td>";
        echo "</tr>";

        for($i=0;$i<$sample_count;$i++){

            echo "<tr align=\"center\">";
            echo "<td>";
            echo $i+1;
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[0]."-".$i."\" size=\"26\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[1]."-".$i."\" size=\"30\"/>";
            echo "</td>";

            echo "<td>";
            echo "<input type=\"text\" name=\"".$table_col_name[2]."-".$i."\" size=\"26\"/>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<br>";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"left\" width=\"600 px\" height=\"40 px\">";
        echo "<td>&nbsp;&nbsp;Remarks<br><font size=1>&nbsp;&nbsp;*optional, if you need to explain in detail&nbsp;&nbsp;</font></td>";
        echo "<td>";
        echo "<textarea name=\"".$table_col_name[3]."\" rows=\"3\" style=\"width:520px\"></textarea>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";

        echo "<br>";
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
        echo "<tr align=\"left\" width=\"600 px\" height=\"40 px\">";
        echo "<td>&nbsp;&nbsp;Staining Property<br><font size=1>&nbsp;&nbsp;*select if applicable, otherwise select N/A</font><br><font size=1>&nbsp;&nbsp;*hold down Ctrl key (in Windows) or Command key (on Mac) to select multiple properties&nbsp;&nbsp;</font></td>";
        echo "<td>";
        echo "<select style=\"height:85px\" name=\"staining[]\" multiple>";
        echo "<option value=\"Live/dead cell discrimination (Cis platin Pt-195)\">Live/dead cell discrimination (Cis platin Pt-195)</option>";
        echo "<option value=\"Fc blocking\">Fc blocking</option>";
        echo "<option value=\"Surface marker staining\">Surface marker staining</option>";
        echo "<option value=\"Intracellur marker staining\">Intracellur marker staining</option>";
        echo "<option value=\"N/A\">N/A</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";

        echo "<br><br><input class=\"button\" type=\"submit\" onclick=\"javascript:{this.disabled=true;document.cytof.submit()}\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
        echo "</form>";
        
        echo "<br><p style=\"color:#002A60;font-size:12px;line-height:30px\">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p><br>";
    }
?>


</body>
</html>