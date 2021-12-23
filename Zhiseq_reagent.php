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

<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>REAGENT REQUEST</h6>
<br>

<?php 
$result_price=search("select * from price_table");
$result_price_array=array();

for($i=0;$i<count($result_price);$i++){
	$result_price_array[$result_price[$i]['name']]=$result_price[$i]['price'];
}
?>

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
	   function total_cost(){ 
        var v1=document.getElementById("DNA_High_sensitivty_chip").value;
		var v2=document.getElementById("RNA_Nano").value;
		var v3=document.getElementById("NEBNEXT_PloyA").value;
		var v41=document.getElementById("NEBNEXT_Ultra_set1").value;
		var v51=document.getElementById("NEBNEXT_Ultra_II_set1").value;
		var v61=document.getElementById("NEB_Index").value;
		var v7=document.getElementById("Aline_PCR").value;
		var v8=document.getElementById("Aline_Size").value;
		var v42=document.getElementById("NEBNEXT_Ultra_set2").value;
		var v52=document.getElementById("NEBNEXT_Ultra_II_set2").value;
		var v43=document.getElementById("NEBNEXT_Ultra_noIndex").value;
		var v53=document.getElementById("NEBNEXT_Ultra_II_noIndex").value;
		var v62=document.getElementById("NEB_Index_2").value;
				
		/*CHANGE BELOW*/
		
		var v63=document.getElementById("NEB_Quickligation").value;
		var v64=document.getElementById("NEBNEXT_Ultra_II_96").value;
		var v65=document.getElementById("Phusion_DNA_Pol").value;
		var v66=document.getElementById("Qubit_dsDNA_HS").value;
		var v67=document.getElementById("Aline_PCR_bottle").value;
		var v68=document.getElementById("NEBNEXT_Ultra_II_EndRepair").value;
		var v69=document.getElementById("Taq_DNA_Ligase").value;
		var v70=document.getElementById("Rnaseh").value;
		var v71=document.getElementById("Spinminiprep").value;
		var v72=document.getElementById("Primestar_DNA_Pol").value;
		
		var vd1=document.getElementById("QIAGEN_RNeasy_Mini").value;
		var vd2=document.getElementById("QIAGEN_QIAquick_PCR_Purification").value;
		var vd3=document.getElementById("QIAGEN_QIAquick_Gel_Extraction").value;
		
		var pv1=<?php echo $result_price_array["DNA_High_sensitivty_chip"]?>;
		var pv2=<?php echo $result_price_array["RNA_Nano"]?>;
		var pv3=<?php echo $result_price_array["NEBNEXT_PloyA"]?>;
		var pv41=<?php echo $result_price_array["NEBNEXT_Ultra_set1"]?>;
		var pv51=<?php echo $result_price_array["NEBNEXT_Ultra_II_set1"]?>;
		var pv61=<?php echo $result_price_array["NEB_Index"]?>;
		var pv7=<?php echo $result_price_array["Aline_PCR"]?>;
		var pv8=<?php echo $result_price_array["Aline_Size"]?>;
		var pv42=<?php echo $result_price_array["NEBNEXT_Ultra_set2"]?>;
		var pv52=<?php echo $result_price_array["NEBNEXT_Ultra_II_set2"]?>;
		var pv43=<?php echo $result_price_array["NEBNEXT_Ultra_noIndex"]?>;
		var pv53=<?php echo $result_price_array["NEBNEXT_Ultra_II_noIndex"]?>;
		var pv62=<?php echo $result_price_array["NEB_Index_2"]?>;
		
		/*CHANGE BELOW*/
		
		var pv63=<?php echo $result_price_array["NEB_Quickligation"]?>;
		var pv64=<?php echo $result_price_array["NEBNEXT_Ultra_II_96"]?>;
		var pv65=<?php echo $result_price_array["Phusion_DNA_Pol"]?>;
		var pv66=<?php echo $result_price_array["Qubit_dsDNA_HS"]?>;
		var pv67=<?php echo $result_price_array["Aline_PCR_bottle"]?>;
		var pv68=<?php echo $result_price_array["NEBNEXT_Ultra_II_EndRepair"]?>;
		var pv69=<?php echo $result_price_array["Taq_DNA_Ligase"]?>;
		var pv70=<?php echo $result_price_array["Rnaseh"]?>;
		var pv71=<?php echo $result_price_array["Spinminiprep"]?>;
		var pv72=<?php echo $result_price_array["Primestar_DNA_Pol"]?>;
		
		var pvd1=<?php echo $result_price_array["QIAGEN_RNeasy_Mini"]?>;
		var pvd2=<?php echo $result_price_array["QIAGEN_QIAquick_PCR_Purification"]?>;
		var pvd3=<?php echo $result_price_array["QIAGEN_QIAquick_Gel_Extraction"]?>;

		/*CHANGE BELOW*/		
		
		var cost= v1*pv1 + v2*pv2 + v3*pv3 + v41*pv41 + v51*pv51 + v61*pv61 + v42*pv42 + v52*pv52 + v62*pv62 + v63*pv63 + v64*pv64 + v65*pv65 + v66*pv66 + v67*pv67 + v68*pv68 + v69*pv69 + v7*pv7 + v70*pv70 + v71*pv71 + v72*pv72 + v8*pv8 + vd1*pvd1 + vd2*pvd2 + vd3*pvd3 + v43*pv43  + v53*pv53;
		document.getElementById("total_cost").innerHTML=cost;
		document.getElementById("total_cost_value").value=cost;
       }
</script>
  
<table>
  <tr>
	<td align="left" valign="top" >  
     <?PHP
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';
			exit;
	}
	?>  
      
    <?php require "reagent_notice.php"?>	
	</td>
	
	<td valign="top">
	<?php require("search_reagent.php");?>
	</td>
  </tr>
</table>
	
	<br>
    <?php
	#echo count($result_price)."<br>".$result_price[."<br>";
	if(!$_GET['Submitter_Name']){
	
    	echo "<form action=\"hiseq_reagent.php\" method=\"get\">";
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"600\">";
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
		
		echo "<h6>REQUEST FORM<h6><br>";
		
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Prices last updated on 12/02/2019.</span><br>";
		
		/* TABLE A */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>A: DNA Quantification Kits</b>";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"560px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150px\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" width=\"150px\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";
				
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\" rowspan=\"2\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Agilent DNA High Sensitivity Chip (11 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "5067-4626";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['DNA_High_sensitivty_chip'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Chip";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"DNA_High_sensitivty_chip\" id=\"DNA_High_sensitivty_chip\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"20px\" valign=\"middle\">";
		echo "<td align=\"left\" colspan=\"4\">";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size:12px\">* If the number of samples are less than 11,please use <a href=\"reagent_share.php\"><u style=\"color:red\">DNA shared request</u></a></span>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\" rowspan=\"2\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Agilent RNA Nano Chip (12 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "5067-1511";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['RNA_Nano'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Chip";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"RNA_Nano\" id=\"RNA_Nano\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"20px\" valign=\"middle\">";
		echo "<td align=\"left\" colspan=\"4\">";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size:12px\">* If the number of samples are less than 12,please use <a href=\"reagent_share_RNA.php\"><u style=\"color:red\">RNA shared request</u></a></span>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Invitrogen Qubit dsDNA HS Assay with Assay Tubes";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Q32854";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['Qubit_dsDNA_HS'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Qubit_dsDNA_HS\" id=\"Qubit_dsDNA_HS\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";	
		
		echo "</table><br>";
		
		/* TABLE B */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>B: Library prep Reagents (NEB)</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"560px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\">";
		echo "Catalog #";
		echo "</td>";		
		echo "<td align=\"center\" width=\"100\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Poly(A) mRNA magnetic isolation module (12 Reaction/Set)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7490L";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_PloyA'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_PloyA\" id=\"NEBNEXT_PloyA\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
			
		echo "<tr>";
		echo "<td align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 1</u></span> (2.5&micro;L, 10&micro;M Per tube)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7420L;E7335L";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_set1'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_set1\" id=\"NEBNEXT_Ultra_set1\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td align=\"center\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 2</u></span> (2.5&micro;L, 10&micro;M Per tube)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7420L;E7500L";
		echo "</td>";			
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_set2'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_set2\" id=\"NEBNEXT_Ultra_set2\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"center\">";
		echo "4";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra directional <span style=\"color:red\"><u>RNA library prep</u></span> Kit for Illumina (12 Reaction/Set), <b>without</b> Index";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7420L";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_noIndex'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_noIndex\" id=\"NEBNEXT_Ultra_noIndex\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
				
		echo "<tr>";
		echo "<td align=\"center\">";
		echo "5";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 1</u></span> (5&micro;L, 10&micro;M)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7645L;E7335L";
		echo "</td>";			
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_set1'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_set1\" id=\"NEBNEXT_Ultra_II_set1\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"center\">";
		echo "6";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set), with 12 NEB Index <span style=\"color:#548C00\"><u>Set 2</u></span> (5&micro;L, 10&micro;M)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7645L;E7500L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_set2'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_set2\" id=\"NEBNEXT_Ultra_II_set2\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"center\">";
		echo "7";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set), <b>without</b> Index";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7645L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_noIndex'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_noIndex\" id=\"NEBNEXT_Ultra_II_noIndex\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "8";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina (96 reactions)&nbsp;&nbsp;";
		echo "</td>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7645L";
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_96'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_96\" id=\"NEBNEXT_Ultra_II_96\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";	
		echo "</tr>";
		
		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "9";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "*NEB Index (2.5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index\" id=\"NEB_Index\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "10";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;";
		echo "</td>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_2'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index_2\" id=\"NEB_Index_2\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		/*CHANGE BELOW*/
	
		echo "</table><br>";		
		
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Index will be distributed based on number of Reaction.</span><br>";
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Index Set1: NEB index 1-12, Index Set2: NEB index 13-27.</span><br>";
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Index available for ordering separately :";
		echo "<table cellpadding=\"0\" cellspacing=\"3\" border=\"0\"><tr><td width=\"30\">&nbsp;</td><td><table border=\"1\" cellspacing=\"0\" style=\"font-size:12px;color:gray\" bordercolor=\"#999999\">";
		echo "<tr align=\"center\">";
		echo "<td width=\"40\">NO.</td>";
		echo "<td width=\"80\">Seq</td>";
		echo "<td width=\"40\">NO.</td>";
		echo "<td width=\"80\">Seq</td>";
		echo "<td width=\"40\">NO.</td>";
		echo "<td width=\"80\">Seq</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td >1</td>";
		echo "<td>ATCACG</td>";
		echo "<td>2</td>";
		echo "<td>CGATGT</td>";
		echo "<td>5</td>";
		echo "<td>ACAGTG</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td>6</td>";
		echo "<td>GCCAAT</td>";
		echo "<td>7</td>";
		echo "<td>CAGATC</td>";
		echo "<td>8</td>";
		echo "<td>ACTTGA</td>";
		echo "</tr>";
		
		
		echo "<tr align=\"center\">";
		echo "<td>9</td>";
		echo "<td>GATCAG</td>";
		echo "<td>11</td>";
		echo "<td>GGCTAC</td>";
		echo "<td>12</td>";
		echo "<td>CTTGTA</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td>16</td>";
		echo "<td>CCGTCC</td>";
		echo "<td>18</td>";
		echo "<td>GTCCGC</td>";
		echo "<td>19</td>";
		echo "<td>GTGAAA</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td>20</td>";
		echo "<td>GTGGCC</td>";
		echo "<td>21</td>";
		echo "<td>GTTTCG</td>";
		echo "<td>22</td>";
		echo "<td>CGTACG</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td>23</td>";
		echo "<td>GAGTGG</td>";
		echo "<td>25</td>";
		echo "<td>ACTGAT</td>";
		echo "<td>27</td>";
		echo "<td>ATTCCT</td>";
		echo "</tr>";
		echo "</table>";
		echo "</td></tr></table>";
		echo "</span><br>";

		/* TABLE C */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>C: Enzymes</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"560px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150px\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";		
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\"  width=\"150px\"colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "NEB Quick Ligation Kit (150 reactions)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M2200L";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Quickligation'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Quickligation\" id=\"NEB_Quickligation\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Phusion High-Fidelity DNA Polymerase (500 units)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M0530L";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['Phusion_DNA_Pol'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Phusion_DNA_Pol\" id=\"Phusion_DNA_Pol\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "3";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "NEBNext Ultra II End Repair/dA-Tailing Module";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7546L";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_EndRepair'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_EndRepair\" id=\"NEBNEXT_Ultra_II_EndRepair\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "4";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "NEB <i>Taq</i> DNA Ligase";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M0208L";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['Taq_DNA_Ligase'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Taq_DNA_Ligase\" id=\"Taq_DNA_Ligase\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "5";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Takara SYBR Premix Ex Taq (Tli RNaseH Plus) (200 reactions)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "RR420A";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['Rnaseh'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Rnaseh\" id=\"Rnaseh\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "6";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Takara PrimeSTAR GXL DNA Polymerase (250 units)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "R050A";
		echo "</td>";	
		echo "<td align=\"center\">";
		echo $result_price_array['Primestar_DNA_Pol'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Primestar_DNA_Pol\" id=\"Primestar_DNA_Pol\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";

		/* TABLE D */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>D: Purification beads</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"560px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\"  width=\"150\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";
				
		echo "<tr valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Aline PCR clean up DX beads";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "C1003";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_PCR'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "1 mL Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_PCR\" id=\"Aline_PCR\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr align=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Aline Size selector-1 beads";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "Z6001";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_Size'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "1 mL Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_Size\" id=\"Aline_Size\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr align=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Aline PCR clean up DX beads";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "C1003";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_PCR_bottle'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Bottle</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_PCR_bottle\" id=\"Aline_PCR_bottle\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";	
		
		echo "</table><br>";
				
		/* TABLE E */		
				
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>E: QIAGEN Kits</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"560px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\">";
		echo "Catalog #";
		echo "</td>";		
		echo "<td align=\"center\" width=\"100\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";		

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "QlAprep Spin Miniprep kit";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "27106";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['Spinminiprep'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"Spinminiprep\" id=\"Spinminiprep\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "QIAGEN QIAquick PCR Purification Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "28106";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_QIAquick_PCR_Purification'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_QIAquick_PCR_Purification\" id=\"QIAGEN_QIAquick_PCR_Purification\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "3";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "QIAGEN QIAquick Gel Extraction Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "28706";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_QIAquick_Gel_Extraction'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_QIAquick_Gel_Extraction\" id=\"QIAGEN_QIAquick_Gel_Extraction\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
		echo "4";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "QIAGEN RNeasy Mini Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "74106";
		echo "</td>";		
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_RNeasy_Mini'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_RNeasy_Mini\" id=\"QIAGEN_RNeasy_Mini\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";
		
		/* TABLE F */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";
		
		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\" width=\"500\">";
		echo "<b>F: Remarks (if you need to explain in detail)</b>";
		echo "</td>";
		echo "<td align=\"center\" width=\"500\">";
		echo "Total Expenditure";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<textarea name=\"remark\" rows=\"3\" style=\"width:500px\"></textarea>";
		echo "</td>";
		echo "<td align=\"center\" width=\"500\">";
		echo "<span id=\"total_cost\" name=\"total_cost\"></span><input type=\"hidden\" id=\"total_cost_value\" style=\"width: 500;\" name=\"total_cost_value\">";
		echo " MOP";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		echo "<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
		echo "</form>";
	}
	else{
		$Friday =date("ymd", strtotime("Friday"));
		$Tuesday =date("ymd", strtotime("Tuesday"));
		ini_set("date.timezone","Asia/Shanghai");

		$collect_date="";
		$collect_date_detail="";
		
		if($Friday>$Tuesday){
			if(date("ymd",strtotime("Tuesday"))==date("ymd")){
				$collect_date="Friday";	
				$collect_date_detail=date("d/m/Y", strtotime("Friday"));		
			}
			else{
				$collect_date="Tuesday";
				$collect_date_detail=date("d/m/Y", strtotime("Tuesday"));	
			}
		}
		else{
			if(date("ymd",strtotime("Friday"))==date("ymd")){
				$collect_date="Tuesday";
				$collect_date_detail=date("d/m/Y", strtotime("Tuesday"));		
			}
			else{
				$collect_date="Friday";	
				$collect_date_detail=date("d/m/Y", strtotime("Friday"));	
			}
		}

		$Submitter_Name=$_GET['Submitter_Name'];
		$Sample_Name=$_GET['Sample_Name'];
		
		$DNA_High_sensitivty_chip=$_GET['DNA_High_sensitivty_chip'];
		$RNA_Nano=$_GET['RNA_Nano'];
		$NEBNEXT_PloyA=$_GET['NEBNEXT_PloyA'];
		
		$NEBNEXT_Ultra_set1=$_GET['NEBNEXT_Ultra_set1'];
		$NEBNEXT_Ultra_II_set1=$_GET['NEBNEXT_Ultra_II_set1'];
		$NEB_Index=$_GET['NEB_Index'];
		
		$NEBNEXT_Ultra_set2=$_GET['NEBNEXT_Ultra_set2'];
		$NEBNEXT_Ultra_II_set2=$_GET['NEBNEXT_Ultra_II_set2'];
		
		$NEBNEXT_Ultra_noIndex=$_GET['NEBNEXT_Ultra_noIndex'];
		$NEBNEXT_Ultra_II_noIndex=$_GET['NEBNEXT_Ultra_II_noIndex'];
		
		$NEB_Index_2=$_GET['NEB_Index_2'];

		$NEB_Quickligation=$_GET['NEB_Quickligation'];
		$NEBNEXT_Ultra_II_96=$_GET['NEBNEXT_Ultra_II_96'];
		$Phusion_DNA_Pol=$_GET['Phusion_DNA_Pol'];
		$Primestar_DNA_Pol=$_GET['Primestar_DNA_Pol'];
		$Qubit_dsDNA_HS=$_GET['Qubit_dsDNA_HS'];

		/*CHANGE BELOW*/
		
		$Aline_Size=$_GET['Aline_Size'];
		$Aline_PCR=$_GET['Aline_PCR'];
		
		$QIAGEN_RNeasy_Mini=$_GET['QIAGEN_RNeasy_Mini'];
		$QIAGEN_QIAquick_PCR_Purification=$_GET['QIAGEN_QIAquick_PCR_Purification'];
		$QIAGEN_QIAquick_Gel_Extraction=$_GET['QIAGEN_QIAquick_Gel_Extraction'];
		
		$NEBNEXT_Ultra_II_EndRepair=$_GET['NEBNEXT_Ultra_II_EndRepair'];
		$Taq_DNA_Ligase=$_GET['Taq_DNA_Ligase'];
		$Aline_PCR_bottle=$_GET['Aline_PCR_bottle'];
		$Rnaseh=$_GET['Rnaseh'];
		$Spinminiprep=$_GET['Spinminiprep'];
		
		$total_cost=$_GET['total_cost_value'];
				
		$Remark=$_GET['remark'];
		$date=$_GET['date'];
		$Remark=htmlspecialchars($Remark,ENT_QUOTES);
		
		$result_tmp=search("select max(reagent_id) from genomics_core.reagent");
		
		if($result_tmp[0]['max(reagent_id)']==""){
			$result_tmp[0]['max(reagent_id)']=0;	
		}
		
		$RgRID="RgRID".($result_tmp[0]['max(reagent_id)']+1);
		
		/*CHANGE BELOW*/
		
		$value="'".($result_tmp[0]['max(reagent_id)']+1)."','$RgRID','$DNA_High_sensitivty_chip','$RNA_Nano','$NEBNEXT_PloyA','$NEBNEXT_Ultra_set1','$NEBNEXT_Ultra_set2','$NEBNEXT_Ultra_II_set1','$NEBNEXT_Ultra_II_set2','$NEBNEXT_Ultra_noIndex','$NEBNEXT_Ultra_II_noIndex', '$NEB_Index','$NEB_Index_2', '$NEB_Quickligation', '$NEBNEXT_Ultra_II_96', '$NEBNEXT_Ultra_II_EndRepair', '$Taq_DNA_Ligase', '$Phusion_DNA_Pol', '$Primestar_DNA_Pol', '$Qubit_dsDNA_HS', '$Aline_PCR', '$Aline_PCR_bottle', '$Aline_Size','$Rnaseh','$Spinminiprep','$QIAGEN_RNeasy_Mini','$QIAGEN_QIAquick_PCR_Purification','$QIAGEN_QIAquick_Gel_Extraction','$total_cost','".$_SESSION['username']."','".$result_user[0]['email']."','".$result_user[0]['lab']."','$date','$Remark'";
		
		/*CHANGE BELOW*/
		
		$name="reagent_id,RgRID,DNA_High_sensitivty_chip,RNA_Nano,NEBNEXT_PloyA,NEBNEXT_Ultra_set1,NEBNEXT_Ultra_set2,NEBNEXT_Ultra_II_set1,NEBNEXT_Ultra_II_set2,NEBNEXT_Ultra_noIndex,NEBNEXT_Ultra_II_noIndex,NEB_Index,NEB_Index_2,NEB_Quickligation,NEBNEXT_Ultra_II_96,NEBNEXT_Ultra_II_EndRepair,Taq_DNA_Ligase,Phusion_DNA_Pol,Primestar_DNA_Pol,Qubit_dsDNA_HS,Aline_PCR,Aline_PCR_bottle,Aline_Size,Rnaseh,Spinminiprep,QIAGEN_RNeasy_Mini,QIAGEN_QIAquick_PCR_Purification,QIAGEN_QIAquick_Gel_Extraction,total_cost,Submitter_Name,email,lab,date,remark";
		
		$conn = db_connect();
		$res=$conn->query("INSERT INTO genomics_core.reagent($name) VALUES (".$value.")");
		echo "INSERT INTO genomics_core.reagent($name) VALUES (".$value.")<br>";
				
		$request_record="";
		
		if($DNA_High_sensitivty_chip>0){
			$request_record.="Agilent DNA High Sensitivity Chip (11 Samples/Chip), Quantity(Per Chip) :  $DNA_High_sensitivty_chip<br>";	
		}
		if($RNA_Nano>0){
			$request_record.="Agilent RNA Nano Chip (12 Samples/Chip), Quantity(Per Chip) :  $RNA_Nano<br><br>";	
		}
		if($NEBNEXT_PloyA>0){
			$request_record.="NEB-NEXT Poly(A) mRNA magnetic isolation module, #E7490L, (12 Reaction/Set), Quantity(Per Set) : $NEBNEXT_PloyA<br>";	
		}
		if($NEBNEXT_Ultra_set1>0){
			$request_record.="NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index Set 1 (2.5µL, 10µM Per tube) : $NEBNEXT_Ultra_set1<br>";	
		}
		if($NEBNEXT_Ultra_set2>0){
			$request_record.="NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index Set 2 (2.5µL, 10µM Per tube) : $NEBNEXT_Ultra_set2<br>";	
		}
		if($NEBNEXT_Ultra_noIndex>0){
			$request_record.="NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), without Index: $NEBNEXT_Ultra_noIndex<br>";	
		}
		if($NEBNEXT_Ultra_II_set1>0){
			$request_record.="NEB-NEXT Ultra II DNA Library Prep Kit for Illumina,#E7645L, (12 Reaction/Set), with 12 NEB Index Set 1 (5µL, 10µM) : $NEBNEXT_Ultra_II_set1<br>";	
		}
		if($NEBNEXT_Ultra_II_set2>0){
			$request_record.="NEB-NEXT Ultra II DNA Library Prep Kit for Illumina,#E7645L, (12 Reaction/Set), with 12 NEB Index Set 2 (5µL, 10µM) : $NEBNEXT_Ultra_II_set2<br>";	
		}
		if($NEBNEXT_Ultra_II_noIndex>0){
			$request_record.="NEB-NEXT Ultra II DNA Library Prep Kit for Illumina, #E7645L, (12 Reaction/Set), without Index : $NEBNEXT_Ultra_II_noIndex<br>";	
		}
		if($NEB_Index>0){
			$request_record.="NEB Index(2.5µL, 10µM, Per Reaction), Quantity(Per Reaction) : $NEB_Index<br>";	
		}
		if($NEB_Index_2>0){
			$request_record.="*NEB Index (5µL, 10µM), with Universal PCR Primers, Quantity(5 µL, 10µM) : $NEB_Index_2<br>";	
		}
		if($NEB_Quickligation>0){
			$request_record.="NEB #: M2200L Quick Ligation&trade; Kit, 150 reactions : $NEB_Quickligation<br>";	
		}
		if($NEBNEXT_Ultra_II_96>0){
			$request_record.="NEB #: E7645L NEBNext&reg; Ultra&trade; II DNA Library Prep Kit for Illumina (96 reactions) : $NEBNEXT_Ultra_II_96<br>";	
		}
		if($Phusion_DNA_Pol>0){
			$request_record.="Phusion High-Fidelity DNA Polymerase - 500 units : $Phusion_DNA_Pol<br>";	
		}
		if($Primestar_DNA_Pol>0){
			$request_record.="Takara PrimeSTAR GXL DNA Polymerase (250 units) : $Primestar_DNA_Pol<br>";	
		}		
		if($Qubit_dsDNA_HS>0){
			$request_record.="Invitrogen Qubit&trade; dsDNA HS Assay with Assay Tubes : $Qubit_dsDNA_HS<br>";	
		}		
	
		/*CHANGE BELOW*/		
		
		if($Aline_PCR>0){
			$request_record.="Aline PCR clean up DX beads, #C-1003, Quantity(1 mL Per Tube) : $Aline_PCR<br>";	
		}
		if($Aline_Size>0){
			$request_record.="Aline Size selector-1 beads, #Z-6001, Quantity(1 mL Per Tube) : $Aline_Size<br>";	
		}
		if($Rnaseh>0){
			$request_record.="Takara SYBR Premix Ex Taq (Tli RNaseH Plus), #RR420A (200 reactions) : $Rnaseh<br>";	
		}
		if($Spinminiprep>0){
			$request_record.="QlAprep Spin Miniprep kit, #27106 : $Spinminiprep<br>";	
		}
		if($QIAGEN_RNeasy_Mini>0){
			$request_record.="QIAGEN RNeasy Mini Kit (250): $QIAGEN_RNeasy_Mini<br>";	
		}
		if($QIAGEN_QIAquick_PCR_Purification>0){
			$request_record.="QIAGEN QIAquick PCR Purification Kit (250) : $QIAGEN_QIAquick_PCR_Purification<br>";	
		}
		if($QIAGEN_QIAquick_Gel_Extraction>0){
			$request_record.="QIAGEN QIAquick Gel Extraction Kit (250) : $QIAGEN_QIAquick_Gel_Extraction<br>";	
		}
		if($NEBNEXT_Ultra_II_EndRepair>0){
			$request_record.="NEBNext&reg; #E7546L Ultra&trade; II End Repair/dA-Tailing Module: $NEBNEXT_Ultra_II_EndRepair<br>";	
		}
		if($Taq_DNA_Ligase>0){
			$request_record.="Taq #M0208L DNA Ligase: $Taq_DNA_Ligase<br>";	
		}
		if($Aline_PCR_bottle>0){
			$request_record.="Aline PCR bottle clean up DX beads: $Aline_PCR_bottle<br>";	
		}

		$request_record.="Total Cost: $total_cost<br>";	
		
		if($Remark!=""){
			$request_record.="Remark : $Remark<br>";	
		}
		
		if (!$res){
			echo "<span style=\"color:red\">Your request submission failed. Please contact Genomics Core Tech.</span>";
		}
		else{
			
			$result_lab=search("select * from lab where lab_name='".$result_user[0]['lab']."'");
			
			$tomail=$result_lab[0]['director_email'].",".$result_user[0]['email'];
			#$tomail="niranjan.shirgaonkar@gmail.com";
			require('email_CC.php');
			$tomail_arr=explode(',',$tomail);
			$main_mesg="Dear ".$_SESSION['username']." and ".$result_lab[0]['lab_director'].",<br><br>Thank you for requesting the following reagents. Your reagent (<a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=$RgRID\">$RgRID</a>) will be ready for collection on $collect_date ($collect_date_detail).<br><br>RgRID: <a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=$RgRID\">$RgRID</a>, Request summary:<br>".$request_record."<br><br>Please note the Reagent Request ID(<font color=\"red\">RgRID</font>) for reference and find the reagent request information from this link: <a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=$RgRID\">Genomics Core database Reagent Request</a>.<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Genomics Core database</a>. Please do not reply to this email address. For any queries, please contact the Genomics Core Support team.";

			#$main_mesg.="<br><br>RgRID:$RgRID, Request summary:<br>".$request_record."<br><br>";
			$Subject="FYI: Reagent request of ".$_SESSION['username']." from ".$result_user[0]['lab']."  ($RgRID).";
			$CC_arr=explode(',',$CC);

			if($tomail!=""){
				
				echo "<p><b style=\"color:red\">Reagent request submitted successfully.</b><br><br></p>";
				
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
					echo "<p>Email Sent.<br><br>Sent to: $tomail<br>CC:$CC<br>Record:<br>$request_record<br><br></p>";
				}
			}
		}
	}
	?>

</body>
</html>