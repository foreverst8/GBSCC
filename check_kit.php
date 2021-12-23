<html>
<head>
<style>
h6 {
    color: #002A60;
	font-family: sans-serif;
    font-size: 22px;
	font-weight: 100;
	margin-top: 4px;
    margin-bottom: 4px;
	}
p {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	display: inline;
	margin-top: 2px;
    margin-bottom: 2px;
}
a, a:visited { 
    color:#002A60; text-decoration:none; 
}
body {
	margin-left:20%;
	margin-right:20%;
	background-color: #e6ecff;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
ul {
	list-style-type:circle;
	padding:0;
	color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	display: inline;
	margin-top: 2px;
    margin-bottom: 2px;
}
</style>
</head>
<body>
<br>

<?php 
session_start();
require('login.php');?>  

<script type="text/javascript" src="jquery-3.0.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
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
<h6>CONSTRUCTION KIT AND BARCODE INFORMATION<h6>
<br>
   
<table>
  <tr>
	<td align="left" valign="top">
	
	<?PHP
	 	$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
	?>  
      
	</td>
  </tr>
  <tr>
	<td align="left" valign="top">

	<?php
	$I7="";
	$I5="";
	$barcode="";
	$Kit="";

	#$result_I7=search("select distinct No,Seq from Index_barcode where Position='I7'");
	#$result_I5=search("select distinct No,Seq from Index_barcode where Position='I5'");
	#$result_barcode=search("select distinct No,Seq from Index_barcode where Position='-'");
	$result_Kit=search("select distinct Kit from Index_barcode where Position='I7'");

	#for($ii=0;$ii<count($result_I7);$ii++){
	#	$I7.="<option value=\"".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."\">".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."</option>";	
	#}
	#for($ii=0;$ii<count($result_I5);$ii++){
	#	$I5.="<option value=\"".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."\">".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."</option>";	
	#}
	#for($ii=0;$ii<count($result_barcode);$ii++){
	#	$barcode.="<option value=\"".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."\">".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."</option>";	
	#}

	for($ii=0;$ii<count($result_Kit);$ii++){
		$Kit.="<option value=\"".$result_Kit[$ii]['Kit']."\">".$result_Kit[$ii]['Kit']."</option>";	
	}

	echo "<form action=\"check_kit.php\" method=\"get\">";
	echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"400\">";

	echo "<tr align=\"left\">";
	echo "<td align=\"right\" width=\"200\">";
	echo "Construction Kit:";
	echo "</td>";
	echo "<td bgcolor=\"#FFFFFF\">";
	echo "<select name=\"Construction_Kit\" id=\"Construction_Kit\">";
	echo "<option value=\"All\">All</option>";
	echo "$Kit";
	echo "</select>";
	echo "</td>";
	echo "</td></tr>";

	echo "<tr align=\"left\">";
	echo "<td align=\"right\">";
	echo "Position:";
	echo "</td>";
	echo "<td bgcolor=\"#FFFFFF\">";
	echo "<select name=\"Position\" id=\"Position\">";
	echo "<option value=\"All\">All</option>";
	echo "<option value=\"I7\">I7</option>";
	echo "<option value=\"I5\">I5</option>";
	echo "<option value=\"barcode\">barcode</option>";
	echo "</select>";
	echo "</td></tr>";

	#echo "<tr align=\"left\">";
	#echo "<td align=\"right\">";
	#echo "Index or Barcode:";
	#echo "</td>";
	#echo "<td bgcolor=\"#FFFFFF\">";
	#echo "<select name=\"Index\" id=\"Index\">";
	#echo "<option value=\"All\">All</option>";
	#echo "$I7";
	#echo "$I5";
	#echo "$barcode";
	#echo "</select>";
	#echo "</td></tr>";


	echo "<tr align=\"left\">";
	echo "<td align=\"right\">";
	echo "<input type=\"reset\" value=\"Reset\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "</td><td>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Submit\">";
	echo "</td></tr>";

	echo "</table></form>";
	echo "<span style=\"font-size:12px;color:red\"># Please select your desired Construction Kit above</span><br>";
	echo "<span style=\"font-size:12px;color:gray\"># If your Kit or Barcode is not in the list, please contact the Admins (Kaeling, Lakhan Miao or Niranjan) for help.</span><br><br>";
			
	?>
	 
	<script type="text/javascript">
	$('#Construction_Kit').editableSelect();
	$('#Position').editableSelect();
	$('#Index').editableSelect();
	</script>  


	<?php

	$Kit=$_GET["Construction_Kit"];
	$Position=$_GET["Position"];
	$Index=$_GET["Index"];

	if($Kit==""){
		$Kit="All";
	}
	if($Position==""){
		$Position="All";
	}
	if($Index==""){
		$Index="All";
	}

	$result_search=array();
	if($Index=="All" and $Position=="All" and $Kit=="All"){
		$result_search=search("select * from Index_barcode");
	}
	if($Index=="All" and $Position!="All" and $Kit=="All"){
		if($Position=="barcode"){
			$result_search=search("select * from Index_barcode where Kit='$Position'");
		}
		else{
			$result_search=search("select * from Index_barcode where Position='$Position'");
		}	
	}
	if($Index=="All" and $Position=="All" and $Kit!="All"){
		$result_search=search("select * from Index_barcode where Kit='$Kit'");
	}
	if($Index=="All" and $Position!="All" and $Kit!="All"){
		$result_search=search("select * from Index_barcode where Kit='$Kit' and Position='$Position'");
	}
	if($Index!="All"){
		$str_index=explode(' ',$_POST[$str_barcode]);
		$result_search=array_merge(search("select * from Index_barcode where No='$Index' or Seq='$Index' or  No='".$str_index[0]."' or Seq='".$str_index[0]." "),$result_search);
	}

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


	echo "</table><br><br>";

	if(count($result_search)<1){
		echo "No records exist for your search.<br><br>";
	}
	else{
		echo "<p>SEARCH RESULT</p><br><br>";
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"800\">";
		echo "<tr align=\"center\">";
		echo "<th>";
		echo "Construction Kit";
		echo "</th><th>";
		echo "Position";
		echo "</th><th>";
		echo "No.";
		echo "</th><th>";
		echo "Sequence";
		echo "</th></tr>";
		
		for($i=0;$i<count($result_search);$i++){
			echo "<tr align=\"center\">";
			echo "<td>";
			echo $result_search[$i]["Kit"];
			echo "</td><td>";
			echo $result_search[$i]["Position"];
			echo "</td><td>";
			echo $result_search[$i]["No"];
			echo "</td><td>";
			echo $result_search[$i]["Seq"];
			echo "</td></tr>";
		}
		echo "</table>";
	}

	?>
	</td>
	<td valign="top">
    <?php require("search.php");?>
    </td>
  </tr>
</table>
</body>
</html>











