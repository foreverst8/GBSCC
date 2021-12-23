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
li.end {
	margin-left: 50px;
}
</style>
</head>
<body>
<br>

<?php session_start(); ?>
<?php require('login.php');?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
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
		if(val!="0"){
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
<h6>NGS SEQUENCING</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?php  	
	$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
	$permission=$result_user[0]['sangerseq'];
	if(count($result_user)==0){
		#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
		echo 'You do not have permission to access this page.<br />';			
		exit;
	}
   	?>  
      
     </td>
     <td valign="top">
     <?php require("search_hiseq.php");?>
     </td>
  </tr>
</table>

<?php
$Submitter_Name=$_POST['Submitter_Name'];
$Sample_Name=$_POST['Sample_Name'];
$libraries=$_POST['libraries'];
$reads_count=$_POST['reads_count'];
$Read_Length=$_POST['Read_Length'];
$end=$_POST['end'];
$Index_Number=$_POST['Index_Number'];
$Index_Position=$_POST['Index_Position'];
$Avg_Pool=$_POST['Avg_Pool'];
$Category=$_POST['Category'];
$Remark=$_POST['Remark'];
$date=$_POST['date'];
$Conc=$_POST['Conc'];
$Volume=$_POST['Volume'];
$Mode=$_POST['Mode'];

$Remark=mysql_escape_string($Remark);

$check=0;

$I7="";
$I5="";
$barcode="";

$Kit="";

$hiseq_record="";

$result_I7=search("select distinct No,Seq from Index_barcode where Position='I7'");
$result_I5=search("select distinct No,Seq from Index_barcode where Position='I5'");
$result_barcode=search("select distinct No,Seq from Index_barcode where Position='-'");
$result_Kit=search("select distinct Kit from Index_barcode where Position='I7'");

for($ii=0;$ii<count($result_I7);$ii++){
	$I7[$result_I7[$ii]['No']]=$result_I7[$ii]['Seq'];
}
for($ii=0;$ii<count($result_I5);$ii++){
	$I5[$result_I5[$ii]['No']]=$result_I5[$ii]['Seq'];
}
for($ii=0;$ii<count($result_barcode);$ii++){
	$barcode[$result_barcode[$ii]['No']]=$result_barcode[$ii]['Seq'];
}

for($ii=0;$ii<count($result_Kit);$ii++){
	$Kit[$result_Kit[$ii]['Kit']]=$result_Kit[$ii]['Kit'];
}

$Kit["ChrisLabProtocal"]="ChrisLabProtocal";


if(is_uploaded_file($_FILES['sample_file']['tmp_name'])){
	#echo "By file<br><br>";
	$I7_No_arr=array();
	$I7_Seq_arr=array();
	$I5_No_arr=array();
	$I5_Seq_arr=array();
	$barcode_No_arr=array();
	$barcode_Seq_arr=array();
	
	
	$library_name_arr=array();
	  $upfile=$_FILES["sample_file"];  
	  //$name=$upfile["name"]; 
	  $type=$upfile["type"];
	  $size=$upfile["size"];
	  $tmp_name=$upfile["tmp_name"]; //uploaded file tmp location
	  $okType=true;
	  if($okType){ 
		  $error=$upfile["error"]; //uploaded file system value
		  $newfile='../genomics_core/up/tmp/'.date('Y-m-d-H-i-s',time());
		  if(move_uploaded_file($tmp_name,$newfile)){
			  $insert_count=0;
			  require_once './PHPExcel.php'; 
			  function GetData($val){ 
				  $jd = GregorianToJD(1, 1, 1970); 
				  $gregorian = JDToGregorian($jd+intval($val)-25569); 
				  return $gregorian;
			  } 
			  $filePath =$newfile; 
			  $PHPExcel = new PHPExcel(); 
			  $PHPReader = new PHPExcel_Reader_Excel2007(); 
			  if(!$PHPReader->canRead($filePath)){ 
				  $PHPReader = new PHPExcel_Reader_Excel5(); 
				  if(!$PHPReader->canRead($filePath)){ 
					  echo '<p>Not an  Excel file.</p>'; 
					  return ; 
				  } 
			  } 
			  $PHPExcel = $PHPReader->load($filePath);
			  $currentSheet = $PHPExcel->getSheet(0); 
			  $allColumn = $currentSheet->getHighestColumn(); 
			  $allRow = $currentSheet->getHighestRow(); 
			  $i=0;
			  $conn = db_connect();
			  mysqli_query($conn,"SET NAMES GB2312");
			  $error_row=0;
			  $count=0;
			  for($currentRow = 2;$currentRow <= $allRow;$currentRow++){ 
				  $line="";
				  $tmp=0;
				  for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){ 
					  $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();					  
					  $line[$tmp]=iconv('utf-8','gb2312', $val);
					  $tmp++;
				  } 
				  if($line[0]==""){
					  continue;	
				  }
					
				#echo $line[0]."--".$line[1]."--".$line[2]."--".$line[3]."--".$line[4]."--".$line[5]."--".$line[6]."--".$line[7]."--<br>";
				  if(!preg_match("/^[0-9a-zA-Z_]+$/",$line[1])){
					  echo "Error: Library Name should only contain [0-9,a-z,A-Z,_] in Library no. ".($count+1).".<br>";	
					  $error_row++;
				  }
				  if(preg_match("/^\d+$/",$line[1])){
					  echo "Error: Library Name cannot be a pure number in Library no. ".($count+1).".<br>";	
					  $error_row++;
				  }
				  array_push($library_name_arr,$line[1]);
				  
			  	  if(!array_key_exists($line[6],$Kit)){
						echo "<p>Construction Kit is not in the Database.".($count+1).";<br>";
						echo "Please use the following Construction Kits (Case sensitive).<br>";
						echo "If your Kit is not in the list, please contact the Admins (Kaeling, Lakhan, Miao or Niranjan) for help.</p>";
						echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"800\" >";
						echo "<tr><td align=\"center\">";
						foreach($Kit as $key){
							echo "$key,";	
						}
						echo "</td></tr></table>";
						$error_row++;	
				  }
				  
				  
				  if($Index_Number=="0"){
				  		array_push($barcode_No_arr,$line[7]);
						array_push($barcode_Seq_arr,$line[8]);	
		
						if(!array_key_exists($line[7],$barcode)){
							echo "Barcode no. is not in the database in Library ".($count+1).". <a href=\"check_kit.php?Position=-\">Check the Index Database.</a><br>";
							$check=1;	
						}
						if($line[8]!=$barcode[$line[7]]){
							echo "Barcode no.(".$line[7].") and Sequence(".$line[8].") do not match in the Database(".$I7[$line[7]].") in Library no. ".($count+1).".<br>";	
						}
				  }
				  if($Index_Number=="1"){
						
						array_push($I7_No_arr,$line[7]);
						array_push($I7_Seq_arr,$line[8]);	
							
						if(!array_key_exists($line[7],$I7)){
							echo "Error: I7 Index No. is not in the  Database in Library no. ".($count+1).". <a href=\"check_kit.php?Position=I7\">Check the Index Database.</a><br>";
							$check=1;	
						}
						if($line[8]!=$I7[$line[7]]){
							echo "Error: I7 Index No. and Sequence do not match in the Database in Library no. ".($count+1).".<br>";	
						}
				  }
				  if($Index_Number=="2"){
				  		#array_push($I7_No_arr,$line[4]);
						#array_push($I7_Seq_arr,$line[5]);	
	
						if(!array_key_exists($line[7],$I7)){
							echo "Error: I7 Index No. isn't in Database in Library no. ".($count+1).". <a href=\"check_kit.php?Position=I7\">Check the Index Database.</a><br>";
							$check=1;	
						}
						if($line[8]!=$I7[$line[7]]){
							echo "Error: I7 Index No. and Sequence do not match in the Database in Library no. ".($count+1).".<br>";
						}
						
						array_push($I5_No_arr,$line[7]."-".$line[9]);
						array_push($I5_Seq_arr,$line[8]."-".$line[10]);	
	
						if(!array_key_exists($line[9],$I5)){
							echo "Error: I5 Index no. is not in the database in Library no. ".($count+1).". <a href=\"check_kit.php?Position=I5s\">Check the Index Database.</a><br>";
							$check=1;	
						}
						if($line[8]!=$I7[$line[7]]){
							echo "Error: I7 Index no. and Sequence do not match in the database in Library no. ".($count+1).".<br>";
						}
						if($line[10]!=$I5[$line[9]]){
							echo "Error: I5 Index no. and Sequence do not match in the database in Library no. ".($count+1).".<br>";	
						}
				  }
				  
				  
				  if(preg_match("/#/",$line[0])){
					  echo "Error in record no. ".($count+1).". Sample name should not include \"#\".<br>";	
					  $error_row++;
				  }
				  
				  $count++;
			  }
			  
			  if($error_row>0){
				  unlink($filePath);
				  echo "<br>There were $error_row errors. Please do the necessary changes and then upload again.<br><br>";
				  exit;	
			  }
			  
			  
			  	$I7_No_arr_uni=array_unique($I7_No_arr);
				$I7_Seq_arr_uni=array_unique($I7_Seq_arr);
				$I5_No_arr_uni=array_unique($I5_No_arr);
				$I5_Seq_arr_uni=array_unique($I5_Seq_arr);
				$barcode_No_arr_uni=array_unique($barcode_No_arr);
				$barcode_Seq_arr_uni=array_unique($barcode_Seq_arr);
				
				echo "<br>";
				
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
					echo "<p>Some Library names are repeated.<br></p>";
					$check=1;	
				}
				
				if(count($repeat_arr_I7_No)>0){
					print_r($repeat_arr_I7_No);
					echo "<br>";
					echo "<p>Some I7 Index no. are repeated.<br></p>";
					$check=1;	
				}
				
				if(count($repeat_arr_I7_Seq)>0){
					print_r($repeat_arr_I7_Seq);
					echo "<br>";
					echo "<p>Some I7 Index Seq. are repeated.<br></p>";
					$check=1;	
				}
				if(count($repeat_arr_I5_No)>0){
					print_r($repeat_arr_I5_No);
					echo "<br>";
					echo "<p>Some I5 Index no. are repeated.<br></p>";	
					$check=1;
				}
				if(count($repeat_arr_I5_Seq)>0){
					print_r($repeat_arr_I5_Seq);
					echo "<br>";
					echo "<p>Some I5 Index Seq. are repeated.<br></p>";
					$check=1;	
				}
				
				if(count($repeat_arr_Barcode_No)>0){
					print_r($repeat_arr_Barcode_No);
					echo "<br>";
					echo "<p>Some barcodes are repeated.<br></p>";
					$check=1;	
				}
				if(count($repeat_arr_Barcode_Seq)>0){
					print_r($repeat_arr_Barcode_Seq);
					echo "<br>";
					echo "<p>Some barcode seq. are repeated.<br></p>";
					$check=1;	
				}
				
				if($check==1){
					echo '<p><br>There were problems in the application.<br/><br></p>';			
					exit;	
				}
				
				
				$result_check=search("select * from hiseq_sample where Submitter_Name='".$Submitter_Name."' and Sample_Name='".$Sample_Name."'");
				if(count($result_check)>0){
					echo "<p><br>You have already added this Sample into the database.<br/><br></p>";		
					exit;		
				}
		  
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
				
				$Hiseq_Sample_ID="NGS".$Sample_id;
				
				$value="'".$Sample_id."',";
				$value.="'".$Hiseq_Sample_ID."',";
				$value.="'".$Sample_Name."',";
				$value.="'".$result_user[0]['user_name']."',";
				$value.="'".$result_user[0]['lab']."',";
				$value.="'".$libraries."',";
				$value.="'".$reads_count."',";
				
				$value.="'".$Read_Length."',";
				$value.="'".$Index_Number."',";
				$value.="'".$Index_Position."',";
				$value.="'".$end."',";
				$value.="'".$Category."',";
				$value.="'".$Avg_Pool."',";
				$value.="'".$Remark."',";
				$value.="'".$date."',";
				$value.="'".$Conc."',";
				$value.="'".$Volume."',";
				$value.="'".$Mode."',";
				$bioanalyzer_file=".";
				
				$hiseq_record="Submitter_Name:".$result_user[0]['user_name']."<br>";
				$hiseq_record.="Date:".$date."<br>";
				$hiseq_record.="Sample Name:".$Sample_Name."<br>";
				$hiseq_record.="Request Reads Count(M):".$reads_count."<br>";
				$hiseq_record.="Reads Length(bp):".$Read_Length."<br>";
				$hiseq_record.="No. of multiplexed libraries:".$libraries."<br>";
				$hiseq_record.="Index Number:".$Index_Number."<br>";
				$hiseq_record.="Index Position:".$Index_Position."<br>";
				$hiseq_record.="Category:".$Category."<br>";
				$hiseq_record.="Single/Paird-End:".$end."<br>";
				$hiseq_record.="Average Size of the Library Pool:".$Avg_Pool."<br>";
				$hiseq_record.="Concentration of the Library Pool:".$Conc."<br>";
				$hiseq_record.="Volume of the Library Pool:".$Volume."<br>";
				$hiseq_record.="Hiseq/Miseq:".$Mode."<br>";
				$hiseq_record.="Remarks:".$Remark."<br>";
			
				if(is_uploaded_file($_FILES['bioanalyzer_file']['tmp_name'])){
					  $upfile=$_FILES["bioanalyzer_file"];  
					  $type=$upfile["type"];
					  if($type!="application/pdf"){
						  #echo "<br>$type--type<br>";
					  }
					  $size=$upfile["size"];
					  $tmp_name=$upfile["tmp_name"]; //uploaded file tmp location
					  $okType=true;
					  if($okType){ 
						  $error=$upfile["error"]; //uploaded file system value
						  $bioanalyzer_file="../genomics_core/res/hiseq/Bioanalyzer/".$Hiseq_Sample_ID."-".$Sample_Name.".pdf";
						  if(move_uploaded_file($tmp_name,$bioanalyzer_file)){ 
						  }
						  else{
							 
							  	echo "<p><br>Bioanalyzer Result(pdf) upload failed.<br /><br></p>";			
								exit;		
						  } 
					  }
					  else{ 
						  echo "<p>Please upload the file with the .txt format and using tab as the separator</p>"; 
					  } 
				}
				else{
					echo "<p><br>Please upload the Bioanalyzer Result(pdf).<br /><br></p>";			
					exit;		
				}
				
				$value.="'".$bioanalyzer_file."',";
				$value.="'-'";
				
				$sample_value=$value;
				
			  #$name="Library_id,Hiseq_Sample_ID,Hiseq_Library_ID,Library_Name,Project_Type,Kit,I7_No,I7_Seq,I5_No,I5_Seq,Barcode_No,Barcode_Seq,Lane,Run";
			  $name="Library_id,Hiseq_Sample_ID,Hiseq_Library_ID,Library_Name,Project_Type,Conc,Volume,Buffer,Kit,I7_No,I7_Seq,I5_No,I5_Seq,Barcode_No,Barcode_Seq";
			  $count=0;
			  $err_count=0;
			  for($currentRow = 2;$currentRow <= $allRow;$currentRow++){ 
					  
					  $line="";
					  $tmp=0;
					  for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){ 
						  $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();
						  $line[$tmp]=iconv('utf-8','gb2312', $val);
						  $tmp++;
					  } 
	  
					  if($line[0]==""){
						  continue;	
					  }
					  
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
						$value.="'".$Hiseq_Sample_ID."',";
						$value.="'NGSL".$Library_id."',";
					  
					  $value.="'".$line[1]."',";
					  $value.="'".$line[2]."',";
					  $value.="'".$line[3]."',";
					  
					  $value.="'".$line[4]."',";
					  $value.="'".$line[5]."',";
					  $value.="'".$line[6]."',";
					  
					  	$I7_No=".";
						$I7_Seq=".";
						
						$I5_No=".";
						$I5_Seq=".";
						
						$Barcode_No=".";
						$Barcode_Seq=".";
					  
					  if($Index_Number=="0"){
						  	$Barcode_No=$line[7];
							$Barcode_Seq=$line[8];
					  }
					  if($Index_Number=="1"){
						 	$I7_No=$line[7];
							$I7_Seq=$line[8];
					  }
					  if($Index_Number=="2"){
						  	$I7_No=$line[7];
							$I7_Seq=$line[8];
							$I5_No=$line[9];
							$I5_Seq=$line[10];
					  }
						$value.="'".$I7_No."',";
						$value.="'".$I7_Seq."',";
						$value.="'".$I5_No."',";
						$value.="'".$I5_Seq."',";
						$value.="'".$Barcode_No."',";
						$value.="'".$Barcode_Seq."'";
				
					  
					 $res=$conn->query("INSERT INTO genomics_core.hiseq_library($name) VALUES (".$value.")");
					#echo "INSERT INTO genomics_core.hiseq_library($name) VALUES (".$value.")<br>";
					
					if (!$res){
						$err_count++;
						#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
						
					}
					else{
						$added_count++;	
						#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
					}
					  
					  $count++;

			  }
			  
			  if($err_count>0){
				  echo "<p>$err_count library addition failed.<p>";
				  $myquery="delete from genomics_core.hiseq_sample where Hiseq_Sample_ID='$Hiseq_Sample_ID'";
				  $conn = db_connect();
				  mysqli_query($conn,"SET NAMES GB2312");
				  $res=$conn->query($myquery);
				  $res=$conn->query("delete from genomics_core.hiseq_library where Hiseq_Sample_ID='$Hiseq_Sample_ID'");
				  
				  echo "<p><br><br><span style=\"font-size:24px\">Your submission failed, Please rectify the error or contact the Core for help.</span><br></p>";	  
			  }
			  else{
				  
				   	$name="Sample_id,Hiseq_Sample_ID,Sample_Name,Submitter_Name,lab,libraries,reads_count,Read_Length,Index_Number,Index_Position,end,Category,Avg_Pool,Remark,date,Conc,Volume,Mode,bioanalyzer_file,Run";
					$res=$conn->query("INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$sample_value.")");
					#echo "INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$value.")<br>";
					if (!$res){
						echo "<p>Failed to add the sample.<br></p>";
						
						echo '<p><br>Something went wrong with your application.<br/><br></p>';			
						exit;	
						
					}
					else{
						echo "<p>Sample added successfully.</p>";
						
						echo "<span style=\" font-size:18px;color:red\">$added_count Libraries added successfully. ";
						if($err_count>0){
							echo "<p>$err_count libraries could not be added.<p>";	
						}
						echo "</span><br>";
						
					
						$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");
					
						$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
						#$tomail="niranjan_shirgaonkar@gmail.com";
						require('email_CC.php');
						$tomail_arr=explode(',',$tomail);
						
						$Subject="FYI: NGS sequencing submission of ".$_SESSION['username']." from ".$result_user[0]['lab']."  ($Hiseq_Sample_ID).";
						$CC_arr=explode(',',$CC);
												
						if($tomail!=""){
							
							$main_mesg="".$_SESSION['username']." from ".$result_user[0]['lab']." has submitted samples for NGS sequencing. Sample ID is <a href=\"http://161.64.198.12/GBSCC/hiseq_search_result_detial.php?ID=$Hiseq_Sample_ID\">$Hiseq_Sample_ID</a>. You can find the sample information below and on the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>.<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email address. For any queries, please contact the Core Support team.<br><br>";
							
							$main_mesg.=$main_mesg_email;
				
							$main_mesg.="<br><br>Sample information summary:<br><br>".$hiseq_record."<br><br>";
													
							require './PHPMailer-master/PHPMailerAutoload.php';
                            $mail = new PHPMailer;
                            $mail->CharSet = "UTF-8";
                            $mail->IsSMTP();
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = "tls";
                            $mail->Host = "smtp.office365.com";
                            $mail->Port = 587;
                            $mail->Username = "fhs.genomics.core@outlook.com";
                            $mail->Password = "gbscc12345";
                            $mail->SetFrom('fhs.genomics.core@outlook.com', 'fhs.genomics.core');
                            $mail->Subject = $Subject;
                            $mail->MsgHTML($main_mesg);
							
							/*
							require './PHPMailer-master/PHPMailerAutoload.php';
							$mail = new PHPMailer;
							$mail->CharSet    ="UTF-8";                
							$mail->IsSMTP();                       
							$mail->SMTPAuth   = true;            
							$mail->SMTPSecure = "ssl";                
							$mail->Host       = "smtp.gmail.com";      
							$mail->Port       = 465;                
							$mail->Username   = "fhs.genomics.core@gmail.com"; 
							$mail->Password   = "genomicscore";       
							$mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');   
							#$mail->AddReplyTo("miaozhengqiang1987@gmail.com"," ");                                      
							$mail->Subject    = $Subject;                  
							#$mail->AltBody    = ""; 
							$mail->MsgHTML($main_mesg); #                       
							*/
							
							for($i=0;$i<count($tomail_arr);$i++){
								$mail->AddAddress($tomail_arr[$i]);
							}
							for($i=0;$i<count($CC_arr);$i++){
								$mail->AddCC($CC_arr[$i]);
							}
							
							//$mail->AddAttachment("images/phpmailer.gif"); // attachment 
							if(!$mail->Send()) {
								echo "<p>Email Failed.<br></p>" . $mail->ErrorInfo;
							}
							else{
								echo "<p>Email Sent<br><br><br>Sent to: $tomail<br>CC:$CC<br>Record:<br>$hiseq_record<br><br></p>";
							}
						}
					}
					echo "<br>";
				}	
			  unlink($filePath);
			  echo "<p><br><br><a href=\"hiseq.php\">Add New Sample.</a></p>";
			  #}
	  }
	  else{
		  echo "<p>Upload failed<br></p>";
	  }
	  $destination=$newfile;

		  if($error==0){ 
			  //echo "done<br>";
		  }elseif ($error==1){ 
			  echo "<p>Over the file size setted in php.ini.</p>"; 
		  }elseif ($error==2){ 
			  echo "<p>Over MAX_FILE_SIZE</p>"; 
		  }elseif ($error==3){ 
			  echo "<p>Only uploaded a part of the file</p>"; 
		  }elseif ($error==4){ 
			  echo "<p>Could not upload the file.</p>"; 
		  }else{ 
			  echo "<p>size of uploaded file is 0</p>"; 
		  } 
  }
  else{ 
	  echo "<p>Please upload the file with the .txt format and tab as separator</p>"; 
  } 
}
else{
	
	#echo "By web<br><br>";
	$conn = db_connect();
	$I7_No_arr=array();
	$I7_Seq_arr=array();
	$I5_No_arr=array();
	$I5_Seq_arr=array();
	$barcode_No_arr=array();
	$barcode_Seq_arr=array();
	
	$library_name_arr=array();
	
	for($i=1;$i<=$libraries;$i++){
		
		$str="Library_Name_".$i;
		if(!$_POST[$str]){
			echo "<p>Library Name can not be empty in Library $i;<br></p>";
			$check=1;	
		}
		array_push($library_name_arr,$_POST[$str]);
		if(!preg_match("/^[_0-9a-zA-Z]+$/",$_POST[$str])){
			echo "<p>Library Name should be only [0-9,a-z,A-Z,_] in Library $i;<br></p>";
			$check=1;
		}
		if(preg_match("/^\d+$/",$_POST[$str])){
			echo "<p>Library Name cannot be a pure number in Library $i;<br></p>";
			$check=1;
		}
		
		$str="Library_Conc_".$i;
		
		if($_POST[$str] or $_POST[$str]!=""){
			if(!preg_match("/^[0-9.]+$/",$_POST[$str])){
				echo "<p>Concentration of Library Pool(nM) should only be a number in Library $i;<br></p>";
				$check=1;
			}
		}
		
		
		$str="Library_Volume_".$i;
		
		if($_POST[$str] or $_POST[$str]!=""){
			if(!preg_match("/^[0-9.]+$/",$_POST[$str])){
				echo "<p>Volume of the Library Pool(µl) should only be a number in Library $i;<br></p>";
				$check=1;
			}
		}
		
		$str="Library_Buffer_".$i;
	
		if($_POST[$str]=="0"){
			echo "<p>Buffer for Library Pool should be not empty in Library $i;<br></p>";
			$check=1;
		}
		
		$str="Construction_Kit_".$i;
		if(!$_POST[$str]){
			echo "<p>Construction Kit can not be empty in Library $i;<br></p>";
			$check=1;	
		}
		if(!array_key_exists($_POST[$str],$Kit)){
			echo "<p>Constrution Kit is not in the database in Library $i;<br></p>";
			$check=1;	
		}
		
		$str_I7="I7_Index_".$i;
		$str_I5="I5_Index_".$i;
		$str_barcode="barcode_".$i;
		if(!$_POST[$str_I7] and !$_POST[$str_I5] and !$_POST[$str_barcode]){
			echo "<p>Index or Barcode can not be empty in Library $i;<br></p>";
			$check=1;	
		}
		
		if($Index_Number=="1"){
			if($_POST[$str_I7]!=""){
				$str_index=explode(' ',$_POST[$str_I7]);
				array_push($I7_No_arr,$str_index[0]);
				array_push($I7_Seq_arr,$str_index[1]);	
				
					
				if(!array_key_exists($str_index[0],$I7)){
					echo "<p>I7 Index no. is not in the database in Library $i;<br></p>";
					$check=1;	
				}
				if($str_index[1]!=$I7[$str_index[0]]){
					echo "<p>I7 Index no. and Sequence do not match in Database in Library $i;<br></p>";	
				}
			}
		}
		
		if($Index_Number=="2"){
			if($_POST[$str_I7]!=""){
				$str_index2=explode(' ',$_POST[$str_I7]);
				if(!array_key_exists($str_index2[0],$I7)){
					echo "<p>I7 Index no. is not in the database in Library $i;<br></p>";
					$check=1;	
				}
				if($str_index2[1]!=$I7[$str_index2[0]]){
					echo "<p>I7 Index no. and Sequence do not match in the database in Library $i;<br></p>";	
				}
			}
			if($_POST[$str_I5]!=""){
				$str_index=explode(' ',$_POST[$str_I5]);
				array_push($I5_No_arr,$str_index[0]."-".$str_index2[0]);
				array_push($I5_Seq_arr,$str_index[1]."-".$str_index2[1]);
				
				if(!array_key_exists($str_index[0],$I5)){
					echo "<p>I5 Index no. is not in the database in Library $i;<br></p>";
					$check=1;	
				}
				if($str_index[1]!=$I5[$str_index[0]]){
					echo "<p>I5 Index no. and Sequence do not match in the database in Library $i;<br></p>";	
				}
			}	
		}
		
		if($Index_Number=="0"){
			if($_POST[$str_barcode]!=""){
				$str_index=explode(' ',$_POST[$str_barcode]);
				array_push($barcode_No_arr,$str_index[0]);
				array_push($barcode_Seq_arr,$str_index[1]);
				
				if(!array_key_exists($str_index[0],$barcode)){
					echo "<p>Barcode no. is not in the database in Library $i;<br></p>";
					$check=1;	
				}
				if($str_index[1]!=$barcode[$str_index[0]]){
					echo "<p>Barcode no. and Sequence do not match in the database in Library $i;<br></p>";	
				}
			}
		}	
	
	}
	$I7_No_arr_uni=array_unique($I7_No_arr);
	$I7_Seq_arr_uni=array_unique($I7_Seq_arr);
	$I5_No_arr_uni=array_unique($I5_No_arr);
	$I5_Seq_arr_uni=array_unique($I5_Seq_arr);
	$barcode_No_arr_uni=array_unique($barcode_No_arr);
	$barcode_Seq_arr_uni=array_unique($barcode_Seq_arr);
	
	echo "<br>";
	
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
		echo "<p>There are some repeats in the Library name.<br></p>";
		$check=1;	
	}
	
	if(count($repeat_arr_I7_No)>0){
		print_r($repeat_arr_I7_No);
		echo "<br>";
		echo "<p>There are some repeats in the I7 Index no.<br></p>";
		$check=1;	
	}
	
	if(count($repeat_arr_I7_Seq)>0){
		print_r($repeat_arr_I7_Seq);
		echo "<br>";
		echo "<p>There are some repeats in the I7 Index Seq.<br></p>";
		$check=1;	
	}
	if(count($repeat_arr_I5_No)>0){
		print_r($repeat_arr_I5_No);
		echo "<br>";
		echo "<p>There are some repeats in the I5 Index No.<br></p>";	
		$check=1;
	}
	if(count($repeat_arr_I5_Seq)>0){
		print_r($repeat_arr_I5_Seq);
		echo "<br>";
		echo "<p>There are some repeats in the I5 Index Seq.<br></p>";
		$check=1;	
	}
	
	if(count($repeat_arr_Barcode_No)>0){
		print_r($repeat_arr_Barcode_No);
		echo "<br>";
		echo "<p>There are some repeats in the Barcode no.<br></p>";
		$check=1;	
	}
	if(count($repeat_arr_Barcode_Seq)>0){
		print_r($repeat_arr_Barcode_Seq);
		echo "<br>";
		echo "<p>There are some repeats in the Barcode Seq.<br></p>";
		$check=1;	
	}
	
	if($check==1){
		echo '<p><br>Something went wrong in the application.<br /><br></p>';			
		exit;	
	}
	
	
	$result_check=search("select * from hiseq_sample where Submitter_Name='".$Submitter_Name."' and Sample_Name='".$Sample_Name."'");
	if(count($result_check)>0){
		echo "<p><br>You have aleady added this Sample Name into the database.<br /><br></p>";			
		exit;		
	}
	
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
	
	$Hiseq_Sample_ID="NGS".$Sample_id;
	
	$value="'".$Sample_id."',";
	$value.="'".$Hiseq_Sample_ID."',";
	$value.="'".$Sample_Name."',";
	$value.="'".$result_user[0]['user_name']."',";
	$value.="'".$result_user[0]['lab']."',";
	$value.="'".$libraries."',";
	$value.="'".$reads_count."',";
	$value.="'".$Read_Length."',";
	$value.="'".$Index_Number."',";
	$value.="'".$Index_Position."',";
	$value.="'".$end."',";
	$value.="'".$Category."',";
	$value.="'".$Avg_Pool."',";
	$value.="'".$Remark."',";
	$value.="'".$date."',";
	$value.="'".$Conc."',";
	$value.="'".$Volume."',";
	$value.="'".$Mode."',";
	$bioanalyzer_file=".";
	
	$hiseq_record="Submitter_Name:".$result_user[0]['user_name']."<br>";
	$hiseq_record.="Date:".$date."<br>";
	$hiseq_record.="Sample Name:".$Sample_Name."<br>";
	$hiseq_record.="Request Reads Count(M):".$reads_count."<br>";
	$hiseq_record.="Reads Length(bp):".$Read_Length."<br>";
	$hiseq_record.="No. of multiplexed libraries:".$libraries."<br>";
	$hiseq_record.="Index Number:".$Index_Number."<br>";
	$hiseq_record.="Index Position:".$Index_Position."<br>";
	$hiseq_record.="Category:".$Category."<br>";
	$hiseq_record.="Single/Paird end:".$end."<br>";
	$hiseq_record.="Average Size of the Library Pool:".$Avg_Pool."<br>";
	$hiseq_record.="Concentration of the Library Pool:".$Conc."<br>";
	$hiseq_record.="Volume of the Library Pool:".$Volume."<br>";
	$hiseq_record.="Hiseq/Miseq:".$Mode."<br>";
	$hiseq_record.="Remarks:".$Remark."<br>";
	
	if(is_uploaded_file($_FILES['bioanalyzer_file']['tmp_name'])){
		  $upfile=$_FILES["bioanalyzer_file"];  
		  $type=$upfile["type"];
		  if($type!="application/pdf"){
			  echo "<br>$type--type<br>";
		  }
		  $size=$upfile["size"];
		  $tmp_name=$upfile["tmp_name"]; //uploaded file tmp location
		  $okType=true;
		  if($okType){ 
			  $error=$upfile["error"]; //uploaded file system value
			  $bioanalyzer_file="../genomics_core/res/hiseq/Bioanalyzer/".$Hiseq_Sample_ID."-".$Sample_Name.".pdf";
			  if(move_uploaded_file($tmp_name,$bioanalyzer_file)){
				  
				  
			  }
			  else{
				 
				  echo "<p><br>Bioanalyzer Result(PDF) upload failed.<br /><br></p>";			
					exit;		
			  } 
		  }
		  else{ 
			  echo "<p>Please upload a file with the .txt format and tab as a separator</p>"; 
		  } 
	}
	else{
		echo "<p><br>Please upload the Bioanalyzer Result(PDF).<br /><br></p>";			
		exit;		
	}
	
	$value.="'".$bioanalyzer_file."',";
	$value.="'-'";
				
	$sample_value=$value;			
				
	
	$err_count=0;
	
	for($i=1;$i<=$libraries;$i++){
	
		
		$str="Library_Name_".$i;
		$Library_Name=$_POST[$str];
		
		$str="Project_Type_".$i;
		$Project_Type=$_POST[$str];
		
		
		$str="Construction_Kit_".$i;
		$Kit=$_POST[$str];
		
		$str="Library_Conc_".$i;
		$Conc=$_POST[$str];
		
		$str="Library_Volume_".$i;
		$Volume=$_POST[$str];
		
		$str="Library_Buffer_".$i;
		$Buffer=$_POST[$str];
		
		$I7_No=".";
		$I7_Seq=".";
		
		$I5_No=".";
		$I5_Seq=".";
		
		$Barcode_No=".";
		$Barcode_Seq=".";
		
		
		
		$str_I7="I7_Index_".$i;
		$str_I5="I5_Index_".$i;
		$str_barcode="barcode_".$i;
		
		
		if($_POST[$str_I7]){
			$str_index=explode(' ',$_POST[$str_I7]);
			$I7_No=$str_index[0];
			$I7_Seq=$str_index[1];
		}
		
		if($_POST[$str_I5]){
			$str_index=explode(' ',$_POST[$str_I5]);
			$I5_No=$str_index[0];
			$I5_Seq=$str_index[1];
		}
		
		if($_POST[$str_barcode]){
			$str_index=explode(' ',$_POST[$str_barcode]);
			$Barcode_No=$str_index[0];
			$Barcode_Seq=$str_index[1];
		}
		
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
		$value.="'".$Hiseq_Sample_ID."',";
		$value.="'NGSL".$Library_id."',";
		$value.="'".$Library_Name."',";
		$value.="'".$Project_Type."',";
		$value.="'".$Conc."',";
		$value.="'".$Volume."',";
		$value.="'".$Buffer."',";
		$value.="'".$Kit."',";
		$value.="'".$I7_No."',";
		$value.="'".$I7_Seq."',";
		$value.="'".$I5_No."',";
		$value.="'".$I5_Seq."',";
		$value.="'".$Barcode_No."',";
		$value.="'".$Barcode_Seq."'";
	
			
		$name="Library_id,Hiseq_Sample_ID,Hiseq_Library_ID,Library_Name,Project_Type,Conc,Volume,Buffer,Kit,I7_No,I7_Seq,I5_No,I5_Seq,Barcode_No,Barcode_Seq";
		
		$res=$conn->query("INSERT INTO genomics_core.hiseq_library($name) VALUES (".$value.")");
		#echo "INSERT INTO genomics_core.hiseq_library($name) VALUES (".$value.")<br>";
		
		if (!$res){
			$err_count++;
			#echo "Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br>";
			
		}
		else{
			$added_count++;	
			#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
		}
	}
	
	echo "<span style=\" font-size:18px;color:red\">$added_count Libraries added successfully.<br><br>";
	
	if($err_count>0){
		echo "<p>Failed to add $err_count libraries.</p>";
		$myquery="delete from genomics_core.hiseq_sample where Hiseq_Sample_ID='$Hiseq_Sample_ID'";
		$conn = db_connect();
		mysqli_query($conn,"SET NAMES GB2312");
		$res=$conn->query($myquery);
		$res=$conn->query("delete from genomics_core.hiseq_library where Hiseq_Sample_ID='$Hiseq_Sample_ID'");
		
		echo "<p><br><br>Your submission has failed. Please alter the error or contact the Core Tech Support.<br></p>";

	}
	else{
		
		
		$name="Sample_id,Hiseq_Sample_ID,Sample_Name,Submitter_Name,lab,libraries,reads_count,Read_Length,Index_Number,Index_Position,end,Category,Avg_Pool,Remark,date,Conc,Volume,Mode,bioanalyzer_file,Run";
		$res=$conn->query("INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$sample_value.")");
		#
		if (!$res){
			echo "<p>Failed to add sample.<br></p>";
			echo '<p><br>Something went wrong in your application.<br /><br><br></p>';	
			echo "INSERT INTO genomics_core.hiseq_sample($name) VALUES (".$value.")<br>";		
			exit;	
			
		}
		else{
			echo "<p>Sample added Successfully.<br></p>";
		
			$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");
		
			$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
			#$tomail="niranjan.shirgaonkar@gmail.com";
			require('email_CC.php');
										
			$tomail_arr=explode(',',$tomail);
			
			
			$Subject="FYI: NGS sequencing submission of ".$_SESSION['username']." from ".$result_user[0]['lab']."  ($Hiseq_Sample_ID).";
			$CC_arr=explode(',',$CC);
			
			if($tomail!=""){
				
				$main_mesg="Dear Core users,<br><br>".$_SESSION['username']." from ".$result_user[0]['lab']." has submitted samples for NGS sequencing. Sample ID is <a href=\"http://161.64.198.12/GBSCC/hiseq_search_result_detial.php?ID=$Hiseq_Sample_ID\">$Hiseq_Sample_ID</a>. You can find the sample information below and on the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>.<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email address. For any queries, please contact the Core Support team.<br><br>";
				
				$main_mesg.=$main_mesg_email;
				
				$main_mesg.="<br><br>Sample information summary:<br><br>".$hiseq_record."<br><br>";
				
				require './PHPMailer-master/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Host = "smtp.office365.com";
                $mail->Port = 587;
                $mail->Username = "fhs.genomics.core@outlook.com";
                $mail->Password = "gbscc12345";
                $mail->SetFrom('fhs.genomics.core@outlook.com', 'fhs.genomics.core');
                $mail->Subject = $Subject;
                $mail->MsgHTML($main_mesg);
				
				/*
				require './PHPMailer-master/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$mail->CharSet    ="UTF-8";                
				$mail->IsSMTP();                       
				$mail->SMTPAuth   = true;            
				$mail->SMTPSecure = "ssl";                
				$mail->Host       = "smtp.gmail.com";      
				$mail->Port       = 465;                
				$mail->Username   = "fhs.genomics.core@gmail.com"; 
				$mail->Password   = "genomicscore";       
				$mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');    
				#$mail->AddReplyTo("miaozhengqiang1987@gmail.com"," ");                                      
				$mail->Subject    = $Subject;                  
				#$mail->AltBody    = ""; 
				$mail->MsgHTML($main_mesg); #                       
				*/
				
				for($i=0;$i<count($tomail_arr);$i++){
					$mail->AddAddress($tomail_arr[$i]);
				}
				for($i=0;$i<count($CC_arr);$i++){
					$mail->AddCC($CC_arr[$i]);
				}
				
				//$mail->AddAttachment("images/phpmailer.gif"); // attachment 
				if(!$mail->Send()) {
					echo "<p>Email Failed.<br></p>" . $mail->ErrorInfo;
				} else {
					echo "<p>Email Sent.<br><br><br>Sent to: $tomail<br>CC:$CC<br>Record:<br>$hiseq_record</p>";
				}
			}
		}
		echo "<br>";
	
	}
	echo "</span>";
	
	echo "<br><a href=\"hiseq.php\" class=\"button\">Add New Sample.</a>";
	
}
?>

</body>
</html>