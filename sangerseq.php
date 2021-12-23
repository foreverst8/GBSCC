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
input[type="file"] {
    display: none;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    function myFunction(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: '<span style="color:red">Please Note</span>',
            width: 700,
            html: '<b>If the total submission per submission day is <span style="color:red">less than 7 samples,</span> they will be processed in the next round in order for it to be more cost-effective as we are running the samples at cost price.</b>',
        }) .then((result) => {
            if (result.isConfirmed) {
                document.getElementById("sangerseq").submit();
            }
        })
    }
</script>



<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>SANGER SEQUENCING INSTRUCTION</h6>
<br>
<p><span style="color:red;font-size:19px"><b>Please Note:</span></b> If the total submission per submission day is <span style="color:red"><b><u>less than 7 samples</u></b></span>, they will be processed in the next round in order for it to be more cost-effective as we are running the samples at cost price.</p>
<br><br><hr><br>
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
	<li> For sample preparation, please refer to the Sanger sample preparation instructions: <a class="button" href="sanger_sample_preparation.php">Click</a>.</li><br>
	<li> <span style="color:red">Price</span> for Sanger Sequencing is <span style="color:red">33 MOP</span> per Reaction.</li><br>
	<li> For submission of sample names, please <span style="color:red">DO NOT use special characters</span> such as space(" "), hash("#"), hyphen("-") or asterisk("*"). The database only allows characters like "a-z,A-Z,0-9,_,."</li><br>
	<li>
        For submission:<br>
        <ol>
            <li>Submit the samples information via the "sample submission" form online.</li>
            <li>Place the samples in a bag with your name and lab in the <span style="color:red">4 degrees fridge</span> under the pH meter at <span style="color:red">N22-3009</span> in the shelf "Genomics Core" before the submission time.</li>
            <font size="2">*If it is a <span style="color:red">public holiday</span>, the collection day will be on <span style="color:red">the next working day.</span></font>
        </ol>
    </li><br>
    <li>
        Collection time:<br>
        <ol>
            <li>Monday (2 p.m.)</li>
            <li>Thursday (10 a.m)</li>
        <font size="2">*Note: any samples placed after the time will be processed in the next round.</font>
        </ol>
    </li>
	</ul>
	</td>
    <td valign="top">
    <?php require("search.php");?>
    </td>
  </tr>
</table>

<br><hr><br>

<form id="sangerseq" action="sangerseq.php" method="get">
<p>How many samples do you want to sequence?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" min="0"/>&nbsp;&nbsp;<input class="button" onclick="myFunction(event)" type="submit" />
</form>

<form name="sangerfile" action="sangerseq.php" method="post" enctype="multipart/form-data">
<p>Or upload from file*&nbsp;&nbsp;</p>
<label for="txt_file" class="button">Choose File</label>
<input name="txt_file" id="txt_file" type="file"/>
<input class="button" value="Attach" type="submit" onclick="javascript:{this.disabled=true;document.sangerfile.submit()}"/>
</p>
<br><br>

<p style="font-size:12px">*Please fill up this excel file <a href="./files/sanger_sequencing_upload_file.xlsx"><span style="color:red">Sanger_sequencing_upload_file.xlsx</span></a>,upload it and click Attach.</p>

</form>
<br><br><br>

<?php

   	$startdate = strtotime("today");
    $rr="SSR";
    $rtmp=str_pad(rand(1, 99), 2, "0", STR_PAD_LEFT);
    $rr.=date("ymd", $startdate);
    $rr.=$rtmp;
	
	if($sample_count>0){
		
		#echo "select count(tmp_id) from sangerseq_record where run='$rr'<br>";
		$result_num=search("select max(tmp_id) from sangerseq_record where run='$rr'");
		$max_num=$result_num[0]['max(tmp_id)']+1;	
	
		$table_col_name=array("Sample_name","DNA_type","conc","Size","Primer_type");
		
		echo "<hr><br>";
		echo "<p>Number of samples for sequencing is $sample_count.</p><br><br>";
		
		echo "<form name=\"sanger\" action=\"sangerseq_add_mysql.php\" method=\"get\">";
		echo "<input type=\"hidden\" name=\"run\" value=\"$rr\">";
		echo "<input type=\"hidden\" name=\"sample_count\" value=\"$sample_count\">";
		echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
		echo "<tr align=\"center\">";
		echo "<td rowspan=\"2\" width=\"100px\">Run</td>";
		#echo "<td rowspan=\"2\" width=\"40px\">No.</td>";
		echo "<td colspan=\"4\" width=\"600px\">DNA Template</td>";
		echo "<td rowspan=\"2\" width=\"100px\">Primer Type</td>";	
		#echo "<td rowspan=\"2\" width=\"100px\">Submitter's Name</td>";	
		#echo "<td rowspan=\"2\" width=\"200px\">Lab</td>";
		#echo "<td rowspan=\"2\" width=\"100px\">Email</td>";
		#echo "<td rowspan=\"2\" width=\"100px\">Date</td>";	
		echo "</tr>";
		echo "<tr align=\"center\">";
		echo "<td width=\"290px\">Sample Name</td>";
		echo "<td width=\"100px\">DNA Type</td>";
		echo "<td width=\"100px\">Conc. (ng/&micro;L)</td>";
		echo "<td width=\"80px\">Size (bp)</td>";
		echo "</tr>";
		for($i=0;$i<$sample_count;$i++){
			echo "<tr align=\"center\">";
			
			echo "<td>";
			echo "<input type=\"hidden\" value=\"".$rr."\" name=\"run-".$i."\" />$rr";
			echo "</td>";
			
			#echo "<td>";
			#echo "<input type=\"hidden\" value=\"".($max_num+$i)."\" name=\"tmp_id-".$i."\" />".($max_num+$i);
			#echo "</td>";
			
			
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[0]."-".$i."\" size=\"43\"/>";
			echo "</td>";
			echo "<td>";
			//echo "<input type=\"text\" name=\"".$table_col_name[1]."-".$i."\" size=\"14\"/>";
			echo "<select name=\"".$table_col_name[1]."-".$i."\">";
			echo "<option value=\"0\" selected=\"selected\">Select DNA Type</option>";
			echo "<option value=\"Plasmid\">Plasmid</option>";
			echo "<option value=\"PCR_Product\">PCR_Product</option>";
			echo "<option value=\"Others\">Others</option>";
			echo "</select>";
			
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[2]."-".$i."\" size=\"14\"/>";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[3]."-".$i."\" size=\"11\"/>";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"".$table_col_name[4]."-".$i."\" size=\"14\"/>";
			echo "</td>";
	
			#echo "<td>";
			#echo "<input type=\"hidden\" value=\"".$result_user[0]['user_name']."\" name=\"Submitter-".$i."\" />".$result_user[0]['user_name'];
			#echo "</td>";
			
			#echo "<td>";
			#echo "<input type=\"hidden\" value=\"".$result_user[0]['lab']."\" name=\"Lab-".$i."\" />".$result_user[0]['lab'];
			#echo "</td>";
			
			#echo "<td>";
			#echo "<input type=\"hidden\" value=\"".$result_user[0]['email']."\" name=\"Email-".$i."\" />";
			#echo "<a href=\"mailto:".$result_user[0]['email']."\">".$result_user[0]['email']."</a>";
			#echo "</td>";
			
			#echo "<td>";
			#echo "<input type=\"hidden\" value=\"".date("d/m/y")."\" name=\"Date-".$i."\" />".date("d/m/y");
			#echo "</td>";
			
			echo "</tr>";	
		}
		
		echo "</table>";
		echo "<br><input class=\"button\" type=\"submit\" onclick=\"javascript:{this.disabled=true;document.sanger.submit()}\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
		echo "</form>";
		
	}
		
		 if(is_uploaded_file($_FILES['txt_file']['tmp_name'])){ 
						
						$upfile=$_FILES["txt_file"];  
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
										echo 'no Excel'; 
										return ; 
									} 
								} 
								
								#if($PHPExcel = $PHPReader->load($filePath)){
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
											
											
											if(!preg_match("/^[_0-9a-zA-Z]+$/",$line[0])){
												echo "<p>Error in record number ".($count+1).": Sample name should not include any special characters. The only allowed characters are \"a-z,A-Z,0-9,_\".<br></p>";
												$error_row++;
											
											}
											if(preg_match("/#/",$line[0])){
												echo "<p>Error in record number ".($count+1).": Sample name should not include \"#\".<br></p>";	
												$error_row++;
										
											}
	
											
											if(($line[1]!="Plasmid") and ($line[1]!="PCR_Product") and ($line[1]!="Others")){
												echo "<p>Error in record number ".($count+1).": Please select \"Plasmid\",\"PCR_Product\" or \"Others\" as your DNA Type.<br></p>";	
												$error_row++;
								
											}
											
											if(!is_numeric($line[2])){
												echo "<p>Error in record number ".($count+1).": Concentration should be numeric.<br></p>";	
												$error_row++;
											}
											
						
											if(!is_numeric($line[3])){
												echo "<p>Error in record number ".($count+1).": Size should be numeric.<br></p>";
												$error_row++;
											
											}
										
									
											if(!preg_match("/^[_0-9a-zA-Z]+$/",$line[4])){
												echo "<p>Error in record number ".($count+1).": Primer Type should not include any special characters. The only allowed characters are \"a-z,A-Z,0-9,_\".<br></p>";
												$error_row++;	
							
											}
										
											if($line[4]==""){
												echo "<p>Error in record number ".($count+1).": Primer Type should not be empty.<br></p>";	
												$error_row++;
								
											}
											$count++;
			
									}
									
									if($error_row>0){
										unlink($filePath);
										echo "<p><br>There are $error_row errors, please rectify them and submit again.<br><br></p>";
										exit;	
									}
									else{
										$name="run,tmp_id,Sample_name,DNA_type,conc,Size,Primer_type,Submitter,Lab,Email,Date";
									
										$err_count=0;
										$added_count=0;
										$result_num=search("select max(tmp_id) from sangerseq_record where run='$rr'");
										$max_num=$result_num[0]['max(tmp_id)']+1;	
										$count=0;
										$sanger_record="";
										$sanger_record_err="";
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
												
												/*$sanger_record.="$rr,";
												$sanger_record.=$line[0].",";
												$sanger_record.=$line[1].",";
												$sanger_record.=$line[2].",";
												$sanger_record.=$line[3].",";
												$sanger_record.=$line[4]."<br>";*/
												
												$value="'$rr',";
												$value.="'".($max_num+$count)."',";
												
												$value.="'".$line[0]."',";
												$value.="'".$line[1]."',";
												$value.="'".$line[2]."',";
												$value.="'".$line[3]."',";
												$value.="'".$line[4]."',";
												
												
												$value.="'".$result_user[0]['user_name']."',";
												$value.="'".$result_user[0]['lab']."',";
												$value.="'".$result_user[0]['email']."',";
												$value.="'".date("d/m/y")."'";
												
												$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
												#echo "INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")<br>";
												if (!$res){
													$err_count++;
													$sanger_record_err.=$value."<br>";
													echo "<p>Error in the ".($count+1)."th record: mysql_1 " . mysql_error()."<br></p>";
													
												}
												else{
													$added_count++;	
													$sanger_record.=$value."<br>";
													#$res=$conn->query("INSERT INTO genomics_core.sangerseq_record($name) VALUES (".$value.")");
												}
												
												$count++;
			
										}
																				
										
										if($err_count>0){
											echo "<p>$err_count records failed. Please correct these records and resubmit them.<br></p>";
										}
										if($added_count>0){
											
											echo "<p style=\"color:red\">This request ($added_count samples) added successfully.</p><br><br>";
											
											$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");												
											$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
											require('email_CC.php');										
											$tomail_arr=explode(',',$tomail);
											
											$main_mesg="Dear Core user,<br><br>".$_SESSION['username']." from ".$result_user[0]['lab']." has submitted samples for sanger sequencing. The Run ID is <a href=\"http://161.64.198.12/GBSCC/search_result.php?run=$rr\">$rr</a>. You can find the sample information below and on the <a href=\"http://161.64.198.12/GBSCC/search_result.php?run=$rr\">Core Database</a>.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core database</a>. Please do not reply to this email address. For any queries, please contact the Core Support team.";
											
											$main_mesg.="<br><br>Sample information:<br><br>Sample Name,DNA Type,Conc. (ng/&micro;L),Size (bp),Primer Type<br>$added_count samples Successfully<br>".$sanger_record."<br>";
											if($err_count>0){
												$main_mesg.="$err_count samples failed<br>".$sanger_record_err."<br>";	
											}
											$main_mesg.="<br>";
											
											$Subject="FYI: Sanger sequencing submission of ".$_SESSION['username']." from ".$result_user[0]['lab']." ($rr).";
											$CC_arr=explode(',',$CC);
											
											if($tomail!=""){
												
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
												$mail->MsgHTML($main_mesg); #                       

												
												for($i=0;$i<count($tomail_arr);$i++){
													$mail->AddAddress($tomail_arr[$i]);
												}
												for($i=0;$i<count($CC_arr);$i++){
													$mail->AddCC($CC_arr[$i]);
												}
												
												//$mail->AddAttachment("images/phpmailer.gif"); // attachment 
												if(!$mail->Send()) {
													echo "<p>Request email failed. Please contact Genomics Core support: siyunliu@um.edu.mo<br></p>" . $mail->ErrorInfo;
												} else {
													echo "<p>Request email sent to: $tomail<br><br>CC: $CC<br></p>";
												}
											}
										}
										
										unlink($filePath);
									}
									
								#}
						}
							else{
								echo "<p>Upload failed.<br></p>";	
							}
							$destination=$newfile;
					
								if($error==0){ 
									//echo "done<br>";
								}elseif ($error==1){ 
									echo "<p>Over the file size set in php.ini.</p>"; 
								}elseif ($error==2){ 
									echo "<p>Over MAX_FILE_SIZE<p>"; 
								}elseif ($error==3){ 
									echo "<p>Only upload a part of the file.</p>"; 
								}elseif ($error==4){ 
									echo "<p>Did not upload!</p>"; 
								}else{ 
									echo "<p>Size of the uploaded file is 0.</p>"; 
								} 
						}
						else{ 
							echo "<p>Please upload the file in the .txt format and tab as separator.</p>"; 
						} 
}
?> 
   
</body>
</html>