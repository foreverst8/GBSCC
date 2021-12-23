<html>
<head>
<style>
body {
	margin-left:2%;
	margin-right:2%;
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
<h6>EDIT</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
     <?PHP
	  	
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
   	?>  
	</td>
  </tr>
  <tr>
	<td width="1000">
	<?php

	$conn = db_connect();

	$Hiseq_Sample_ID=$_POST['Hiseq_Sample_ID'];
	$Sample_Name=$_POST['Sample_Name'];
	$lab=$_POST['lab'];
	$libraries=$_POST['libraries'];
	$reads_count=$_POST['reads_count'];
	$Read_Length=$_POST['Read_Length'];
	$Index_Number=$_POST['Index_Number'];
	$Index_Position=$_POST['Index_Position'];
	$end=$_POST['end'];
	$Category=$_POST['Category'];
	$ohter_category=$_POST['ohter_category'];
	$Remark=$_POST['Remark'];
	/*$Concentration=$_POST['Concentration'];
	$Volume=$_POST['Volume'];
	$Buffer=$_POST['Buffer'];
	$Average_GC=$_POST['Average_GC'];*/
	$run=$_POST['Run'];
	$Lanes=$_POST['Lanes'];
	$lane_count=$_POST['lane_count'];
	$Avg_Pool=$_POST['Avg_Pool'];

	if($Category=="0"){
		$Category=$ohter_category;
	}

	$value="Run='".$run."',Lanes='".$Lanes."',";
	$value.="Sample_Name='".$Sample_Name."',";
	$value.="lab='".$lab."',";
	$value.="libraries='".$libraries."',";
	$value.="reads_count='".$reads_count."',";
	$value.="Read_Length='".$Read_Length."',";
	$value.="Index_Number='".$Index_Number."',";
	$value.="Index_Position='".$Index_Position."',";
	$value.="end='".$end."',";
	$value.="Category='".$Category."',";
	$value.="Avg_Pool='".$Avg_Pool."',";
	$value.="Remark='".$Remark."'";
	/*$value.="Concentration='".$Concentration."',";
	$value.="Volume='".$Volume."',";
	$value.="Buffer='".$Buffer."',";
	$value.="Average_GC='".$Average_GC."'";*/

	if($Hiseq_Sample_ID!=""){	
		$res=$conn->query("UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
		$res=$conn->query("UPDATE genomics_core.hiseq_sample SET Lanes=$Lanes,lane_count=$lane_count where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");		

		#echo "UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'<br>";
		if (!$res){

			#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
			echo "Sample information update failed.<br>";
			
		}
		else{
		
			#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
			echo "Sample information updated successfully.<br>";
		}
	}

	$err_count=0;$added_count=0;
	for($i=0;$i<10000;$i++){
		$str="Hiseq_Library_ID"."_".$i;
		if($_POST[$str]==""){
			if($i==0){
				echo "No library information updated.<br><br>";	
				exit;
			}
			break;
		}
		$str="Hiseq_Library_ID"."_".$i;
		$Hiseq_Library_ID=$_POST[$str];
		$str="Library_Name"."_".$i;
		$Library_Name=$_POST[$str];
		$str="Project_Type"."_".$i;
		$Project_Type=$_POST[$str];
		$str="Construction_Kit_".$i;
		$Kit=$_POST[$str];
		$str="Conc"."_".$i;
		$Conc=$_POST[$str];
		$str="Volume"."_".$i;
		$Volume=$_POST[$str];
		$str="Buffer"."_".$i;
		$Buffer=$_POST[$str];
		
		$str="I7_Index"."_".$i;
		$I7_Index=explode(' ',$_POST[$str]);
		$I7_No=$I7_Index[0];
		$I7_Seq=$I7_Index[1];
		
		$str="I5_Index"."_".$i;
		$I5_Index=explode(' ',$_POST[$str]);
		$I5_No=$I5_Index[0];
		$I5_Seq=$I5_Index[1];
		
		$str="barcode"."_".$i;
		$barcode=explode(' ',$_POST[$str]);
		$Barcode_No=$barcode[0];
		$Barcode_Seq=$barcode[1];
		
		$value="Library_Name='".$Library_Name."',";
		$value.="Project_Type='".$Project_Type."',";
		$value.="Conc='".$Conc."',";
		$value.="Volume='".$Volume."',";
		$value.="Buffer='".$Buffer."',";
		$value.="Kit='".$Kit."',";
		$value.="I7_No='".$I7_No."',";
		$value.="I7_Seq='".$I7_Seq."',";
		$value.="I5_No='".$I5_No."',";
		$value.="I5_Seq='".$I5_Seq."',";
		$value.="Barcode_No='".$Barcode_No."',";
		$value.="Barcode_Seq='".$Barcode_Seq."'";
		
		$res=$conn->query("UPDATE genomics_core.hiseq_library SET $value where Hiseq_Library_ID='".$Hiseq_Library_ID."'");
		if (!$res){
			$err_count++;
			#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
			#echo "Library information updating faild.<br>";
			
		}
		else{
			$added_count++;	
			#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
			#echo "sample information updating successfully.<br>";
		}
	}

	echo "<br> $added_count libraries updated successfully.<br>";
	echo "<br> $err_count libraries failed to update.<br><br>";
	?>
	</td>
	<td valign="top">
	<?php require("search_hiseq.php");?>
	</td>
  </tr>
</table>

</body>
</html>