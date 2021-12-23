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

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<br>

<?php 
#use PHPMailer\PHPMailer\PHPMailer;
session_start(); ?>
<?php require('login.php');?>
<hr>
<br>
<h6>SANGER SEQUENCING</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?php
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo '<p>You do not have permission to access this page.<br /></p>';			
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
    </td>
    <td valign="top">
    <?php require("search.php");?>
    </td>
  </tr>
</table>
  
<br>

<form action="sangerseq.php" method="get">
<p>How many samples do you want to sequence?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" min="0"/><input class="button" type="submit" />
</form>
<br>
<hr>
<br>

<?php
   	
	$count=0;
	$rr=$_GET['run'];
	$sample_count=$_GET['sample_count'];
	$tmp_name="Sample_name-$count";
		
	$name="run,tmp_id,Sample_name,DNA_type,conc,Size,Primer_type,Submitter,Lab,Email,Date";
	
	#echo $_GET[$tmp_name]."<br>";
	$added_count=0;
	$err_count=0;
	$err_count2=0;
	while($count<$sample_count){
		$tmp_name="Sample_name-$count";
		if(!$_GET[$tmp_name]){
			echo "<p>Error in Record number ".($count+1).". Record name should not be empty.<br></p>";	
			$err_count2++;
			exit;
		}
		
		if(!preg_match("/^[_0-9a-zA-Z]+$/",$_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". Record name should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
			$err_count2++;
			exit;	
		}
	
		
		
		$tmp_name="Primer_type-$count";
		if(!$_GET[$tmp_name]){
			echo "<p>Error in Record number ".($count+1).". Primer type should not be empty.<br></p>";	
			$err_count2++;
			exit;
		}
		
		if(!preg_match("/^[_0-9a-zA-Z]+$/",$_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". Primer Type should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
			$err_count2++;
			exit;	
		}
		
		$tmp_name="conc-$count";
		$value.="'$_GET[$tmp_name]',";
		if(!is_numeric($_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". Conc. should be a numeric value.<br></p>";	
			$err_count2++;
			exit;
		}
		
		$tmp_name="DNA_type-$count";
		$value.="'$_GET[$tmp_name]',";
		if($_GET[$tmp_name]=="0"){
			echo "<p>Error in Record number ".($count+1).". Please select the DNA Type.<br></p>";	
			$err_count2++;
			exit;
		}
		
		if(($_GET[$tmp_name]!="Plasmid") and ($_GET[$tmp_name]!="PCR_Product") and ($_GET[$tmp_name]!="Others")){
			echo "<p>Error in Record number ".($count+1).". Please select \"Plasmid\",\"PCR_Product\" or \"Others\" as your DNA Type.<br></p>";	
			$err_count2++;
			exit;	
		}
		
		
		if(preg_match("/ /",$_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". DNA Type should not include any spaces.(\" \").<br></p>";	
			$err_count2++;
			exit;	
		}
		if(preg_match("/#/",$_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". DNA Type should not include \"#\".<br></p>";	
			$err_count2++;
			exit;	
		}
		
		$tmp_name="Size-$count";
		$value.="'$_GET[$tmp_name]',";
		if(!is_numeric($_GET[$tmp_name])){
			echo "<p>Error in Record number ".($count+1).". Size should be a numeric value.<br></p>";
			$err_count2++;
			exit;	
		}
		
		#$result_ceheck=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
		
		$count++;
	}
	if($err_count2<1){
		$count=0;
	
		$added_count=0;
		$result_num=search("select max(tmp_id) from sangerseq_record where run='$rr'");
		$max_num=$result_num[0]['max(tmp_id)']+1;	
		#echo "select count(tmp_id) from sangerseq_record where run='$rr'<br>";
		$sanger_record="";
		$sanger_record_err="";
		while($count<$sample_count){
			$tmp_name="Sample_name-$count";
			if(!$_GET[$tmp_name]){
				break(1);
			}
			#echo "$count<br>";
			
			$value="";
			$tmp_name="run-$count";
			$value.="'$_GET[$tmp_name]',";
	
			#$tmp_name="tmp_id-$count";
			$value.="'".($max_num+$count)."',";
			$tmp_name="Sample_name-$count";
			#$sanger_record.=$_GET[$tmp_name].",";
			$value.="'$_GET[$tmp_name]',";
			$tmp_name="DNA_type-$count";
			#$sanger_record.=$_GET[$tmp_name].",";
			$value.="'$_GET[$tmp_name]',";
			$tmp_name="conc-$count";
			#$sanger_record.=$_GET[$tmp_name].",";
			$value.="'$_GET[$tmp_name]',";
			$tmp_name="Size-$count";
			#$sanger_record.=$_GET[$tmp_name].",";
			$value.="'$_GET[$tmp_name]',";
			$tmp_name="Primer_type-$count";
			#$sanger_record.=$_GET[$tmp_name]."<br>";
			$value.="'$_GET[$tmp_name]',";
			#$tmp_name="Submitter-$count";
			#$value.="'$_GET[$tmp_name]',";
			#$tmp_name="Lab-$count";
			#$value.="'$_GET[$tmp_name]',";
			#$tmp_name="Email-$count";
			#$value.="'$_GET[$tmp_name]',";
			#$tmp_name="Date-$count";
			#$value.="'$_GET[$tmp_name]'";
			$value.="'".$result_user[0]['user_name']."',";
			$value.="'".$result_user[0]['lab']."',";
			$value.="'".$result_user[0]['email']."',";
			$value.="'".date("Y/m/d")."'";
			
			$conn = db_connect();
			mysqli_query($conn,"SET NAMES GB2312");
			$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
			//echo "INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")<br>";
			if (!$res){
				$err_count++;
				$sanger_record_err.=$value."<br>";
				echo "<p>Error in Sample number ".($count+1).". mysql_1 " . mysql_error()."<br><br>Please contact Genomics Core support: siyunliu@um.edu.mo</p>";
				
			}
			else{
				$added_count++;	
				$sanger_record.=$value."<br>";
				#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
			}
			
			$count++;
		
		}
		
		
		if($err_count>0){
			echo "<p>$err_count records failed. Please contact Genomics Core support: siyunliu@um.edu.mo<br></p>";
		}
		if($added_count>0){
			
			echo "<p style=\"color:red\">This request ($added_count samples) added successfully.</p><br><br>";
			
			$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");
			$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
			require('email_CC.php');
			$CC_arr=explode(',',$CC);			
			$tomail_arr=explode(',',$tomail);
			
						
			$Subject="FYI: Sanger sequencing submission of ".$_SESSION['username']." from ".$result_user[0]['lab']." ($rr).";
			
			if($tomail!=""){
				
			$main_mesg="Dear Core User,<br><br>".$_SESSION['username']." from the ".$result_user[0]['lab']." has submitted samples for Sanger sequencing. Run ID <a href=\"http://161.64.198.12/GBSCC/search_result.php?run=$rr\">$rr</a>. You can find the sample information by clicking <a href=\"http://161.64.198.12/GBSCC/search_result.php?run=$rr\">Core Database</a>.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.";	
			
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
				echo "<p>Request email Failed. Please contact Genomics Core support: siyunliu@um.edu.mo<br></p>" . $mail->ErrorInfo;
				} else {
				echo "<p>Request email sent to: $tomail<br><br>CC: $CC<br></p>";
				}
			}
			
			
		}
	}
?>
   
<script language="javascript" type="text/javascript">
new TableSorter("tb1");
</script>