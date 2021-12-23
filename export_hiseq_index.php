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
span {
	background-color: #e6ecff;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="http://libs.useso.com/js/jquery/1.9.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<script type="text/javascript"> 
       function gradeChange1(){ 
        var objS = document.getElementById("date"); 
        var val = document.getElementById("date").value; 
		document.getElementById('run').innerHTML=val;
       } 
</script>

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>SEARCH RESULT</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?php
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
   	?>  

<?php

$conn = db_connect();

$result_run=search("select distinct Run from hiseq_sample where Run!='-'");

$Run=$_POST['Run'];

echo "<form action=\"export_hiseq_index.php\" method=\"post\">";
echo "<span>Select Run:&nbsp;</span><select name=\"Run\">";
echo "<option value=\"0\">Select</option>";
for($i=0;$i<count($result_run);$i++){
	if($result_run[$i]['Run']===""){
		continue;	
	}
	if($result_run[$i]['Run']==="-"){
		continue;	
	}
	echo "<option value=\"".$result_run[$i]['Run']."\"";
	if($result_run[$i]['Run']===$Run){
		echo "selected=\"selected\"";
	}
	echo ">".$result_run[$i]['Run']."</option>";
	
}
echo "</select><span>&nbsp;</span><input type=\"submit\" class=\"button\" value=\"Select\" /><br>";
echo "</form>";

if($Run!=""){
	#echo "$Run<br>";
	$result_index=search("select * from hiseq_sample where Run='$Run'");
	#echo "select * from sangerseq_record where run=$run<br>";
	if(count($result_run)==0){
		echo "There are no records for this run.<br>";
	}
	else{
		$file_name="../genomics_core/export_txt/$Run-".date("ymdHis").".txt";
		$fp = fopen($file_name, "w");//empty the file and write
		if($fp){ 
		
			for($i=0;$i<count($result_index);$i++){
				#$flag=fwrite($fp,$result_index[$i]['Hiseq_Sample_ID']."\t".$result_index[$i]['Sample_Name']."\t".$result_index[$i]['Submitter_Name']."\t".$result_index[$i]['lab']); 
				#echo "$flag<br>";
				
				#if(preg_match("/,/",$result_index[$i]['Lanes'])){
					#echo "$Run--<br>";
					$lanes_arr=explode(",",$result_index[$i]['Lanes']);
					
					for($ii=0;$ii<count($lanes_arr);$ii++){
						$result_sample=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_index[$i]['Hiseq_Sample_ID']."'");
						for($j=0;$j<count($result_sample);$j++){
							
							$flag=fwrite($fp,$lanes_arr[$ii]."\t".$result_index[$i]['Hiseq_Sample_ID']."\t".$result_index[$i]['Sample_Name']."\t".$result_index[$i]['Submitter_Name']."\t".$result_index[$i]['lab']."\t".$result_sample[$j]['Library_Name']."\t".$result_sample[$j]['Project_Type']."\t".$result_sample[$j]['I7_No']."\t".$result_sample[$j]['I7_Seq']."\t".$result_sample[$j]['I5_No']."\t".$result_sample[$j]['I5_Seq']."\t".$result_sample[$j]['Barcode_No']."\t".$result_sample[$j]['Barcode_Seq']."\n"); 	
							
							if(!$flag){ 
								echo "Write failed.<br>"; 
								break; 
							}
						}
						#echo "$lanes_arr[$ii]<br>";				
					}
				#}
				#else{
				#	$result_sample=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_index[$i]['Hiseq_Sample_ID']."'");
				#	for($j=0;$j<count($result_sample);$j++){
						
				#		$flag=fwrite($fp,$result_index[$i]['Lanes']."\t".$result_index[$i]['Hiseq_Sample_ID']."\t".$result_index[$i]['Sample_Name']."\t".$result_index[$i]['Submitter_Name']."\t".$result_index[$i]['lab']."\t".$result_sample[$j]['Library_Name']."\t".$result_sample[$j]['Project_Type']."\t".$result_sample[$j]['I7_No']."\t".$result_sample[$j]['I7_Seq']."\t".$result_sample[$j]['I5_No']."\t".$result_sample[$j]['I5_Seq']."\t".$result_sample[$j]['Barcode_No']."\t".$result_sample[$j]['Barcode_Seq']."\n"); 	
				#		if(!$flag){ 
				#			echo "write faild<br>"; 
				#			break; 
				#		}
				#	}	
					
					
						
				#}
			}
		}
		else{ 
			echo "Cannot write to the .TXT file"; 
		} 
		fclose($fp); 
			
	}
	
	if (file_exists($file_name)){
		echo "<span>Export Index:&nbsp;</span><a href=\"$file_name\" class=\"button\" target=\"_blank\">Export</a>";
		echo "<br><br>";
	} 
	else{
		echo "Something went wrong. Please contact the developer.";	
	}

}
?>

    </td>
	<td valign="top">
	<?php require("search_hiseq.php");?>
	</td>
  </tr>
</table>












