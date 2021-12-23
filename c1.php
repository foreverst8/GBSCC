<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>

<body>
<br>

<?php require('login.php');?>
<hr>
<br>
<h6>C1</h6>
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

	<p>Fluidigm C1&trade; system allows users to rapidly capture and isolate up to 96 individual cells in one reaction by processing with C1&trade; Integrated Fluidic Circuits (IFCs) based on three cell sizes – small cells (5–10 &micro;m), medium cells (10–17 &micro;m), and large cells (17–25 &micro;m). This service also provides accurate and sensitive whole-transcriptome profiling of single cells, in addition to viewing multiple cell types in one chip when different CellTracker dyes are used.</p>
	</td>
  </tr>
</table>

<br>

<form action="c1.php" method="get">
<p>How many samples do you want to prepare?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" max="2" min="0"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>
<br><br><hr>

<?php
	$startdate = strtotime("Tuesday");
	$rr="CR";
	if(date("l")=="Tuesday"){
		if(date("His")>"170000"){
			$rr.=date("ymd", $startdate);
		}
		else{
			$rr.=date("ymd");	
		}	
	}
	else{
		$rr.=date("ymd", $startdate);
	}
	
	if($sample_count>0){
		
		$result_num=search("select max(tmp_id) from c1 where run='$rr'");
		$max_num=$result_num[0]['max(tmp_id)']+1;	
	
		$table_col_name=array("cell_type","dye","size","viability","chip");
		
		echo "<p>Number of samples for sequencing is $sample_count.</p><br><br>";
		
		echo "<form action=\"c1_add_mysql.php\" method=\"get\">";
		echo "<input type=\"hidden\" name=\"run\" value=\"$rr\">";
		echo "<input type=\"hidden\" name=\"sample_count\" value=\"$sample_count\">";
		
		echo "<table border=\"1\" width=\"600 px\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
		
		echo "<tr align=\"center\" height=\"40 px\">";
		echo "<td >Run</td>";
		echo "<td >Types of cell line</td>";
		echo "<td >Name of Dye used</td>";
		echo "<td >Cell Size (&micro;m)</td>";
		echo "</tr>";
		
		for($i=0;$i<$sample_count;$i++){
			
			echo "<tr align=\"center\">";
			echo "<td>";
			echo "&nbsp;&nbsp;<input type=\"hidden\" value=\"".$rr."\" name=\"run-".$i."\" />$rr&nbsp;&nbsp;";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[0]."-".$i."\" size=\"43\"/>";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[1]."-".$i."\" size=\"43\"/>";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[2]."-".$i."\" size=\"20\"/>";
			echo "</td>";			
			echo "</tr>";
		}
		
		echo "</table>";

		echo "<br>";
		echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
		echo "<tr align=\"center\" width=\"600 px\" height=\"40 px\">";
		echo "<td>&nbsp;&nbsp;Viability staining required?&nbsp;&nbsp;</td>";
		
		echo "<td>";
		echo "<select name=\"".$table_col_name[3]."\">";
		echo "<option value=\"gomya\" selected=\"selected\">Select</option>";
		echo "<option value=\"yes\">Yes</option>";
		echo "<option value=\"no\">No</option>";
		echo "</select>";
		echo "</td>";
		echo "</tr>";	
		echo "</table>";
		
		echo "<br>";
		echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
		echo "<tr align=\"center\" width=\"600 px\" height=\"40 px\">";
		echo "<td>&nbsp;&nbsp;Type of Chip?&nbsp;&nbsp;</td>";
		
		echo "<td>";
		echo "<select name=\"".$table_col_name[4]."\">";
		echo "<option value=\"chip\" selected=\"selected\">Select</option>";
		echo "<option value=\"96\">IFC (for 96 cells)</option>";
		echo "<option value=\"800\">HT-IFC (for 800 cells)</option>";
		echo "</select>";
		echo "</td>";
		echo "</tr>";	
		echo "</table>";		
		
		echo "<br><input class=\"button\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
		echo "</form>";
	}	
?>