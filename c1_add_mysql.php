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
<p>How many samples do you want to sequence?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" max="2" min="0"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>
<br><br><hr>

<?php

	$count=0;
	$rr=$_GET['run'];
	$sample_count=$_GET['sample_count'];
	echo "<p>Sample Count: $sample_count<br><br><p>";
	$tmp_name="Sample_name-$count";
		
	$name="run,tmp_id,cell_type,dye,size,viability,chip,Submitter,Lab,Email,Date";

	$added_count=0;
	$err_count=0;
	$err_count2=0;
	
	while($count<$sample_count){
	
	###
	$tmp_name="cell_type-$count";
	if(!$_GET[$tmp_name]){
		echo "<p>Error in Record number ".($count+1).". Cell type should not be empty.<br></p>";	
		$err_count2++;
		exit;
	}
		
	if(!preg_match("/^[_0-9a-zA-Z]+$/",$_GET[$tmp_name])){
		echo "<p>Error in Record number ".($count+1).". Cell Type should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
		$err_count2++;
		exit;	
	}
	
	###
	$tmp_name="dye-$count";
	if(!$_GET[$tmp_name]){
		echo "<p>Error in Record number ".($count+1).". The dye used should not be empty.<br></p>";	
		$err_count2++;
		exit;
	}
		
	if(!preg_match("/^[_0-9a-zA-Z]+$/",$_GET[$tmp_name])){
		echo "<p>Error in Record number ".($count+1).". The dye used should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
		$err_count2++;
		exit;	
	}
	
	###
	$tmp_name="size-$count";
	$value.="'$_GET[$tmp_name]',";
	if(!is_numeric($_GET[$tmp_name])){
		echo "<p>Error in Record number ".($count+1).". Size should be a numeric value.<br></p>";	
		$err_count2++;
		exit;
	}
	
	###
	$tmp_name="viability";
	$value.="'$_GET[$tmp_name]',";
	
	if($_GET[$tmp_name]=="gomya"){
		echo "<p>Error in Record number ".($count+1).". Please select whether viability staining is required.<br></p>";	
		$err_count2++;
		exit;
	}
	
	if(($_GET[$tmp_name]!="yes") and ($_GET[$tmp_name]!="no")){
		echo "<p>Error in Record number ".($count+1).". Please select \"Yes\" or \"No\".<br></p>";	
		$err_count2++;
		exit;
	}

	###
	$tmp_name="chip";
	$value.="'$_GET[$tmp_name]',";
	
	if($_GET[$tmp_name]=="chip"){
		echo "<p>Error in Record number ".($count+1).". Please select which type of chip you would like to use.<br></p>";	
		$err_count2++;
		exit;
	}
	
	if(($_GET[$tmp_name]!="96") and ($_GET[$tmp_name]!="800")){
		echo "<p>Error in Record number ".($count+1).". Please select \"IFC\" or \"HT-IFC\".<br></p>";	
		$err_count2++;
		exit;
	}	
	
	$count++;
	}
	
	if($err_count2<1){
		$count=0;
		
		$added_count=0;
		$result_num=search("select max(tmp_id) from c1 where run='$rr'");
		$max_num=$result_num[0]['max(tmp_id)']+1;	

		$c1="";
		$c1_err="";
		while($count<$sample_count){
			$tmp_name="cell_type-$count";
			if(!$_GET[$tmp_name]){
				break(1);
			}
			#echo "$count<br>";
		
			$value="";
			$tmp_name="run-$count";
			$value.="'$_GET[$tmp_name]',";

			$value.="'".($max_num+$count)."',";
			$tmp_name="cell_type-$count";
			
			$value.="'$_GET[$tmp_name]',";
			$tmp_name="dye-$count";

			$value.="'$_GET[$tmp_name]',";
			$tmp_name="size-$count";

			$value.="'$_GET[$tmp_name]',";
			$tmp_name="viability";

			$value.="'$_GET[$tmp_name]',";
			$tmp_name="chip";			
			
			$value.="'$_GET[$tmp_name]',";

			$value.="'".$result_user[0]['user_name']."',";
			$value.="'".$result_user[0]['lab']."',";
			$value.="'".$result_user[0]['email']."',";
			$value.="'".date("d/m/y")."'";
			
			$conn = db_connect();
			mysqli_query($conn,"SET NAMES GB2312");
			$res=$conn->query("INSERT INTO genomics_core.c1($name) VALUES (".$value.")");
			//echo "INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")<br>";
			if (!$res){
				$err_count++;
				$c1_err.=$value."<br>";
				echo "<p>Error in Sample number ".($count+1).". mysql_1 " . mysql_error()."<br></p>";
				
			}
			else{
				$added_count++;	
				$c1.=$value."<br>";
				#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
			}
			
			$count++;
		
		}
		echo "<p style=\"color:red\">$added_count records added successfully.</p><br><br>";
		if($err_count>0){
			echo "<p>$err_count records failed. Please correct these records and resubmit them.<br></p>";
		}
		if($added_count>0){
			$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");
			
			#$tomail="nshirgaonkar@umac.mo";
			
			$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
			require('email_CC.php');
			
			$tomail_arr=explode(',',$tomail);
			
			$main_mesg="Dear Core user,<br><br>".$_SESSION['username']." from ".$result_user[0]['lab']." has submitted some samples for C1. Run ID <a href=\"http://161.64.198.12/GBSCC/c1.php?run=$rr\">$rr</a>. You can find the sample information below and on the <a href=\"http://161.64.198.12/GBSCC/c1.php?run=$rr\">Core Database</a>.<br>"."<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.";

			$main_mesg.="<br>$added_count samples successfully submitted.<br><br>Sample information:<br><br>Run,No.,Cell Type,Dye,Size,Viability,Chip,Submitter,Lab,Email,Date<br>".$c1."<br>";
			
			if($err_count>0){
				$main_mesg.="$err_count samples failed.<br>".$c1_err."<br>";	
			}
			$main_mesg.="<br>";
			
			$Subject="FYI: C1 submission of ".$_SESSION['username']." from ".$result_user[0]['lab']." ($rr).";
			$CC_arr=explode(',',$CC);
			
			if($tomail!=""){
				
			$main_mesg="".$_SESSION['username']." from the ".$result_user[0]['lab']." has submitted some samples for C1. Run ID <a href=\"http://161.64.198.12/GBSCC/c1.php?run=$rr\">$rr</a>. You can find the sample information below and on the <a href=\"http://161.64.198.12/GBSCC/c1.php?run=$rr\">Core Database</a>.<br>"."<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>$added_count samples successfully submitted.<br><br>Sample information:<br><br>Run,No.,Cell Type,Dye,Size,Viability,Chip,Submitter,Lab,Email,Date<br>".$c1."<br>";
			
			$main_mesg.=$main_mesg_email;

			
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
			$mail->MsgHTML($main_mesg);
			
			
			
			for($i=0;$i<count($tomail_arr);$i++){
				$mail->AddAddress($tomail_arr[$i]);
			}
			for($i=0;$i<count($CC_arr);$i++){
				$mail->AddCC($CC_arr[$i]);
			}
					
			//send the message, check for errors
			if(!$mail->Send()) {
				echo "<p>Email Failed.<br></p>" . $mail->ErrorInfo;
				} else {
				echo "<p>Email Sent.<br></p>";
				}
			}
		}
	}
?>
   
<script language="javascript" type="text/javascript">
new TableSorter("tb1");
</script>