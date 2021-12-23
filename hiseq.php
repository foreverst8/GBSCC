<html>
<head>
<style>
body {
	background-color: #e6ecff;
	margin-left:2%;
	margin-right:2%;
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
</style>
</head>
<body>
<br>

<?php session_start();?>
<?php require('login.php');?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
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
// 	   function gradeChange2(){ 
//         var objS = document.getElementById("Kit"); 
//         var val = objS.options[objS.selectedIndex].value; 
// 		if(val=="Others"){
// 			//document.getElementById("ohter_kit").style.display="block";
// 			document.getElementById("tb_kit").style.display="block";
// 		}
// 		else{
// 			//document.getElementById("ohter_kit").style.display="none";
// 			document.getElementById("tb_kit").style.display="none";
// 		}
//        } 

</script>

<hr>
<br>
<h6>FHS ILLUMINA SEQUENCING SERVICE</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?php
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br>';	
			exit;
		}
   	?>  
	<ul>
		<li>For sample preparation, please refer to the NGS sample preparation instructions: <a class="button" href="ngs_sample_preparation.php">Click</a>.</li>
		<li> For submission of sample names, please <span style="color:red">DO NOT use special characters</span> such as space(" "), hash("#"), asterisk("*") or hyphen("-"). The database only allows characters like "a-z,A-Z,0-9,_,."</li>
		<li>The price of <span style="color:red">Hiseq</span> Sequencing:
		<ul>
			<li class="end">Single-end 60 bp, ~230-250M reads/Lane, MOP 8,000.</li>
			<li class="end">Paired-end 60 bp, ~230-280M reads/Lane, MOP 12,300.</li>
			<li class="end">Paired-end 100 bp, ~230-280M reads/Lane, MOP 16,700.</li>
		</ul>
		</li>	
		<li>The price of <span style="color:red">Miseq</span> Sequencing:
		<ul>
			<li class="end">Per run, ~20-25M reads, MOP 8,900.</li>
		</ul>	
		<li>The kit,index or barcode information can be checked from the Kit index database: <a class="button" href="check_kit.php">Click</a>. The kit name or the index no. should exactly match with the database.</li>
	</ul>
	</td>
    <td valign="top">
    <?php require("search_hiseq.php");?>
    </td>
  </tr>
</table>

	<br>
	<hr>
	<br>
    <h6>SUBMISSION FORM<h6>
    <p style="color:red;font-size:19px"><b>The core has stopped receiving samples for NGS seqeuncing. Please consider the use of  sequencing service from prepaid Novogene service by FHS.</b></p>
	<br><br>
    
	<?php
	if(!$_GET['Submitter_Name']){
    	echo "<form action=\"hiseq.php\" method=\"get\">";
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<tr>";
		echo "<td colspan=\"4\">";
		echo "<table border=\"1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
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
		echo "<input type=\"hidden\" name=\"date\" value=\"".date("d/m/y")."\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Sample Name:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\" >";
		echo "<input type=\"text\" name=\"Sample_Name\" size=\"40\"/>*";
		echo "</td>";
		echo "<td align=\"right\" >";
		echo "Request Reads Count(M):";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<input type=\"number\" name=\"reads_count\" min=\"1\" size=\"40\"/>*";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"right\">";
		echo "No. of multiplexed libraries:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\" >";
		echo "<input type=\"number\" name=\"libraries\" min=\"1\"/>*";
		echo "</td>";
		echo "<td align=\"right\" >";
		echo "Read Length(bp):&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<select name=\"Read_Length\" ><option value=\"0\" selected=\"selected\">Select One</option><option value=\"60\">&nbsp;&nbsp;60&nbsp;&nbsp;</option><option value=\"100\">&nbsp;&nbsp;100&nbsp;&nbsp;</option></select>*";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td  align=\"right\">";
		echo "Index Number:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<select name=\"Index_Number\" id=\"Index_Number\" ";
		echo ">";
		echo "<option value=\"4\" selected=\"selected\">Select One</option>";
		echo "<option value=\"0\" >0</option>";
		echo "<option value=\"1\" >1</option>";
		echo "<option value=\"2\" >2</option>";
		echo "</select>*";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Index Position:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<select name=\"Index_Position\">";
		echo "<option value=\"0\" selected=\"selected\">Select One</option>";
		echo "<option value=\"3_end_adapor\" >3'end of adapter</option>";
		echo "<option value=\"adaptor\" >On adapter</option>";
		echo "</select>*";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Category:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<select name=\"Category\" id=\"Category\" onchange=\"gradeChange1()\">";
		echo "<option value=\"0\" selected=\"selected\">Select</option>";
		echo "<option value=\"Targeted_Resequencing\">Targeted Resequencing</option>";
		echo "<option value=\"Genome_Sequencing\">Genome Sequencing</option>";
		echo "<option value=\"RNA_Sequencing\">RNA Sequencing</option>";
		echo "<option value=\"ChIP_Sequencing\">ChIP Sequencing</option>";
		echo "<option value=\"Library_QC\">Library QC</option>";
		echo "<option value=\"Others\">Others</option>";
		echo "</select>*";
		echo "<table id=\"tb_cate\" style=\"display:none\" ><tr><td><span id=\"note2\" style=\"font-size:12px\">Please Specify:</span></td><td><input type=\"text\" name=\"ohter_category\" id=\"ohter_category\"/></td></tr></table>";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Single/Paired-end:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<select name=\"end\">";
		echo "<option value=\"0\" selected=\"selected\">Select One</option>";
		echo "<option value=\"single_end\" >Single-End</option>";
		echo "<option value=\"paired_end\" >Paired-End</option>";
		echo "</select>*";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Average Size of the Library Pool:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<input type=\"text\" name=\"Avg_Pool\" id=\"Avg_Pool\">*";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Hiseq/Miseq:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<select name=\"Mode\">";
		echo "<option value=\"Hiseq\" >Hiseq</option>";
		echo "<option value=\"Miseq\" >Miseq</option>";
		echo "</select>*";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Concentration of Library Pool:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<input type=\"text\" name=\"Conc\" id=\"Conc\"  size=\"6\">nM&nbsp;*";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Volume of the Library Pool:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"text\" name=\"Volume\" id=\"Volume\" size=\"6\">&micro;L&nbsp;*";
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\" >";
		echo "Remarks:&nbsp;";
		echo "</td>";
		echo "<td colspan=\"2\" align=\"left\">";
		echo "<textarea name=\"Remark\" rows=\"5\" cols=\"80\"></textarea>";
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<span style=\"font-size:12px;color:gray\">If you need the Core to analyze your data, please list the brief purpose of the library (For eg. What is the case/control? What do you need the Core to do)</span>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		
		echo "<br><input type=\"reset\" class=\"button\" value=\"Reset\" />&nbsp;&nbsp;<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
		echo "</form>";
	}
	else{
		
		$check=0;
		if(!$_GET['Sample_Name']){
			$check=1;
			echo "<p>Sample Name cannot be empty.<br></p>";
		}
		 
		if(!preg_match("/^[_0-9a-zA-Z]+$/",$_GET['Sample_Name'])){
			$check=1;
			echo "<p>Sample Name can only contain [0-9,a-z,A-Z,_].<br></p>";
		}
		
		if(!$_GET['libraries']){
			$check=1;
			echo "<p>No. of multiplexed libraries cannot be empty.<br></p>";
		}
		if(!$_GET['Avg_Pool']){
			$check=1;
			echo "<p>Average Size of the Library Pool cannot be empty.<br></p>";
		}
		if(!preg_match("/^[0-9.]+$/",$_GET['Avg_Pool'])){
			$check=1;
			echo "<p>Average Size of the Library Pool must be a number.<br></p>";
		}
		if(!$_GET['Conc']){
			$check=1;
			echo "<p>Concentration of Library Pool cannot be empty.<br></p>";
		}
		if(!preg_match("/^[0-9.]+$/",$_GET['Conc'])){
			$check=1;
			echo "<p>Concentration of Library Pool must be a number.<br></p>";
		}
		if(!$_GET['Volume']){
			$check=1;
			echo "<p>Volume of the Library Pool cannot be empty.<br></p>";
		}
		if(!preg_match("/^[0-9.]+$/",$_GET['Volume'])){
			$check=1;
			echo "<p>Volume of the Library Pool should be a number.<br></p>";
		}
		if(!$_GET['Mode']){
			$check=1;
			echo "<p>NGS Mode cannot be empty.<br></p>";
		}
		if(!preg_match("/^\d+$/",$_GET['libraries'])){
			$check=1;
			echo "<p>No. of multiplexed libraries should be a number.<br></p>";
		}
		if($_GET['Read_Length']=="0"){
			$check=1;
			echo "<p>Please select the Read Length.<br></p>";
		}

		if($_GET['end']=="0"){
			$check=1;
			echo "<p>Please select Single/Paired-End.<br></p>";
		}
		if($_GET['Index_Number']=="4"){
			$check=1;
			echo "<p>Please select Index Number.<br></p>";
		}
		
		if($_GET['Index_Position']=="0"){
				$check=1;
				echo "<p>Please select Index Position.<br></p>";
		}
		if($_GET['Category']=="0"){
			$check=1;
			echo "<p>Please select Category.<br></p>";
		}
	
		if($_GET['Category']=="Others" and !$_GET['ohter_category']){
			echo "<p>Please Specify Category.<br></p>";
		}
	
		
		if($check==1){
			echo '<p><br>Something went wrong with your application.</p><br /><br>';			
			exit;	
		}
		
		
		$Submitter_Name=$_GET['Submitter_Name'];
		$Sample_Name=$_GET['Sample_Name'];
				
		$reads_count=$_GET['reads_count'];
		$libraries=$_GET['libraries'];
		$Read_Length=$_GET['Read_Length'];
		$end=$_GET['end'];
		$Index_Number=$_GET['Index_Number'];
		$Index_Position=$_GET['Index_Position'];
		$Category=$_GET['Category'];
		$ohter_category=$_GET['ohter_category'];
		$Avg_Pool=$_GET['Avg_Pool'];
		$Remark=$_GET['Remark'];
		$date=$_GET['date'];
		
		$Conc=$_GET['Conc'];
		$Mode=$_GET['Mode'];
		$Volume=$_GET['Volume'];
		$Remark=htmlspecialchars($Remark,ENT_QUOTES);
		
		if($Category=="Others"){
			$Category=$ohter_category;
		}

	#------
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\" >";
		echo "<tr align=\"center\">";
		echo "<td colspan=\"4\">";
		echo "<table border=\"1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
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
		echo "Date";
		echo "</td>";
		echo "<td>";
		echo date("d/m/y");
		echo "<input type=\"hidden\" name=\"date\" value=\"".date("d/m/y")."\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Sample Name:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Sample_Name;
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Request Reads Count(M):";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $reads_count;
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\">";
		echo "No. of multiplexed libraries";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo $libraries;
		echo "</td>";
		echo "<td align=\"right\" >";
		echo "Read Length(bp):";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Read_Length;
		echo "</td>";	
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"right\">";
		echo "Index Number:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Index_Number;
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Index Position:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Index_Position;
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"right\" >";
		echo "Category:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Category;
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Single/Paired-End:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $end;
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Average Size of the Library Pool:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Avg_Pool;
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Hiseq/Miseq:";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo $Mode;
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Concentration of the Library Pool:";
		echo "</td>";
		echo "<td  align=\"center\">";
		echo $Conc;
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Volume of the Library Pool:";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $Volume;
		echo "</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\" >";
		echo "Remarks:";
		echo "</td>";
		echo "<td colspan=\"2\"> ";
		echo html_entity_decode($Remark)."&nbsp;";
		echo "<td align=\"left\">";
		echo "<span style=\"font-size:12px;color:gray\">If you need the Core to analyze your data, please list the brief purpose of your library.<br>(Eg. What is the case/control?<br>What do you want the Core to do?)</span>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		
		$result_check=search("select * from hiseq_sample where Submitter_Name='".$Submitter_Name."' and Sample_Name='".$Sample_Name."'");
		if(count($result_check)>0){
			echo "<p><br>You cannot use the same Sample Name as earlier applications.<br/><br></p>";			
			exit;		
		}
		
		echo "<hr><br><h6>SAMPLE DETAILS<h6><br>";
		
		
		echo "<form action=\"hiseq_mysql.php\" method=\"post\" enctype=\"multipart/form-data\">";
		echo "<input type=\"hidden\" name=\"Submitter_Name\" value=\"".$Submitter_Name."\" />";
		echo "<input type=\"hidden\" name=\"Sample_Name\" value=\"".$Sample_Name."\" />";
		echo "<input type=\"hidden\" name=\"libraries\" id=\"libraries\" value=\"".$libraries."\" />";
		echo "<input type=\"hidden\" name=\"Read_Length\" value=\"".$Read_Length."\" />";
		echo "<input type=\"hidden\" name=\"end\" value=\"".$end."\" />";
		echo "<input type=\"hidden\" name=\"Index_Number\" value=\"".$Index_Number."\" />";
		echo "<input type=\"hidden\" name=\"Index_Position\" value=\"".$Index_Position."\" />";
		echo "<input type=\"hidden\" name=\"Category\" value=\"".$Category."\" />";
		echo "<input type=\"hidden\" name=\"Avg_Pool\" value=\"".$Avg_Pool."\" />";
		echo "<input type=\"hidden\" name=\"Remark\" value=\"".$Remark."\" />";
		echo "<input type=\"hidden\" name=\"date\" value=\"".$date."\" />";
		echo "<input type=\"hidden\" name=\"reads_count\" value=\"".$reads_count."\" />";
		echo "<input type=\"hidden\" name=\"Mode\" value=\"".$Mode."\" />";
		echo "<input type=\"hidden\" name=\"Conc\" value=\"".$Conc."\" />";
		echo "<input type=\"hidden\" name=\"Volume\" value=\"".$Volume."\" />";
		
		$I7="";
		$I5="";
		$barcode="";
		$Kit="";
		
		$result_I7=search("select distinct No,Seq from Index_barcode where Position='I7'");
		$result_I5=search("select distinct No,Seq from Index_barcode where Position='I5'");
		$result_barcode=search("select distinct No,Seq from Index_barcode where Position='-'");
		$result_Kit=search("select distinct Kit from Index_barcode where Position='I7'");
		
		for($ii=0;$ii<count($result_I7);$ii++){
			if(preg_match("/NEB/",$result_I7[$ii]['No'])){
				$I7.="<option value=\"".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."\">".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."</option>";	
			}
		}
		for($ii=0;$ii<count($result_I7);$ii++){
			if(!preg_match("/NEB/",$result_I7[$ii]['No'])){
				$I7.="<option value=\"".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."\">".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."</option>";	
			}	
		}
		for($ii=0;$ii<count($result_I5);$ii++){
			$I5.="<option value=\"".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."\">".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."</option>";	
		}
		for($ii=0;$ii<count($result_barcode);$ii++){
			$barcode.="<option value=\"".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."\">".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."</option>";	
		}
		
		for($ii=0;$ii<count($result_Kit);$ii++){
			$Kit.="<option value=\"".$result_Kit[$ii]['Kit']."\">".$result_Kit[$ii]['Kit']."</option>";	
		}
		$Kit.="<option value=\"ChrisLabProtocal\">Chris Lab Protocol</option>";
		
		echo "<p><b>A. DNA Bioanalyzer Result</b><br><br>";
		echo "Please upload the Bioanalyzer result(PDF).</span> &nbsp;&nbsp;<input name=\"bioanalyzer_file\" id=\"bioanalyzer_file\" type=\"file\"/><br></p>";
		
		echo "<span style=\"font-size:12px;color:gray\"># If there are multiple Bioanalyzer results(PDF),</span> <span style=\"font-size:12px;color:red\">please combine them in one PDF file, and then upload it.</span><br><br>";
				
		echo "<p><b>B. Library Details</b><br><br>";
		echo "Fill the following table or upload from an Excel file. &nbsp;&nbsp;&nbsp;&nbsp;<input name=\"sample_file\" id=\"sample_file\" type=\"file\" /><br><span style=\"font-size:12px;color:gray\"># Please fill this Excel file";
		
		if($Index_Number=="0"){
			echo "<a href=\"files\\hiseq_sequencing_upload_file_no_index.xlsx\">hiseq_sequencing_upload_file_no_index.xlsx";
		
		}
		if($Index_Number=="1"){
			echo "<a href=\"files\\hiseq_sequencing_upload_file_I7.xlsx\">hiseq_sequencing_upload_file_I7.xlsx";
		
		}
		if($Index_Number=="2"){
			echo "<a href=\"files\\hiseq_sequencing_upload_file_I7_I5.xlsx\">hiseq_sequencing_upload_file_I7_I5.xlsx";
		}
		
		echo "</a>, and then upload it.<br>";
		echo "<span style=\"font-size:12px;color:gray\"># For Construction Kit,Index and Barcode values, please choose from the <a href=\"check_kit.php\">Hiseq database information</a></span><br>";
		
		echo "<span style=\"font-size:12px;color:gray\"># If your Kit or Barcode is not on the list, please contact the Admins (Kaeling, Lakhan, Miao or Niranjan) for help.</span><br><br></p>";
		
		if($libraries<50){
			echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\" >";
			echo "<tr align=\"center\" valign=\"middle\">";
			echo "<td>";
			echo "No.";
			echo "</td>";
			
			echo "<td>";
			echo "Library Name";
			echo "</td>";
			
			echo "<td>";
			echo "Project Type";
			echo "</td>";
			
			echo "<td>";
			echo "Concentration of Library Pool (nM)";
			echo "</td>";
			
			echo "<td>";
			echo "Volume of Library Pool (&micro;l)";
			echo "</td>";
			
			echo "<td>";
			echo "Buffer for Library Pool";
			echo "</td>";
			
			echo "<td>";
			echo "Construction  Kit";
			echo "</td>";
		
			
			if($Index_Number=="0"){
				echo "<td>";
				echo "Barcode";
				echo "</td>";
			}
			if($Index_Number=="1"){
				echo "<td>";
				echo "I7 Index";
				echo "</td>";
			}
			if($Index_Number=="2"){
				echo "<td>";
				echo "I7 Index";
				echo "</td>";
				echo "<td>";
				echo "I5 Index";
				echo "</td>";
				
			}
			echo "</tr>";
			
			for($i=1;$i<=$libraries;$i++){
				echo "<tr align=\"center\">";
				
				echo "<td align=\"center\">";
				echo "$i";
				echo "</td>";
				
				echo "<td>";
				echo "<input name=\"Library_Name_".$i."\" size=\"20\" />";
				echo "</td>";
				
				echo "<td>";
				echo "<input name=\"Project_Type_".$i."\" size=\"20\" />";
				echo "</td>";
				
				echo "<td>";
				echo "<input name=\"Library_Conc_".$i."\" size=\"14\" />";
				echo "</td>";
				
				echo "<td>";
				echo "<input name=\"Library_Volume_".$i."\" size=\"14\" />";
				echo "</td>";
				
				echo "<td>";
				
				echo "<select name=\"Library_Buffer_".$i."\" id=\"Library_Buffer_".$i."\">";
				echo "<option value=\"0\">&nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;&nbsp;</option>";
				echo "<option value=\"Water\">Water</option>";
				echo "<option value=\"TE\">TE</option>";
				echo "<option value=\"Tris_HCl\">Tris_HCl</option>";
				echo "<option value=\"Ohter\">Other</option>";
				echo "</select>";
				echo "</td>";
				
				echo "<td bgcolor=\"#FFFFFF\">";
				echo "<select name=\"Construction_Kit_".$i."\" id=\"Construction_Kit_".$i."\">";
				echo "$Kit";
				echo "</select>";
				echo "</td>";
				
				if($Index_Number=="0"){
					echo "<td bgcolor=\"#FFFFFF\">";
					echo "<select name=\"barcode_".$i."\" id=\"barcode_".$i."\">";
					echo "$barcode";
					echo "</select>";
					echo "</td>";
				}
				if($Index_Number=="1"){
					echo "<td bgcolor=\"#FFFFFF\">";
					echo "<select name=\"I7_Index_".$i."\" id=\"I7_Index_".$i."\">";
					echo "$I7";
					echo "</select>";
					echo "</td>";
				}
				if($Index_Number=="2"){
					echo "<td bgcolor=\"#FFFFFF\">";
					echo "<select name=\"I7_Index_".$i."\" id=\"I7_Index_".$i."\">";
					echo "$I7";
					echo "</select>";
					echo "</td>";
					echo "<td bgcolor=\"#FFFFFF\">";
					echo "<select name=\"I5_Index_".$i."\" id=\"I5_Index_".$i."\">";
					echo "$I5";
					echo "</select>";
					echo "</td>";
					
				}
				echo "</tr>";
				
			}
			echo "</table><br>";
			echo "<table style=\"color:#999;font-size:12px\" border=\"1\" bordercolor=\"#999\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr>";
			echo "<th>";
			echo "Kit_Name";
			echo "</th>";
			echo "<th>";
			echo "Kit_Range";
			echo "</th>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "NEB illumina index";
			echo "</td>";
			echo "<td>";
			echo "NEB001-NEB27";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "TruSeq";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq_DNA";
			echo "</td>";
			echo "<td>";
			echo "ND001-ND027";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq_Stranded_mRNA";
			echo "</td>";
			echo "<td>";
			echo "NR001-NR027";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "TruSeq";
			echo "</td>";*/
			echo "<td>";
			echo "TruSight_Tumor<br>TruSeq_Amplicon";
			echo "</td>";
			echo "<td>";
			echo "I7:A701-A712<br>I5:A501-A508";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq_Small_RNA";
			echo "</td>";
			echo "<td>";
			echo "RPI1-RPI48";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "Nextera**";
			echo "</td>";
			echo "<td>";
			echo "I7:N701-N729<br>I5:S/E501-S/E522";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq_LT Nextera_Mate_Pair";
			echo "</td>";
			echo "<td>";
			echo "A001-A027";
			echo "</td>";
			echo "</tr>";
			
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq_HT";
			echo "</td>";
			echo "<td>";
			echo "I7:D701-D712<br>I5:A501-A508";
			echo "</td>";
			echo "</tr>";
			
			
			echo "<tr align=\"center\">";
			/*echo "<td>";
			echo "NEB";
			echo "</td>";*/
			echo "<td>";
			echo "TruSeq Targeted RNA Expression";
			echo "</td>";
			echo "<td>";
			echo "I7:R701-R748<br>I5:D501-D508";
			echo "</td>";
			echo "</tr>";
			
			
			echo "</table><span style=\"font-size:12px;color:gray\">&nbsp;&nbsp;# For more Kit information please check the <a href=\"check_kit.php\">Hiseq database information</a></span>";
			
			echo "<script type=\"text/javascript\">";
			for($i=1;$i<=$libraries;$i++){
				
				echo "$('#Construction_Kit_".$i."').editableSelect();";
				if($Index_Number=="0"){
					echo "$('#barcode_".$i."').editableSelect();";
				}
				if($Index_Number=="1"){
					echo "$('#I7_Index_".$i."').editableSelect();";
				}
				if($Index_Number=="2"){
					echo "$('#I7_Index_".$i."').editableSelect();";
					echo "$('#I5_Index_".$i."').editableSelect();";
				}
				
			}
			
			echo "</script>";
		}
		echo "<br><br><input type=\"reset\" class=\"button\" value=\"Reset\" />&nbsp;&nbsp;<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
		echo "</form>";
	
	}
	?>
</body>
</html>