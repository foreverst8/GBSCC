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
</head>
<body>
<br>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

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
			
			$result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
			
			if(count($result_user)==0){
				echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
				echo 'You do not have permission to access this page.<br />';			
				exit;
			}
			
			$sample_count=0;
			if($_GET['sample_count']){
				$sample_count=$_GET['sample_count'];
			}
			?>  
		  
		<ul>
		<li> For sample preparation, please refer to the <a href="sanger_sample_preparation.php">"Sample Preparation"</a> instructions.</li>
		<li> <span style="color:red">Price</span> for Sanger Sequencing is <span style="color:red">33 MOP</span> per Reaction.</li>
		<li> For submission of sample names, please <span style="color:red">DO NOT use special characters</span> such as space(" "), hash("#") or asterisk("*"). The database only allows characters like "a-z,A-Z,0-9,-,_,."</li>
		<li>Submit your samples together with the hard-copy of the sequencing service form to the collection box located in <span style="color:red">N22-3009 before 2:00 p.m. every Monday</span>. The box is kept near the pH meter. If it is a <span style="color:red">public holiday on Monday</span>, the collection day will be on <span style="color:red">the next working day</span>.</li>
		</ul>
		<br>
		</td>
		<td valign="top">
		   <?php require("search.php");?>
		</td>
	</tr>
</table>

     <?php 
	 $tmp_id=$_GET['tmp_id'];
	 $run=$_GET['run'];
	 $column=array("tmp_id","Sample_name","DNA_type","conc","Size","Primer_type","Submitter","Lab","Email","Date"); 
	 $col=count($column);
	 $search_result=search("select * from sangerseq_record where tmp_id='$tmp_id' and run='$run'");
	 #echo "select * from sangerseq_record where tmp_id='$tmp_id' and run=$run<br>";
	 if(!$_GET['Sample_name']){

		  $count_search_result=count($search_result); 
		  if($count_search_result>0){
			  echo "<form action=\"edit_record.php\" method=\"get\">";
			  echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
			  echo "<tr align=\"center\">";
			  echo "<td rowspan=\"2\" width=\"40px\">Run</td>";
			  echo "<td rowspan=\"2\" width=\"40px\">No.</td>";
			  echo "<td colspan=\"4\" width=\"600px\">DNA Template</td>";
			  echo "<td rowspan=\"2\" width=\"100px\">Primer Type</td>";	
			  echo "<td rowspan=\"2\" width=\"100px\">Submitter's Name</td>";	
			  echo "<td rowspan=\"2\" width=\"100px\">Lab</td>";
			  echo "<td rowspan=\"2\" width=\"100px\">Email</td>";
			  echo "<td rowspan=\"2\" width=\"100px\">Date</td>";	
			  echo "</tr>";
			  echo "<tr align=\"center\">";
			  echo "<td width=\"290px\">Sample Name</td>";
			  echo "<td width=\"100px\">DNA Type</td>";
			  echo "<td width=\"100px\">Conc. (ng/&micro;L)</td>";
			  echo "<td width=\"80px\">Size (bp)</td>";
			  echo "</tr>";
				  
			  for($i=0;$i<$count_search_result;$i++){
				  echo "<tr align=\"center\">";
				  echo "<td>";
				  echo "<input type=\"hidden\" value=\"".$search_result[$i]['run']."\" name=\"run\" id=\"run\">".$search_result[$i]['run'];
				  echo "</td>";
				  echo "<td>";
				  echo "<input type=\"hidden\" value=\"".$search_result[$i]['tmp_id']."\" name=\"tmp_id\" id=\"tmp_id\">".$search_result[$i]['tmp_id'];
				  echo "</td>";
				  echo "<td>";
				  echo "<input type=\"text\" value=\"".$search_result[$i]['Sample_name']."\" name=\"".$column[1]."\" id=\"".$column[1]."\" size=\"43\">";
				  echo "</td>";
				  
				  
				  for($ii=2;$ii<$col-4;$ii++){
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
			echo "<a href=\"del_info_mysql.php?database=sangerseq_record&id=".$search_result[0]['seq_id']." \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure you want to delete record ".$search_result[0]['run']."-".$search_result[0]['tmp_id']."-".$search_result[0]['Sample_name']."?');\"  value=\"Delete \" /></a>";
						  
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

		$res=$conn->query("UPDATE genomics_core.sangerseq_record SET $value WHERE tmp_id='$tmp_id' and run='$run'");
		#echo "UPDATE genomics_core.sangerseq_record SET $value WHERE tmp_id='$tmp_id' and run='$run''";
		if (!$res){
			echo "Error: mysql_1 " . mysql_error();
			
		}
		else{
			echo "Record Run $run,No. $tmp_id has been updated.";
		}
	 }
#UPDATE `genomics_core`.`sangerseq_tmp` SET `conc`='7' WHERE `tmp_id`='4';
	 
	?>

</body>
</html>
