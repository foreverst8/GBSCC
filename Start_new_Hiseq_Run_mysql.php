<html>
<head>
<style>
a, a:visited { 
    color:#002A60; text-decoration:none; 
}
body {
	margin-left:20%;
	margin-right:20%;
}
</style>

</head>
<body>

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

<?php 
session_start();?>
<br>

<table width="100%" border="0"  cellspacing="0">
  <tr>
	<td align="left" valign="top">
	<?php require('login.php');?>
	<hr>
	<br>
	<h6>START NEW HISEQ RUN<h6>
	<br>

	<?PHP
	$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
	$permission=$result_user[0]['main'];
	if(count($result_user)==0){
		echo 'You do not have permission to access this page.<br />';	
		exit;
	}
	?>

	<?php
	$conn = db_connect();

	$lane[0]=array();
	$lane[1]=array();
	$lane[2]=array();
	$lane[3]=array();
	$lane[4]=array();
	$lane[5]=array();
	$lane[6]=array();
	$lane[7]=array();
	$run=$_GET['run'];
	echo "<p>Run ID: $run--<br></p>";

	for($i=0;$i<10000;$i++){
		$str="Hiseq_Sample_ID"."_".$i;
		if($_GET[$str]==""){
			if($i==0){
				echo "<p>Please set the lane for the samples to be sequenced.</p><br>";	
				exit;
			}
			break;
		}
		$str="Hiseq_Sample_ID_".$i;
		$Hiseq_Sample_ID=$_GET[$str];
		$str="set_lane_".$i;
		$set_lane=$_GET[$str];
		array_push($lane[$set_lane],$Hiseq_Sample_ID);
	}

	$check=0;
	for($i=0;$i<8;$i++){
		if(count($lane[$i])==0){
			continue;
		}
		else{
			$I7_No_arr=array();
			$I7_Seq_arr=array();
			$I5_No_arr=array();
			$I5_Seq_arr=array();
			$barcode_No_arr=array();
			$barcode_Seq_arr=array();
			#echo "<br>lane $i<br>";
		
			for($ii=0;$ii<count($lane[$i]);$ii++){
				$result_library=search("select * from hiseq_library where Hiseq_Sample_ID='".$lane[$i][$ii]."'");
				for($iii=0;$iii<count($result_library);$iii++){
					if($result_library[$iii]['I7_No']!="."){
						array_push($I7_No_arr,$result_library[$iii]['I7_No']);
					}
					if($result_library[$iii]['I7_Seq']!="."){
						array_push($I7_Seq_arr,$result_library[$iii]['I7_Seq']);
					}
					if($result_library[$iii]['I5_No']!="."){
						array_push($I5_No_arr,$result_library[$iii]['I5_No']);
					}
					if($result_library[$iii]['I5_Seq']!="."){
						array_push($I5_Seq_arr,$result_library[$iii]['I5_Seq']);
					}
					if($result_library[$iii]['Barcode_No']!="."){
						array_push($barcode_No_arr,$result_library[$iii]['Barcode_No']);
					}
					if($result_library[$iii]['Barcode_Seq']!="."){
						array_push($barcode_Seq_arr,$result_library[$iii]['Barcode_Seq']);
					}
		
				}
			}
			
			#print_r($I5_No_arr);echo "<br>";print_r($I5_Seq_arr);echo "<br>";
			
			$I7_No_arr_uni=array_unique($I7_No_arr);
			$I7_Seq_arr_uni=array_unique($I7_Seq_arr);
			$I5_No_arr_uni=array_unique($I5_No_arr);
			$I5_Seq_arr_uni=array_unique($I5_Seq_arr);
			$barcode_No_arr_uni=array_unique($barcode_No_arr);
			$barcode_Seq_arr_uni=array_unique($barcode_Seq_arr);
			
			$repeat_arr_I7_No=array_diff_assoc ( $I7_No_arr, $I7_No_arr_uni );
			$repeat_arr_I7_Seq=array_diff_assoc ( $I7_Seq_arr, $I7_Seq_arr_uni );
			$repeat_arr_I5_No=array_diff_assoc ( $I5_No_arr, $I5_No_arr_uni );
			$repeat_arr_I5_Seq=array_diff_assoc ( $I5_Seq_arr, $I5_Seq_arr_uni );
			$repeat_arr_Barcode_No=array_diff_assoc ( $barcode_No_arr, $barcode_No_arr_uni );
			$repeat_arr_Barcode_Seq=array_diff_assoc ( $barcode_Seq_arr, $barcode_Seq_arr_uni );
			
			$library_name_arr_uni=array_unique($library_name_arr);
			$repeat_arr_library_name=array_diff_assoc ( $library_name_arr, $library_name_arr_uni );
			
			
			if(count($repeat_arr_library_name)>0){
				print_r($repeat_arr_library_name);
				echo "<br>";
				echo "Library name is repeated.<br>";
				$check=1;	
			}
			
			if(count($repeat_arr_I7_No)>0){
				print_r($repeat_arr_I7_No);
				echo "<br>";
				echo "I7 Index No. is repeated.<br>";
				$check=1;	
			}
			
			if(count($repeat_arr_I7_Seq)>0){
				print_r($repeat_arr_I7_Seq);
				echo "<br>";
				echo "I7 Index Seq is repeated.<br>";
				$check=1;	
			}
			if(count($repeat_arr_I5_No)>0){
				print_r($repeat_arr_I5_No);
				echo "<br>";
				echo "I5 Index No. is repeated.<br>";	
				$check=1;
			}
			if(count($repeat_arr_I5_Seq)>0){
				print_r($repeat_arr_I5_Seq);
				echo "<br>";
				echo "I5 Index Seq is repeated.<br>";
				$check=1;	
			}
			
			if(count($repeat_arr_Barcode_No)>0){
				print_r($repeat_arr_Barcode_No);
				echo "<br>";
				echo "Barcode No. is repeated.<br>";
				$check=1;	
			}
			if(count($repeat_arr_Barcode_Seq)>0){
				print_r($repeat_arr_Barcode_Seq);
				echo "<br>";
				echo "Barcode Seq is repeated.<br>";
				$check=1;	
			}
			
			/*if($check==1){
				echo '<br>Problem: there are something wrong in the application.<br /><br>';			
				require('tail.php');
				require('footer.php');
				exit;	
			}*/
		}
	}

	if($check==1){
				echo '<p><br>Something went wrong in the application. Please contact the developer.</p><br>';			
				exit;	
			}

	for($i=0;$i<10000;$i++){
		$str="Hiseq_Sample_ID"."_".$i;
		if($_GET[$str]==""){
			if($i==0){
				echo "<p>Please set the lane for the samples to be sequenced.</p><br>";	
				exit;
				
			}
			break;
		}
		$str="Hiseq_Sample_ID_".$i;
		$Hiseq_Sample_ID=$_GET[$str];
		$str="set_lane_".$i;
		$set_lane=$_GET[$str];
		
		
		#UPDATE `genomics_core`.`hiseq_library` SET `Project_Type`='asdsdf' WHERE `Library_id`='1';
		#echo "UPDATE genomics_core.hiseq_sample SET Run='".$run."',lanes='".$set_lane."' where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'";

		$res=$conn->query("UPDATE genomics_core.hiseq_sample SET Run='".$run."',lanes='".$set_lane."' where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
		if (!$res){
			$err_count++;
			#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
			
		}
		else{
			$added_count++;	
			#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
		}
	}

	echo "<p><br>$added_count samples set to be sequenced successfully.</p>";
	if($err_count>0){
		echo "<p>$err_count Samples set as failed.</p>";	
	}
	echo "<br>";

	echo "<p>Start a new run: <a href=\"Start_new_Hiseq_Run.php\" class=\"button\">Start</a></p>";
	?>
	</td>
    <td align="left" valign="top">
    <?php require("search_hiseq.php");?>
    </td>
  </tr>
</table>

</body>
</html>
