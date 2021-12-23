<html>
<head>
<style>
table, th, td {
    color: black;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
body {
	margin-left:2%;
	margin-right:2%;
}
</style>
</head>

<body>
<br>
<?php 
session_start();
require('login.php');?> 

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
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

<hr>
<br>	
<h6>REAGENT REQUEST<h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?PHP
	$result_user=search("select * from user where user_name='".$_SESSION['username']."'");
	$result_lab_director=search("select * from lab where lab_director='".$_SESSION['username']."'");
	#echo "select * from lab where user_name='".$_SESSION['username']."'<br>";
	if(count($result_user)==0){
		#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
		echo 'You do not have permission to access this page.<br />';			
		exit;
	}
	?>  
      
	<?php require "reagent_notice.php"?>	
	<br>
	
	</td>
	<td valign="top">
	<?php require("search_reagent.php");?>
	</td>
  </tr>
</table>
     							
	<?php
	$conn = db_connect();

	$RgRID=$_GET['RgRID'];
	$keywords=$_GET['Keywords'];

	$disapproval_ID=$_GET['disapproval_ID'];
	$approval_ID=$_GET['approval_ID'];
	$inform_ID=$_GET['inform_ID'];
	$inform_lab=$_GET['inform_lab'];
	$distributed_ID=$_GET['distributed_ID'];

	if($disapproval_ID!=""){
		$conn = db_connect();
		$value="PI_approval='No'";
		$res=$conn->query("UPDATE genomics_core.reagent SET $value where RgRID='".$disapproval_ID."'");
		if (!$res){
			echo "<p>Sample information update failed.<br><br></p>";
			
		}
		else{
			echo "<p><b style=\"color:red\">Request $disapproval_ID has been disapproved.</b></p><br><br>";
			echo "<script>alert('Request $disapproval_ID has been disapproved');document.location = 'reagent_search_result.php?keywords=$keywords&RgRID=$RgRID'</script>";
		}
	}
	if($approval_ID!=""){
		$conn = db_connect();
		$value="PI_approval='Yes'";
		$res=$conn->query("UPDATE genomics_core.reagent SET $value where RgRID='".$approval_ID."'");
		if (!$res){
			echo "<p>Sample information update failed.<br><br></p>";
		}
		else{
			echo "<p><b style=\"color:red\">Request $disapproval_ID has been approved.</b></p><br><br>";
			echo "<script>alert('Request $disapproval_ID has been approved');document.location = 'reagent_search_result.php?keywords=$keywords&RgRID=$RgRID'</script>";
		}
	}
	if($distributed_ID!=""){
		$conn = db_connect();
		$value="distributed='Yes'";
		$res=$conn->query("UPDATE genomics_core.reagent SET $value where RgRID='".$distributed_ID."'");
		if (!$res){
			echo "<p>Sample information update failed.<br><br></p>";
			
		}
		else{
			echo "<p><b style=\"color:red\">Request $disapproval_ID has been distributed.<br><br></b></p>";
			echo "<script>alert('Request $disapproval_ID has been distributed');document.location = 'reagent_search_result.php?keywords=$keywords&RgRID=$RgRID'</script>";
		}
	}

	if($inform_ID!=""){
		$conn = db_connect();
		$result_lab_director2=search("select * from genomics_core.lab where lab_name='$inform_lab'");
		$result_search2=search("select * from genomics_core.reagent where RgRID='$inform_ID'");
		
		$tomail=$result_lab_director2[0]['director_email'].",".$result_search2[0]['email'];
		#$tomail="niranjan.shirgaonkar@gmail.com";
		require('email_CC.php');
		$main_mesg="Dear Core user,<br><br>".$result_search2['0']['Submitter_Name']." from the ".$result_user[0]['lab']." has requested some reagents(<a href=\"http://161.64.198.12/GBSCC/reagent_search_result_detial.php?RgRID=$inform_ID\">$inform_ID</a>). <br><b style=\"color:red\">Reagents are ready.</b><br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core database</a>. Please do not reply to this email address. For any queries, please contact the Core Support team.";

		$Subject="FYI: Reagent request is ready for ".$_SESSION['username']." from ".$result_user[0]['lab']."  ($inform_ID).";
		
		$tomail_arr=explode(',',$tomail);
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
				echo "Email Failed.<br>" . $mail->ErrorInfo;
			} else {
				#echo "Email Sent<br><br><br>Sent to: $tomail<br>CC:$CC<br>Record:<br>$request_record<br><br>";
				echo "<script>alert('Users informed');document.location = 'reagent_search_result.php'</script>";
			}
		}

	}
	  
	$query="";
	
	if($RgRID=="" and $keywords==""){
		$query="select * from genomics_core.reagent";
		if($result_user[0]['main']!="y"){
			$query.=" where Submitter_Name='".$_SESSION['username']."'";
		}
		
	}
	else{
		if($RgRID!=""){
			$query="select * from genomics_core.reagent where RgRID like '%".$RgRID."%'";
			if($result_user[0]['main']!="y"){
				$query.=" where Submitter_Name='".$_SESSION['username']."'";
			}
		}
		
		/*CHANGE BELOW*/		
		
		else{
			$query="select * from genomics_core.reagent where (RgRID like '%".$keywords."%' or DNA_High_sensitivty_chip like '%".$keywords."%' or RNA_Nano like '%".$keywords."%' or NEBNEXT_PloyA like '%".$keywords."%' or Remark like '%".$keywords."%' or NEBNEXT_Ultra_set1 like '%".$keywords."%' or NEBNEXT_Ultra_set2 like '%".$keywords."%' or NEBNEXT_Ultra_noIndex like '%".$keywords."%' or NEBNEXT_Ultra_II_set1 like '%".$keywords."%' or NEBNEXT_Ultra_II_set2 like '%".$keywords."%' or NEBNEXT_Ultra_II_noIndex like '%".$keywords."%' or NEB_Index like '%".$keywords."%' or NEB_Index_2 like '%".$keywords."%' or NEB_Quickligation like '%".$keywords."%' or NEBNEXT_Ultra_II_96 like '%".$keywords."%' or Phusion_DNA_Pol like '%".$keywords."%' or Primestar_DNA_Pol like '%".$keywords."%' or Qubit_dsDNA_HS like '%".$keywords."%' or Aline_PCR like '%".$keywords."%' or Aline_Size like '%".$keywords."%' or Rnaseh like '%".$keywords."%' or Spinminiprep like '%".$keywords."%' or QIAGEN_RNeasy_Mini like '%".$keywords."%' or QIAGEN_QIAquick_PCR_Purification like '%".$keywords."%' or QIAGEN_QIAquick_Gel_Extraction like '%".$keywords."%' or NEBNEXT_Ultra_II_EndRepair like '%".$keywords."%' or Taq_DNA_Ligase like '%".$keywords."%' or Aline_PCR_bottle like '%".$keywords."%' or SYBR_gelstain like '%".$keywords."%' or Agencourt_AMPure_XP like '%".$keywords."%' or ChemGenes_Barcoded_beads like '%".$keywords."%' or EQ_Four_Element_Calibration_Beads like '%".$keywords."%' or Maxpar_Antibody_Labeling_Kit like '%".$keywords."%' or Cell_ID_Intercalator_Ir like '%".$keywords."%' or Cell_ID_Cisplatin like '%".$keywords."%' or Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit like '%".$keywords."%' or Centrifugal_Filter_Unit_3kDa like '%".$keywords."%' or Centrifugal_Filter_Unit_50kDa like '%".$keywords."%' or Maxpar_Cell_Staining_Buffer like '%".$keywords."%' or date like '%".$keywords."%')";
			
			if($result_user[0]['main']!="y"){
				$query.=" and Submitter_Name='".$_SESSION['username']."'";
			}
		}

	}

	$color=array("#FFFAFA","#FFF68F","#FFEFD5","#FFE4E1","#FFDEAD","#FFC1C1","#FFB90F","#FFA54F","#FF8C00","#FF7F50","#FF6EB4","#FF4500","#FF3030","#FDF5E6","#FAF0E6","#F7F7F7","#F5DEB3","#F0FFFF","#F0E68C","#EEEE00","#EEE8AA","#EEDFCC","#EED5B7","#EEC900","#EEAEEE","#EE9A49","#EE8262","#EE7621","#EE6363","#EE3A8C","#EE00EE","#EAEAEA","#E5E5E5","#E0EEE0","#DEB887","#DBDBDB","#D9D9D9","#D3D3D3","#D1D1D1","#CDCDC1","#CDC9A5","#CDC1C5","#CDB7B5","#CDAF95","#CD9B1D","#CD8C95","#CD7054","#CD661D","#CD5B45","#CD3333","#CD1076","#CAFF70","#C71585","#C4C4C4","#C1CDC1","#BFBFBF","#BDB76B","#BBFFFF","#B8B8B8","#B4EEB4","#B3B3B3","#B0E2FF","#B03060","#ADADAD","#A9A9A9","#A4D3EE","#A1A1A1","#9F79EE","#9B30FF","#9A32CD","#98F5FF","#949494","#912CEE","#8EE5EE","#8DEEEE","#8B8B7A","#8B8878","#8B8378","#8B7D6B","#8B7500","#8B668B","#8B5A2B","#8B4789","#8B4500","#8B3626","#8B1C62","#8B0000","#87CEFF","#858585","#838B83","#7FFF00","#7D7D7D","#7B68EE","#7A67EE","#778899","#737373","#707070","#6CA6CD","#6A5ACD","#6959CD","#66CD00","#63B8FF","#5F9EA0","#5C5C5C","#556B2F","#548B54","#525252","#4EEE94","#4A4A4A","#474747","#458B00","#424242","#3D3D3D","#388E8E","#333333","#2E8B57","#282828","#228B22","#1F1F1F","#1C1C1C","#171717","#0F0F0F","#050505","#00FF00","#00EE76","#00CDCD","#00BFFF","#008B45","#006400","#0000AA");

	$page=$_GET['page'];

	if($page==""){
		$page=1;
	}

	$n1=($page-1)*20;
	$n2=$page*20;

	$result_search=search("$query order by reagent_id desc limit $n1,$n2");
	/*echo "$query order by reagent_id desc limit $n1,$n2<br>";*/

	$all_page_search=search("$query order by reagent_id desc");

	$all_page=floor(count($all_page_search)/20);
	if(count($result_search)%20>0){
		$all_page=$all_page+1;
	}

	if(count($result_search)==0){
		echo "<p>No records found for ".$_SESSION['username'].".<br></p>";
	}
	else{
		
		$nowdate=strtotime (date("d-m-y h:i:s"));
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<tr align=\"center\">";
		echo "<td>";
		echo "RgRID";
		echo "</td>";
		
		echo "<td>";
		echo "Agilent DNA High Sensitivity Chip (11 Samples per Chip)";
		echo "</td>";
		
		echo "<td>";
		echo "Agilent RNA Nano Chip (12 Samples per Chip)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Poly(A) mRNA magnetic isolation module, #E7490L, (12 Reaction/Set)  ";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 1</u></span> (2.5&micro;L, 10&micro;M Per tube)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 2</u></span> (2.5&micro;L, 10&micro;M Per tube)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina, #E7420L, (12 Reaction/Set), without Index";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina, #E7645L, (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 1</u></span> (5&micro;L, 10&micro;M)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina, #E7645L, (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 2</u></span> (5&micro;L, 10&micro;M)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina, #E7645L, (12 Reaction/Set), without Index";
		echo "</td>";
		
		echo "<td>";
		echo "*NEB Index (2.5&micro;L, 10&micro;M, Per Reaction)";
		echo "</td>";
		
		echo "<td>";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)";
		echo "</td>";
		
		echo "<td>";
		echo "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina (96 reactions)";
		echo "</td>";

		echo "<td>";
		echo "NEB Quick Ligation Kit (150 reactions)";
		echo "</td>";				

		echo "<td>";
		echo "NEB-Next Ultra II End Repair/dA-Tailing Module, #E7546L";
		echo "</td>";

		echo "<td>";
		echo "NEB Taq DNA ligase, #M0208L";
		echo "</td>";

		echo "<td>";
		echo "*Phusion DNA Polymerase, 500 Units";
		echo "</td>";
		
		echo "<td>";
		echo "Takara PrimeSTAR GXL DNA Polymerase (250 units)";
		echo "</td>";
		
		/*CHANGE BELOW*/
		echo "<td>";
		echo "Invitrogen Qubit dsDNA HS Assay with Assay Tubes";
		echo "</td>";		
		
		echo "<td>";
		echo "Aline PCR clean up DX beads, #C1003, (1mL Per Tube)";
		echo "</td>";
			
		echo "<td>";
		echo "Aline PCR Bottle clean up DX beads , #C1003, (Per Bottle)";
		echo "</td>";
		
		echo "<td>";
		echo "Aline Size selector-1 beads tube, #Z-6001, (1mL Per Tube)";
		echo "</td>";
		
		echo "<td>";
		echo "Aline Size selector-1 beads bottle, #Z-6001, (Per Bottle)";
		echo "</td>";

        echo "<td>";
        echo "Agencourt AMPure XP *for DropSeq, #A63881, (1mL Per Bottle)";
        echo "</td>";

        echo "<td>";
        echo "ChemGenes Barcoded beads *for DropSeq, #Macosko-2011-10, (1 Sample Per Tube)";
        echo "</td>";

		echo "<td>";
		echo "Takara SYBR Premix Ex Taq (Tli RNaseH Plus), #RR420A (200 reactions)";
		echo "</td>";

		echo "<td>";
		echo "QlAprep Spin Miniprep kit, #27106";
		echo "</td>";
		
		echo "<td>";
		echo "QIAGEN RNeasy Mini Kit (250)";
		echo "</td>";
		
		echo "<td>";
		echo "QIAGEN QIAquick PCR Purification Kit (250)";
		echo "</td>";
		
		echo "<td>";
		echo "QIAGEN QIAquick Gel Extraction Kit (250)";
		echo "</td>";
		
		echo "<td>";
		echo "Invitrogen SYBR Safe DNA gel stain, #S33102";
		echo "</td>";

		echo "<td>";
        echo "EQ™ Four Element Calibration Beads (per sample), #201078, 1mL Per Sample";
        echo "</td>";

        echo "<td>";
        echo "Maxpar Antibody Labeling Kit 150Nd, #201150A, Per Reaction";
        echo "</td>";

        echo "<td>";
        echo "Cell-ID Intercalator-Ir 125 uM, #201192A, 1 Test Per Tube";
        echo "</td>";

        echo "<td>";
        echo "Cell-ID Cisplatin, #201064, 1 Test Per Tube";
        echo "</td>";

        echo "<td>";
        echo "Maxpar® Human PB Basic Phenotyping Panel Kit 7 Markers, #201302, Per Test";
        echo "</td>";

        echo "<td>";
        echo "Centrifugal Filter Unit: 3 kDa Amicon Ultra-500 µL V bottom, #UFC500396, 1 Unit";
        echo "</td>";

        echo "<td>";
        echo "Centrifugal Filter Unit: 50 kDa Amicon Ultra-500 µL V bottom, #UFC505096, 1 Unit";
        echo "</td>";

        echo "<td>";
        echo "Maxpar Cell Staining Buffer (per 5mL), #201068, 5mL Per Tube";
        echo "</td>";

        echo "<td>";
        echo "Eppendorf 8-Tube x 0.2mL PCR Tube Strips with Caps, #951010022, Per Strip";
        echo "</td>";

        echo "<td>";
        echo "Rainin Wide-orifice 1000µL pipette tips, #30389218, Per Rack";
        echo "</td>";

		echo "<td>";
		echo "Total Cost";
		echo "</td>";
		
		echo "<td>";
		echo "Submitter Name";
		echo "</td>";
		
		echo "<td>";
		echo "Email";
		echo "</td>";
		
		echo "<td>";
		echo "Lab";
		echo "</td>";
		
		echo "<td>";
		echo "Date";
		echo "</td>";
		
		echo "<td>";
		echo "Approval state";
		echo "</td>";
		
		if(count($result_lab_director)>0 or $result_user[0]['main']=="y"){
			echo "<td>";
			echo "Approval-option for PI";
			echo "</td>";
		}
		
		
		/*if($result_user[0]['main']=="y"){
			echo "<td>";
			echo "Inform User";
			echo "</td>";
		}*/
		
		
		echo "<td>";
		echo "Reagent Distributed";
		echo "</td>";
		
		echo "<td>";
		echo "Remarks";
		echo "</td>";
		echo "</tr>";
		
		
		for($i=0;$i<count($result_search);$i++){
			echo "<tr align=\"center\">";
			echo "<td>";
			if($result_search[$i]['RgRID']==""){
				echo "-";
			}
			else{
				echo "<a href=\"reagent_search_result_detial.php?RgRID=".$result_search[$i]['RgRID']."\" class=\"button\">";
				echo $result_search[$i]['RgRID'];	
				echo "</a>";
			}
			echo "</td>";
			
			/* CHANGE BELOW */
			
			echo "<td>";
			if($result_search[$i]['DNA_High_sensitivty_chip']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['DNA_High_sensitivty_chip'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['RNA_Nano']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['RNA_Nano'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_PloyA']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_PloyA'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_set1']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_set1'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_set2']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_set2'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_noIndex']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_noIndex'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_II_set1']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_II_set1'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_II_set2']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_II_set2'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_II_noIndex']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_II_noIndex'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEB_Index']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEB_Index'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEB_Index_2']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEB_Index_2'];	
			}
			echo "</td>";			
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_II_96']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_II_96'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['NEB_Quickligation']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEB_Quickligation'];	
			}
			echo "</td>";				
			
			echo "<td>";
			if($result_search[$i]['NEBNEXT_Ultra_II_EndRepair']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['NEBNEXT_Ultra_II_EndRepair'];	
			}
			echo "</td>";		
			
			echo "<td>";
			if($result_search[$i]['Taq_DNA_Ligase']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Taq_DNA_Ligase'];	
			}
			echo "</td>";			
			
			echo "<td>";
			if($result_search[$i]['Phusion_DNA_Pol']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Phusion_DNA_Pol'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['Primestar_DNA_Pol']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Primestar_DNA_Pol'];	
			}
			echo "</td>";			
			
			echo "<td>";
			if($result_search[$i]['Qubit_dsDNA_HS']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Qubit_dsDNA_HS'];	
			}
			echo "</td>";			

		/*CHANGE BELOW*/			
			
			echo "<td>";
			if($result_search[$i]['Aline_PCR']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Aline_PCR'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['Aline_PCR_bottle']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Aline_PCR_bottle'];	
			}
			echo "</td>";			

			echo "<td>";
			if($result_search[$i]['Aline_Size']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Aline_Size'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['Aline_Size_selector_1_beads_bottle']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Aline_Size_selector_1_beads_bottle'];	
			}
			echo "</td>";

            echo "<td>";
            if($result_search[$i]['Agencourt_AMPure_XP']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Agencourt_AMPure_XP'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['ChemGenes_Barcoded_beads']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['ChemGenes_Barcoded_beads'];
            }
            echo "</td>";

			echo "<td>";
			if($result_search[$i]['Rnaseh']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Rnaseh'];	
			}
			echo "</td>";			
			
			echo "<td>";
			if($result_search[$i]['Spinminiprep']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['Spinminiprep'];	
			}
			echo "</td>";				
				
			echo "<td>";
			if($result_search[$i]['QIAGEN_RNeasy_Mini']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['QIAGEN_RNeasy_Mini'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['QIAGEN_QIAquick_PCR_Purification']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['QIAGEN_QIAquick_PCR_Purification'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['QIAGEN_QIAquick_Gel_Extraction']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['QIAGEN_QIAquick_Gel_Extraction'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['SYBR_gelstain']==""){
				echo "0";
			}
			else{
				echo $result_search[$i]['SYBR_gelstain'];	
			}
			echo "</td>";

            echo "<td>";
            if($result_search[$i]['EQ_Four_Element_Calibration_Beads']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['EQ_Four_Element_Calibration_Beads'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Maxpar_Antibody_Labeling_Kit']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Maxpar_Antibody_Labeling_Kit'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Cell_ID_Intercalator_Ir']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Cell_ID_Intercalator_Ir'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Cell_ID_Cisplatin']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Cell_ID_Cisplatin'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Centrifugal_Filter_Unit_3kDa']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Centrifugal_Filter_Unit_3kDa'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Centrifugal_Filter_Unit_50kDa']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Centrifugal_Filter_Unit_50kDa'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Maxpar_Cell_Staining_Buffer']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Maxpar_Cell_Staining_Buffer'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Eppendorf_8Tube_Strips_with_Caps']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Eppendorf_8Tube_Strips_with_Caps'];
            }
            echo "</td>";

            echo "<td>";
            if($result_search[$i]['Rainin_Wide_orifice_pipette_tips']==""){
                echo "0";
            }
            else{
                echo $result_search[$i]['Rainin_Wide_orifice_pipette_tips'];
            }
            echo "</td>";



			echo "<td>";
			if($result_search[$i]['total_cost']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['total_cost'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['Submitter_Name']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['Submitter_Name'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['email']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['email'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['lab']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['lab'];	
			}
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['date']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['date'];	
			}
			echo "</td>";
			
			echo "<td>";
			
			if($result_search[$i]['PI_approval']=="Yes"){
				echo "Approved";
			}
			else{
				echo "Disapproved";	
			}	
			
			echo "</td>";
			
			if(count($result_lab_director)>0 or $result_user[0]['main']=="y"){
				
				$olddate=explode('_',$result_search[$i]['date']);
				
				$olddate2=strtotime("$olddate[2]-$olddate[1]-$olddate[0] 24:00:00");
				
				
				if(ceil(($nowdate-$olddate2)/86400)<=1){
					echo "<td>";
					
					
					if($result_search[$i]['PI_approval']=="Yes"){
						echo "<a href=\"reagent_search_result.php?keywords=$keywords&RgRID=$RgRID&disapproval_ID=".$result_search[$i]['RgRID']."\">";
						echo "<input type=\"button\" class=\"button\" value=\"ToDisapproval\">";
					}
					else{
						echo "<a href=\"reagent_search_result.php?keywords=$keywords&RgRID=$RgRID&approval_ID=".$result_search[$i]['RgRID']."\">";
						echo "<input type=\"button\" class=\"button\" value=\"ToApproval\">";
					}
					echo "</a>";	
					echo "</td>";
				}
				else{
					echo "<td>";
					echo "-";
					echo "</td>";
				}
				
			}
			
			
			/*if($result_user[0]['main']=="y"){
				echo "<td>";
				if($result_search[$i]['PI_approval']=="No"){
					echo "-";
				}
				else{
					echo "<a href=\"reagent_search_result.php?keywords=$keywords&RgRID=$RgRID&inform_ID=".$result_search[$i]['RgRID']."&inform_lab=".$result_search[$i]['lab']."\">";
					echo "<input type=\"button\" value=\"InformUser\">";
					echo "</a>";
				}
				echo "</td>";
				
			}*/
			
			
			echo "<td>";
			
			if($result_search[$i]['PI_approval']=="No"){
				echo "-";
			}
			else{
				if($result_search[$i]['distributed']=="No"){
					
					if(count($result_lab_director)>0 or $result_user[0]['main']=="y"){
					
					echo "<a href=\"reagent_search_result.php?keywords=$keywords&RgRID=$RgRID&distributed_ID=".$result_search[$i]['RgRID']."\">";
					echo "<input type=\"button\" class=\"button\" value=\"ToDistribute\">";
					echo "</a>";
					}
					else {
					
					echo "No";
					
					}
				}
				else{
					echo $result_search[$i]['distributed'];	
				}
			}
			
			echo "</td>";
			
			echo "<td>";
			if($result_search[$i]['remark']==""){
				echo "-";
			}
			else{
				echo $result_search[$i]['remark'];	
			}
			echo "</td>";
			echo "</tr>";
				
		}
		
		echo "</table><br>";
		
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		if($page-1<=0){
			echo "<span style=\"color:gray\"><< Prev</span>";
		}
		else{
			echo "<a href=\"reagent_search_result.php?RgRID=$RgRID&keywords=$keywords&page=".($page-1)."\"><input type=\"button\" name=\"Prev\" class=\"button\" value=\"<< Prev\"></a>";
		}
		echo "&nbsp;&nbsp;&nbsp;&nbsp;$page/$all_page&nbsp;&nbsp;&nbsp;&nbsp;";
		
		if($page+1>$all_page){
			echo "<span style=\"color:gray\">Next >></span>";
		}
		else{
			echo "<a href=\"reagent_search_result.php?RgRID=$RgRID&keywords=$keywords&page=".($page+1)."\"><input type=\"button\" class=\"button\" name=\"Next\" value=\"Next >>\"></a>";
		}
	}
	?>

	</body>
</html>
