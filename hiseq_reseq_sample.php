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

<?php session_start();?>
<?php require('login.php');?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

<script type="text/javascript"> 
       function gradeChange1(){ 
        var objS = document.getElementById("Category"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="Others"){
			//document.getElementById("ohter_category").style.display="block";
			document.getElementById("tb_cate").style.display="block";
		}
		else{
			//document.getElementById("ohter_category").style.display="none";
			document.getElementById("tb_cate").style.display="none";
		}
       } 
	   function gradeChange2(){ 
        var objS = document.getElementById("Kit"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="Others"){
			//document.getElementById("ohter_kit").style.display="block";
			document.getElementById("tb_kit").style.display="block";
		}
		else{
			//document.getElementById("ohter_kit").style.display="none";
			document.getElementById("tb_kit").style.display="none";
		}
       } 
	   function gradeChange3(){ 
        var objS = document.getElementById("Index_Number"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="1"){
			//document.getElementById("ohter_kit").style.display="block";
			document.getElementById("tb_index").style.display="block";
			document.getElementById("span_index").style.display="none";
		}
		else{
			//document.getElementById("ohter_kit").style.display="none";
			document.getElementById("tb_index").style.display="none";
			document.getElementById("span_index").style.display="block";
		}
       }
</script>

<hr>
<br>
<h6>COPY</h6>
<br>
<table>
  <tr>
	<td align="left" valign="top">
     <?PHP   
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo '<p>You do not have permission to access this page.<br /></p>';			
			exit;
		}
	 ?>  
     </td>
     <td valign="top">
     <?php require("search_hiseq.php");?>
     </td>
  </tr>
</table>

<p>DETAILS</p><br><br>

<?php

$conn = db_connect();
$Hiseq_Sample_ID=$_GET['ID'];
$result_sample=search("select * from hiseq_sample where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
$result_Library=search("select * from hiseq_library where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
		
$result_Sample_ID=search("select max(Sample_id) from hiseq_sample");
$Sample_id=1;
if(count($result_Sample_ID)<1){
	$Sample_id=1;	
}
else{
	if($result_Sample_ID[0]['max(Sample_id)']!=""){
		$Sample_id=$result_Sample_ID[0]['max(Sample_id)']+1;
	}
}

$Hiseq_Sample_ID_new="RE_".$Hiseq_Sample_ID;

if(count($result_sample)<1){
	echo "Could not find the record.<br>";
}
else{
			
			$value="'".$Sample_id."',";
			$value.="'".$Hiseq_Sample_ID_new."',";
			$value.="'".$result_sample[0]['Sample_Name']."',";
			$value.="'".$result_sample[0]['Submitter_Name']."',";
			$value.="'".$result_sample[0]['lab']."',";
			$value.="'".$result_sample[0]['libraries']."',";
			$value.="'".$result_sample[0]['reads_count']."',";
			$value.="'".$result_sample[0]['Read_Length']."',";
			$value.="'".$result_sample[0]['Index_Number']."',";
			$value.="'".$result_sample[0]['Index_Position']."',";
			$value.="'".$result_sample[0]['end']."',";
			$value.="'".$result_sample[0]['Category']."',";
			$value.="'".$result_sample[0]['Avg_Pool']."',";
			$value.="'".$result_sample[0]['Remark']." Copy from $Hiseq_Sample_ID',";
			$value.="'".date("d/m/y")."',";
			$value.="'".$result_sample[0]['Conc']."',";
			$value.="'".$result_sample[0]['Volume']."',";
			$value.="'".$result_sample[0]['Mode']."',";
			$value.="'".$result_sample[0]['bioanalyzer_file']."',";
			$value.="'-'";
			
						
			$name="Sample_id,Hiseq_Sample_ID,Sample_Name,Submitter_Name,lab,libraries,reads_count,Read_Length,Index_Number,Index_Position,end,Category,Avg_Pool,Remark,date,Conc,Volume,Mode,bioanalyzer_file,Run";
			$res=$conn->query("INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$value.")");
			#
			
			if (!$res){
				echo "Sample Copy faild<br>";
				echo '<br>There was something wrong with your application.<br /><br><br>';	
				echo "INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$value.")<br>";		
				exit;	
				
			}
			else{
				echo "Sample copied Successfully. Sample ID: $Hiseq_Sample_ID_new<br>";
			}
			echo "<br>";

			
			$name="Library_id,Hiseq_Sample_ID,Hiseq_Library_ID,Library_Name,Project_Type,Conc,Volume,Buffer,Kit,I7_No,I7_Seq,I5_No,I5_Seq,Barcode_No,Barcode_Seq";
			$err_count=0;
			$added_count=0;
			for($i=0;$i<count($result_Library);$i++){
				
				$result_Library_ID=search("select max(Library_id) from hiseq_library");
				$Library_id=1;
				if(count($result_Library_ID)<1){
					$Library_id=1;	
				}
				else{
					if($result_Library_ID[0]['max(Library_id)']!=""){
						$Library_id=$result_Library_ID[0]['max(Library_id)']+1;
					}
				}
				
				$value="'".$Library_id."',";
				$value.="'".$Hiseq_Sample_ID_new."',";
				$value.="'NGSL".$Library_id."',";
				$value.="'".$result_Library[$i]['Library_Name']."',";
				$value.="'".$result_Library[$i]['Project_Type']."',";
				$value.="'".$result_Library[$i]['Conc']."',";
				$value.="'".$result_Library[$i]['Volume']."',";
				$value.="'".$result_Library[$i]['Buffer']."',";
				$value.="'".$result_Library[$i]['Kit']."',";
				$value.="'".$result_Library[$i]['I7_No']."',";
				$value.="'".$result_Library[$i]['I7_Seq']."',";
				$value.="'".$result_Library[$i]['I5_No']."',";
				$value.="'".$result_Library[$i]['I5_Seq']."',";
				$value.="'".$result_Library[$i]['Barcode_No']."',";
				$value.="'".$result_Library[$i]['Barcode_Seq']."'";
				$res=$conn->query("INSERT INTO genomics_core.hiseq_library($name) VALUES (".$value.")");
				if (!$res){
					$err_count++;
					#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
					
				}
				else{
					$added_count++;	
					#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
				}
			}
			
			echo "$added_count libraries copied successfully.<br> ";
			if($err_count>0){
				echo "$err_count libraries could not be added.<br>";	
			}
		
}
?>

</body>
</html>