<?php 
session_start(); 
require('header.php');
#$conn = db_connect();
?>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.editable-select.min.js"></script>

<script type="text/javascript"> 
       
	   function check_count(){ 
         var v1=document.getElementById("request_count").value;
		 if(v1>10){
			alert("Request Sample Count can't be more than 10.");
			document.getElementById("request_count").focus();
			return false;	
		 }
       }
	   
	  
</script>
   
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<table width="100%" border="0"  cellspacing="0" bgcolor="#FFFFCC">
  <tr>
    <td width="200" rowspan="3" valign="top" bgcolor="#669999">
    <?php  require('side.php') ?>
    <?php require('db_cancer.php')?>
    
    </td>
    <td  valign="top"  width="4"> </td>
    <td  valign="top" ></td>
    
   
  </tr>
  <tr>
  	<td  valign="top"  width="4"> </td>
    <td align="left" valign="top">
   <?php require('login.php');?> 
    
    <table border="0" cellspacing="0">
      <tr><td width="650">
    <p><br>
    >>Reagent Resquest<br></p>
     <?PHP
	  	
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'Problem: You have no permission to access the page.<br />';			
			require('tail.php');
			require('footer.php');
			exit;
		}
	
   	?>  
      
     <?php require "reagent_notice.php"?>	
     					
      </td>
      <td valign="top">
      <?php #require("search_reagent.php");?>
      </td>
      <td>&nbsp;
      
      </td>
      </tr>
      </table>
      <p>&nbsp;</p>
      <p><span style="color:red; font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;** This website is under trial, please keep a record for reference. **</span></p>
    <span style="font-size:15px"><b>Request Form</b></span><br><br>
    <?php
	
	
	
	if(!$_GET['Submitter_Name']){
		$_SESSION['resubmit']=1;
		
    	echo "<form action=\"reagent_share.php\" method=\"get\">";
		
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"800\">";
		echo "<tr align=\"center\"/>";
		echo "<td width=\"10%\">";
		echo "Submitter_Name:";
		echo "</td>";
		echo "<td>";
		echo $result_user[0]['user_name'];
		echo "<input type=\"hidden\" name=\"Submitter_Name\" value=\"".$result_user[0]['user_name']."\"/>";
		echo "</td>";
		echo "<td>";
		echo "Lab:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo $result_user[0]['lab'];
		echo "</td>";
		echo "<td>";
		echo "Date:";
		echo "</td>";
		echo "<td>";
		echo date("d/m/y");
		echo "<input type=\"hidden\" name=\"date\" value=\"".date("y_m_d")."\"/>";
		#echo "<input type=\"hidden\" name=\"email\" value=\"".$result_user[0]['email']."\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"800\">";
		echo "<tr valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "<b>Request DNA Sample Count</b>: ";
		
		echo "<input name=\"request_count\" id=\"request_count\" type=\"number\" min=\"0\" max=\"10\" style=\"width:80px\">";
		echo "</td>";
		
		echo "<td align=\"center\" >How many days for keeping the request: </b>: ";
		echo "<input name=\"request_day\" id=\"request_day\" type=\"number\" min=\"0\" value=\"7\" max=\"30\" style=\"width:80px\">";
		echo "</td>";
		#echo "<td align=\"center\" >";
		#echo "Remark<br><span style=\"color:gray;font-size:12px\">*If need</span></td>";
		#echo "<td align=\"left\" colspan=\"2\"><textarea id=\"Remark\" name=\"Remark\" rows=\"3\" style=\"width200px\"></textarea></td>";
		echo "</tr>";
		echo "</table>";
		echo "<span style=\"color:red;font-size:12px\">&nbsp;&nbsp;* Days for keeping the request:</span><span style=\"font-size:12px\">request would be delete after that days</span><br><br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" value=\"Reset\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Submit\" onclick=\"return check_count()\"/>";
		echo "</form><br><br>";


		echo "<span style=\"font-size:15px\"><b>Request State</b></span><br><br>";
		
		
		
		
		
		$Submitter_Name=$_GET['Submitter_Name'];
		$request_count=$_GET['request_count'];
		$Date=date("y_m_d");
		$function=$_GET['function'];
		$remark=$_GET['Remark'];
		$request_day=$_GET['request_day'];
		
		$Date_today=date("y-m-d");
		$result_share_reagent=search("select * from share_reagent_request where state='Open'");
		#echo "select * from share_reagent_request where state='Open'<br>";
		$conn = db_connect();
		for($i=0;$i<count($result_share_reagent);$i++){
			$date_tmp=explode("/",$result_share_reagent[$i]['Date']);
			$date_tmp="$date_tmp[2]-$date_tmp[1]-$date_tmp[0]";
			#echo "$Date_today--".strtotime($Date_today)."--$date_tmp--".strtotime($date_tmp)."--".($result_share_reagent[$i]['request_day']*3600*24)."--".$result_share_reagent[$i]['request_day']."<br>";
			if(strtotime($Date_today)-strtotime($date_tmp)>$result_share_reagent[$i]['request_day']*3600*24){
					
					
					#echo "UPDATE genomics_core.share_reagent_request SET state='Closed' where share_reagent_request_id='".$result_share_reagent[$i]['share_reagent_request_id']."'<br>";
					$res_tmp=$conn->query("UPDATE genomics_core.share_reagent_request SET state='Closed' where share_reagent_request_id='".$result_share_reagent[$i]['share_reagent_request_id']."'");
					
			}
		}
		
		
		$result_share_reagent=search("select * from share_reagent_request where state='Open'");
		
		
		
		
		if(count($result_share_reagent)>0){
			
			echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"800\">";
			echo "<tr valign=\"middle\" align=\"center\">";
			echo "<td>Order</td>";
			echo "<td>SRR_ID</td>";
			echo "<td>Request Days</td>";
			echo "<td>Submitter_Name</td>";
			echo "<td>Lab</td>";
			echo "<td>Date</td>";
			echo "<td>State</td>";
			echo "<td>Option</td>";
			echo "</tr>";
			
			for($i=0;$i<count($result_share_reagent);$i++){
				echo "<tr valign=\"middle\" align=\"center\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$result_share_reagent[$i]['SRR_ID']."</td>";	
				echo "<td>".$result_share_reagent[$i]['request_day']."</td>";
				echo "<td>".$result_share_reagent[$i]['Submitter_Name']."</td>";
				echo "<td>".$result_share_reagent[$i]['lab']."</td>";
				echo "<td>".$result_share_reagent[$i]['Date']."</td>";
				echo "<td>".$result_share_reagent[$i]['state']."</td>";
				if($result_share_reagent[$i]['Submitter_Name']==$_SESSION['username'] or $result_user[0]['main']=='y'){
					echo "<td><a href=\"delete_shared_request.php?id=".$result_share_reagent[$i]['SRR_ID']."&database=share_reagent_request\"><input type=\"button\" value=\"DELETE\"></a></td>";
				}
				else{
					echo "<td>&nbsp;</td>";	
				}
				echo "</tr>";
			}
			echo "</table>";
			
			
			
			
		}
		else{
				
		}
	}
	else
	{
	if($_SESSION['resubmit']==1){
		$_SESSION['resubmit']++;
		$Submitter_Name=$_GET['Submitter_Name'];
		$request_count=$_GET['request_count'];
		$Date=date("y_m_d");
		$function=$_GET['function'];
		$remark=$_GET['Remark'];
		$request_day=$_GET['request_day'];
		
		$Date_today=date("y-m-d");
		$result_share_reagent=search("select * from share_reagent_request where state='Open'");
		$conn = db_connect();
		
		for($i=0;$i<count($result_share_reagent);$i++){
			$date_tmp=explode("/",$result_share_reagent[$i]['Date']);
			$date_tmp="$date_tmp[2]-$date_tmp[1]-$date_tmp[0]";
			#echo "$Date_today--".strtotime($Date_today)."--$date_tmp--".strtotime($date_tmp)."--".($result_share_reagent[$i]['request_day']*3600*24)."--".$result_share_reagent[$i]['request_day']."<br>";
			if(strtotime($Date_today)-strtotime($date_tmp)>$result_share_reagent[$i]['request_day']*3600*24){
					
					$res_tmp=$conn->query("UPDATE genomics_core.share_reagent_request SET state='Closed' where share_reagent_request_id='".$result_share_reagent[$i]['share_reagent_request_id']."'");
					
			}
		}
		
		
		$result_tmp=search("select max(share_reagent_request_id) from genomics_core.share_reagent_request");
	
		if($result_tmp[0]['max(share_reagent_request_id)']==""){
			$result_tmp[0]['max(share_reagent_request_id)']=0;	
		}
		
		$name="share_reagent_request_id,SRR_ID,request_day,Submitter_Name,lab,Date,remark";
		$conn = db_connect();
		
		for($j=0;$j<$request_count;$j++){
			$SRR_ID="SRRID".($result_tmp[0]['max(share_reagent_request_id)']+$j+1);
		
			$value="'".($result_tmp[0]['max(share_reagent_request_id)']+$j+1)."','$SRR_ID','$request_day','$Submitter_Name','".$result_user[0]['lab']."','$Date','$remark'";
			
			
			
			$res=$conn->query("INSERT INTO genomics_core.share_reagent_request($name) VALUES (".$value.")");

			if (!$res){
				echo "Error: Request Faild.<br>INSERT INTO genomics_core.share_reagent_request($name) VALUES ($value)";
			}
		
		}
		
		
		$result_share_reagent=search("select * from share_reagent_request where state='Open'");
		
		
		if(count($result_share_reagent)<11){
			echo "<span style=\"color:red\">";
			echo "<br>Remained <b style=\"font-size:18px\">".count($result_share_reagent)."</b> samples are waiting<br><br>";
			echo "</span>";
			echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"800\">";
			echo "<tr valign=\"middle\" align=\"center\">";
			echo "<td>Order</td>";
			echo "<td>SRR_ID</td>";
			echo "<td>Request Days</td>";
			echo "<td>Submitter_Name</td>";
			echo "<td>Lab</td>";
			echo "<td>Date</td>";
			echo "<td>State</td>";
			echo "<td>Option</td>";
			echo "</tr>";
			
			for($i=0;$i<count($result_share_reagent);$i++){
				echo "<tr valign=\"middle\" align=\"center\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$result_share_reagent[$i]['SRR_ID']."</td>";
				echo "<td>".$result_share_reagent[$i]['request_day']."</td>";	
				echo "<td>".$result_share_reagent[$i]['Submitter_Name']."</td>";
				echo "<td>".$result_share_reagent[$i]['lab']."</td>";
				echo "<td>".$result_share_reagent[$i]['Date']."</td>";
				echo "<td>".$result_share_reagent[$i]['state']."</td>";
				if($result_share_reagent[$i]['Submitter_Name']==$_SESSION['username'] or $result_user[0]['main']=='y'){
					echo "<td><a href=\"delete_shared_request.php?id=".$result_share_reagent[$i]['SRR_ID']."&database=share_reagent_request\"><input type=\"button\" value=\"DELETE\"></a></td>";
				}
				else{
					echo "<td>&nbsp;</td>";	
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "";
			
			
		}
		else{
			
			
			
			$request_user=array($result_share_reagent[0]['Submitter_Name'],$result_share_reagent[1]['Submitter_Name'],$result_share_reagent[2]['Submitter_Name'],$result_share_reagent[3]['Submitter_Name'],$result_share_reagent[4]['Submitter_Name'],$result_share_reagent[5]['Submitter_Name'],$result_share_reagent[6]['Submitter_Name'],$result_share_reagent[7]['Submitter_Name'],$result_share_reagent[8]['Submitter_Name'],$result_share_reagent[9]['Submitter_Name'],$result_share_reagent[10]['Submitter_Name']);
			
			
			$select_user="";
			$select_user_email="";
			$select_user_lab="";
			
			$request_user_count=array_count_values($request_user);
			
			foreach ( $request_user_count as $k => $v){
				if($v==max(array_count_values($request_user))){
					$select_user=$k;
					break;
				}
			}
			
			
			echo "<span style=\"color:red\">";
			echo "<br><br>Your have <b style=\"font-size:18px\">".$request_user_count[$result_user[0]['user_name']]."</b>. samples pass the DNA share request successfully.<br><br>";
			echo "</span>";
			echo "New Combination Request:<br>";
			$Remark_comb="Combination Request detail:<br>";
			$comb_email="";
			$comb_user="";
			$comb_user2="";
			foreach ( $request_user_count as $k => $v){
				echo "$k: $v samples<br>";
				
				$result_lab_tmp=search("select * from user,lab where user.lab=lab.lab_name and user.user_name='$k'");
				$Remark_comb=$Remark_comb."$k from ".$result_lab_tmp[0]['lab']." : $v samples<br>";
				$comb_email=$comb_email.$result_lab_tmp[0]['email'].",".$result_lab_tmp[0]['director_email'].",";
				$comb_user=$comb_user."$k from ".$result_lab_tmp[0]['lab'].",";
				$comb_user2=$comb_user2."$k, ";
				if($k==$select_user){
					$select_user_email=$result_lab_tmp[0]['email'];
					$select_user_lab=$result_lab_tmp[0]['lab'];	
				}
				
			}
			echo "<br>";
			
			
			
			$result_reagent_tmp=search("select max(reagent_id) from genomics_core.reagent");
			
			if($result_reagent_tmp[0]['max(reagent_id)']==""){
				$result_reagent_tmp[0]['max(reagent_id)']=0;	
			}
			
			$RgRID="Comb_RgRID".($result_reagent_tmp[0]['max(reagent_id)']+1);
			
			$value="'".($result_reagent_tmp[0]['max(reagent_id)']+1)."','$RgRID','1','570','$select_user','$select_user_email','$select_user_lab','$Date','$Remark_comb'";
			$name="reagent_id,RgRID,DNA_High_sensitivty_chip,total_cost,Submitter_Name,email,lab,date,remark";
			
			$conn = db_connect();
			$res=$conn->query("INSERT INTO genomics_core.reagent($name) VALUES (".$value.")");
			#echo "INSERT INTO genomics_core.reagent($name) VALUES (".$value.")<br>";
			
			
			$request_record.="DNA High Sensitivity Chip (11 Samples/Chip), Quantity(Per Chip) :  1<br><br>$Remark_comb";	
			
			
			#echo "$comb_email<br>";
			
			
			if (!$res){
				echo "<span style=\"color:red\">Your request submit faild. Please contect with Genomics Core Tech.</span>";
			}
			else{
				
				$conn = db_connect();
				for($ii=0;$ii<11;$ii++){
					
					#echo "UPDATE genomics_core.share_reagent_request SET state='finished' where share_reagent_request_id='".$result_share_reagent[$ii]['share_reagent_request_id']."''<br>";
					$res_tmp=$conn->query("UPDATE genomics_core.share_reagent_request SET state='finished' where share_reagent_request_id='".$result_share_reagent[$ii]['share_reagent_request_id']."'");
					
					if (!$res_tmp){
						echo "Share Request update faild.<br>";	
					}
				}
				
				$Friday =date("ymd", strtotime("Friday"));
				$Tuesday =date("ymd", strtotime("Tuesday"));
				
				$collect_date="";
				$collect_date_detail="";
				
				if($Friday>$Tuesday){
					if(date("Gis")>90000){
						$collect_date="Friday";	
						$collect_date_detail=date("d/m/Y", strtotime("Friday"));		
					}
					else{
						$collect_date="Tuesday";
						$collect_date_detail=date("d/m/Y", strtotime("Tuesday"));	
					}
				}
				else{
					if(date("Gis")>90000){
						$collect_date="Tuesday";
						$collect_date_detail=date("d/m/Y", strtotime("Tuesday"));		
					}
					else{
						$collect_date="Friday";	
						$collect_date_detail=date("d/m/Y", strtotime("Friday"));	
					}
				}
				
				
				#$tomail="miziq@qq.com";
				require('email_CC.php');
				#$CC="miziq@qq.com";
				$tomail_arr=explode(',',$comb_email);
				$main_mesg="Dear $comb_user2,<br><br>$comb_user request one shared chip for DNA bioanalyzer.Thank you for requesting the following reagents.<br> Your reagent (<a href=\"http://161.64.198.12/genomics_core/reagent_search_result.php?RgRID=$RgRID\">$RgRID</a>) will be ready for collection on $collect_date ($collect_date_detail).<br><br>RgRID: <a href=\"http://161.64.198.12/genomics_core/reagent_search_result.php?RgRID=$RgRID\">$RgRID</a>, Request summary:<br>".$request_record."<br><br>Please note the Reagent Request ID(<font color=\"red\">RgRID</font>) for reference and find reagent request information from this link: <a href=\"http://161.64.198.12/genomics_core/reagent_search_result.php?RgRID=$RgRID\">Genomics Core database Reagent Request</a>.<br><br>This is an automated email from the <a href=\"http://161.64.198.12/genomics_core/index.php\">Genomics Core database</a>. Please do not reply to this email address. For any queries, please contact the Genomics Core Support team.";

				#$main_mesg.="<br><br>RgRID:$RgRID, Request summary:<br>".$request_record."<br><br>";
				$Subject="FYI: Reagent request for shared DNA bioanalyzer chip ($RgRID).";
				$CC_arr=explode(',',$CC);
	
				if($comb_email!=""){
					
					echo "<span style=\"color:black\">Reagent request submit successfully.<br>Your reagent (<a href=\"http://161.64.198.12/genomics_core/reagent_search_result.php?RgRID=$RgRID\"><b style=\"color:red\">$RgRID</b></a>) will be ready for collection on <b style=\"color:red\">$collect_date</b> (<b style=\"color:red\">$collect_date_detail</b>).</span><br>";
					
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
						echo "Email Faild<br>" . $mail->ErrorInfo;
					} else {
						#echo "Email Sent<br><br>";
					}
				}
				
				
			}
			
	
			
			
			
			if(count($result_share_reagent)>11){
				echo "<span style=\"color:red\">";
				echo "<br><br><br>2. Remained <b style=\"font-size:18px\">".(count($result_share_reagent)-11)."</b> samples are waiting<br><br>";
				echo "</span>";
				echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"800\">";
				echo "<tr valign=\"middle\" align=\"center\">";
				echo "<td>Order</td>";
				echo "<td>SRR_ID</td>";
				echo "<td>Request Days</td>";
				echo "<td>Submitter_Name</td>";
				echo "<td>Lab</td>";
				echo "<td>Date</td>";
				echo "<td>State</td>";
				echo "<td>Option</td>";
				echo "</tr>";
				
				for($i=11;$i<count($result_share_reagent);$i++){
					echo "<tr valign=\"middle\" align=\"center\">";
					echo "<td>".($i+1-11)."</td>";
					echo "<td>".$result_share_reagent[$i]['SRR_ID']."</td>";
					echo "<td>".$result_share_reagent[$i]['request_day']."</td>";		
					echo "<td>".$result_share_reagent[$i]['Submitter_Name']."</td>";
					echo "<td>".$result_share_reagent[$i]['lab']."</td>";
					echo "<td>".$result_share_reagent[$i]['Date']."</td>";
					echo "<td>".$result_share_reagent[$i]['state']."</td>";
					if($result_share_reagent[$i]['Submitter_Name']==$_SESSION['username'] or $result_user[0]['main']=='y'){
						echo "<td><a href=\"delete_shared_request.php?id=".$result_share_reagent[$i]['SRR_ID']."&database=share_reagent_request\"><input type=\"button\" value=\"DELETE\"></a></td>";
					}
					else{
						echo "<td>&nbsp;</td>";	
					}
					echo "</tr>";
				}
				echo "</table>";	
			}
		}
			
		
		
		
		
		
			
		
	}
	else{
		$_SESSION['resubmit']++;
		echo "<br><br>You already submit your request. You can check from <a href=\"http://161.64.198.12/genomics_core/reagent_share.php\">DNA shared request</a> webpage<br><br>";	
	}
}
	
	
	
		
	?>


   
<p>&nbsp;</p>
<p>&nbsp;</p>   
<p>&nbsp;</p>
<p>&nbsp;</p>

   
    
<?php require('tail.php')?>

<?php require('footer.php')?>













