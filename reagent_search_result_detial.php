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
	margin-left:20%;
	margin-right:20%;
	background-color: #e6ecff;
}
</style>
</head>

<body>
<br>
<?php 
session_start();
require('login.php');?> 

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
		var v81=document.getElementById("Aline_Size_selector_1_beads_bottle").value;
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
		var v73=document.getElementById("SYBR_gelstain").value;
		
		var vd1=document.getElementById("QIAGEN_RNeasy_Mini").value;
		var vd2=document.getElementById("QIAGEN_QIAquick_PCR_Purification").value;
		var vd3=document.getElementById("QIAGEN_QIAquick_Gel_Extraction").value;

		var vd4=document.getElementById("Agencourt_AMPure_XP").value;
		var vd5=document.getElementById("ChemGenes_Barcoded_beads").value;
		var vd6=document.getElementById("EQ_Four_Element_Calibration_Beads").value;
		var vd7=document.getElementById("Maxpar_Antibody_Labeling_Kit").value;
		var vd8=document.getElementById("Cell_ID_Intercalator_Ir").value;
		var vd9=document.getElementById("Cell_ID_Cisplatin").value;
		var vd10=document.getElementById("Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit").value;
		var vd11=document.getElementById("Centrifugal_Filter_Unit_3kDa").value;
		var vd12=document.getElementById("Centrifugal_Filter_Unit_50kDa").value;
		var vd13=document.getElementById("Maxpar_Cell_Staining_Buffer").value;

		var vd14=document.getElementById("Eppendorf_8Tube_Strips_with_Caps").value;
		var vd15=document.getElementById("Rainin_Wide_orifice_pipette_tips").value;


		var pv1=<?php echo $result_price_array["DNA_High_sensitivty_chip"]?>;
		var pv2=<?php echo $result_price_array["RNA_Nano"]?>;
		var pv3=<?php echo $result_price_array["NEBNEXT_PloyA"]?>;
		var pv41=<?php echo $result_price_array["NEBNEXT_Ultra_set1"]?>;
		var pv51=<?php echo $result_price_array["NEBNEXT_Ultra_II_set1"]?>;
		var pv61=<?php echo $result_price_array["NEB_Index"]?>;
		var pv7=<?php echo $result_price_array["Aline_PCR"]?>;
		var pv8=<?php echo $result_price_array["Aline_Size"]?>;
		var pv81=<?php echo $result_price_array["Aline_Size_selector_1_beads_bottle"]?>;
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
		var pv73=<?php echo $result_price_array["SYBR_gelstain"]?>;
		
		var pvd1=<?php echo $result_price_array["QIAGEN_RNeasy_Mini"]?>;
		var pvd2=<?php echo $result_price_array["QIAGEN_QIAquick_PCR_Purification"]?>;
		var pvd3=<?php echo $result_price_array["QIAGEN_QIAquick_Gel_Extraction"]?>;

		var pvd4=<?php echo $result_price_array["Agencourt_AMPure_XP"]?>;
		var pvd5=<?php echo $result_price_array["ChemGenes_Barcoded_beads"]?>;
		var pvd6=<?php echo $result_price_array["EQ_Four_Element_Calibration_Beads"]?>;
		var pvd7=<?php echo $result_price_array["Maxpar_Antibody_Labeling_Kit"]?>;
		var pvd8=<?php echo $result_price_array["Cell_ID_Intercalator_Ir"]?>;
		var pvd9=<?php echo $result_price_array["Cell_ID_Cisplatin"]?>;
		var pvd10=<?php echo $result_price_array["Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit"]?>;
		var pvd11=<?php echo $result_price_array["Centrifugal_Filter_Unit_3kDa"]?>;
		var pvd12=<?php echo $result_price_array["Centrifugal_Filter_Unit_50kDa"]?>;
		var pvd13=<?php echo $result_price_array["Maxpar_Cell_Staining_Buffer"]?>;

		var pvd14=<?php echo $result_price_array["Eppendorf_8Tube_Strips_with_Caps"]?>;
		var pvd15=<?php echo $result_price_array["Rainin_Wide_orifice_pipette_tips"]?>;

		/*CHANGE BELOW*/		
		
		var cost= v1*pv1 + v2*pv2 + v3*pv3 + v41*pv41 + v51*pv51 + v61*pv61 + v42*pv42 + v52*pv52 + v62*pv62 + v63*pv63 + v64*pv64 + v65*pv65 + v66*pv66 + v67*pv67 + v68*pv68 + v69*pv69 + v7*pv7 + v70*pv70 + v71*pv71 + v72*pv72 + v73*pv73 + v8*pv8 + vd1*pvd1 + vd2*pvd2 + vd3*pvd3 + v43*pv43  + v53*pv53 + v81*pv81 + vd4*pvd4 + vd5*pvd5 + vd6*pvd6 + vd7*pvd7 + vd8*pvd8 + vd9*pvd9 + vd10*pvd10 + vd11*pvd11 + vd12*pvd12 + vd13*pvd13 + vd14*pvd14 + vd15*pvd15;
		document.getElementById("total_cost").innerHTML=cost;
		document.getElementById("total_cost_value").value=cost;
       }
</script>

<hr>
<br>	
<h6>REQUEST FORM<h6>
<br>
<table>
  <tr>
    <td align="left" valign="top" width="1000px">
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
	
	<?php 
	$result_price=search("select * from price_table");
	$result_price_array=array();

	for($i=0;$i<count($result_price);$i++){
		$result_price_array[$result_price[$i]['name']]=$result_price[$i]['price'];
	}
	?>
     					
    </td>
    <td valign="top">
    <?php require("search_reagent.php");?>
    </td>
  </tr>
</table>
<br>

<?php

$RgRID=$_GET['RgRID'];
$edit=$_GET['edit'];

if($edit=="edit"){
	$Submitter_Name=$_GET['Submitter_Name'];
	$lab=$_GET['lab'];
	$date=$_GET['date'];

	$DNA_High_sensitivty_chip=$_GET['DNA_High_sensitivty_chip'];
	$RNA_Nano=$_GET['RNA_Nano'];
	$NEBNEXT_PloyA=$_GET['NEBNEXT_PloyA'];
	$NEBNEXT_Ultra_set1=$_GET['NEBNEXT_Ultra_set1'];
	$NEBNEXT_Ultra_set2=$_GET['NEBNEXT_Ultra_set2'];
	$NEBNEXT_Ultra_noIndex=$_GET['NEBNEXT_Ultra_noIndex'];
	
	$NEB_Index=$_GET['NEB_Index'];
	$NEB_Index_2=$_GET['NEB_Index_2'];
	$NEBNEXT_Ultra_II_set1=$_GET['NEBNEXT_Ultra_II_set1'];
	$NEBNEXT_Ultra_II_set2=$_GET['NEBNEXT_Ultra_II_set2'];
	$NEBNEXT_Ultra_II_noIndex=$_GET['NEBNEXT_Ultra_II_noIndex'];
	
	$NEB_Quickligation=$_GET['NEB_Quickligation'];
	$NEBNEXT_Ultra_II_96=$_GET['NEBNEXT_Ultra_II_96'];
	$Phusion_DNA_Pol=$_GET['Phusion_DNA_Pol'];
	$Primestar_DNA_Pol=$_GET['Primestar_DNA_Pol'];
	$Qubit_dsDNA_HS=$_GET['Qubit_dsDNA_HS'];	
	
	/*CHANGE BELOW*/
	
	$Aline_PCR=$_GET['Aline_PCR'];
	$Aline_Size=$_GET['Aline_Size'];
	$Aline_Size_selector_1_beads_bottle=$_GET['Aline_Size_selector_1_beads_bottle'];

	$Rnaseh=$_GET['Rnaseh'];
	$Spinminiprep=$_GET['Spinminiprep'];
	
	$QIAGEN_RNeasy_Mini=$_GET['QIAGEN_RNeasy_Mini'];
	$QIAGEN_QIAquick_PCR_Purification=$_GET['QIAGEN_QIAquick_PCR_Purification'];
	$QIAGEN_QIAquick_Gel_Extraction=$_GET['QIAGEN_QIAquick_Gel_Extraction'];
	
	$NEBNEXT_Ultra_II_EndRepair=$_GET['NEBNEXT_Ultra_II_EndRepair'];
	$Taq_DNA_Ligase=$_GET['Taq_DNA_Ligase'];
	$Aline_PCR_bottle=$_GET['Aline_PCR_bottle'];
	$SYBR_gelstain=$_GET['SYBR_gelstain'];

    $Agencourt_AMPure_XP=$_GET['Agencourt_AMPure_XP'];
    $ChemGenes_Barcoded_beads=$_GET['ChemGenes_Barcoded_beads'];

    $EQ_Four_Element_Calibration_Beads=$_GET['EQ_Four_Element_Calibration_Beads'];
    $Maxpar_Antibody_Labeling_Kit=$_GET['Maxpar_Antibody_Labeling_Kit'];
    $Cell_ID_Intercalator_Ir=$_GET['Cell_ID_Intercalator_Ir'];
    $Cell_ID_Cisplatin=$_GET['Cell_ID_Cisplatin'];
    $Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit=$_GET['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
    $Centrifugal_Filter_Unit_3kDa=$_GET['Centrifugal_Filter_Unit_3kDa'];
    $Centrifugal_Filter_Unit_50kDa=$_GET['Centrifugal_Filter_Unit_50kDa'];
    $Maxpar_Cell_Staining_Buffer=$_GET['Maxpar_Cell_Staining_Buffer'];

    $Eppendorf_8Tube_Strips_with_Caps=$_GET['Eppendorf_8Tube_Strips_with_Caps'];
    $Rainin_Wide_orifice_pipette_tips=$_GET['Rainin_Wide_orifice_pipette_tips'];

    $total_cost=$_GET['total_cost'];
	
	$distributed=$_GET['distributed'];
	$PI_approval=$_GET['PI_approval'];
	$remark=$_GET['remark'];
	
	$conn = db_connect();
	
	$value="Submitter_Name='$Submitter_Name',";
	$value.="lab='$lab',";
	$value.="date='$date',";
	$value.="DNA_high_sensitivty_chip='$DNA_High_sensitivty_chip',";
	$value.="RNA_Nano='$RNA_Nano',";
	$value.="NEBNEXT_PloyA='$NEBNEXT_PloyA',";
	$value.="NEBNEXT_Ultra_set1='$NEBNEXT_Ultra_set1',";
	$value.="NEBNEXT_Ultra_set2='$NEBNEXT_Ultra_set2',";
	$value.="NEBNEXT_Ultra_noIndex='$NEBNEXT_Ultra_noIndex',";
	$value.="NEB_Index='$NEB_Index',";
	$value.="NEB_Index_2='$NEB_Index_2',";
	$value.="NEBNEXT_Ultra_II_set1='$NEBNEXT_Ultra_II_set1',";
	$value.="NEBNEXT_Ultra_II_set2='$NEBNEXT_Ultra_II_set2',";
	$value.="NEBNEXT_Ultra_II_noIndex='$NEBNEXT_Ultra_II_noIndex',";

	$value.="NEB_Quickligation='$NEB_Quickligation',";
	$value.="NEBNEXT_Ultra_II_96='$NEBNEXT_Ultra_II_96',";
	$value.="Phusion_DNA_Pol='$Phusion_DNA_Pol',";
	$value.="Primestar_DNA_Pol='$Primestar_DNA_Pol',";
	$value.="Qubit_dsDNA_HS='$Qubit_dsDNA_HS',";	
	
	/*CHANGE BELOW*/
	
	$value.="Aline_PCR='$Aline_PCR',";
	$value.="Aline_Size='$Aline_Size',";
	$value.="Aline_Size_selector_1_beads_bottle='$Aline_Size_selector_1_beads_bottle',";
	
	$value.="Rnaseh='$Rnaseh',";
	$value.="Spinminiprep='$Spinminiprep',";	
	
	$value.="QIAGEN_RNeasy_Mini='$QIAGEN_RNeasy_Mini',";
	$value.="QIAGEN_QIAquick_PCR_Purification='$QIAGEN_QIAquick_PCR_Purification',";
	$value.="QIAGEN_QIAquick_Gel_Extraction='$QIAGEN_QIAquick_Gel_Extraction',";
	
	$value.="NEBNEXT_Ultra_II_EndRepair='$NEBNEXT_Ultra_II_EndRepair',";
	$value.="Taq_DNA_Ligase='$Taq_DNA_Ligase',";
	$value.="Aline_PCR_bottle='$Aline_PCR_bottle',";
	$value.="SYBR_gelstain='$SYBR_gelstain',";

	$value.="Agencourt_AMPure_XP='$Agencourt_AMPure_XP',";
	$value.="ChemGenes_Barcoded_beads='$ChemGenes_Barcoded_beads',";

    $value.="EQ_Four_Element_Calibration_Beads='$EQ_Four_Element_Calibration_Beads',";
    $value.="Maxpar_Antibody_Labeling_Kit='$Maxpar_Antibody_Labeling_Kit',";
    $value.="Cell_ID_Intercalator_Ir='$Cell_ID_Intercalator_Ir',";
    $value.="Cell_ID_Cisplatin='$Cell_ID_Cisplatin',";
    $value.="Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit='$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit',";
    $value.="Centrifugal_Filter_Unit_3kDa='$Centrifugal_Filter_Unit_3kDa',";
    $value.="Centrifugal_Filter_Unit_50kDa='$Centrifugal_Filter_Unit_50kDa',";
    $value.="Maxpar_Cell_Staining_Buffer='$Maxpar_Cell_Staining_Buffer',";

    $value.="Eppendorf_8Tube_Strips_with_Caps='$Eppendorf_8Tube_Strips_with_Caps',";
    $value.="Rainin_Wide_orifice_pipette_tips='$Rainin_Wide_orifice_pipette_tips',";


    $value.="total_cost='$total_cost',";
	$value.="distributed='$distributed',";
	$value.="PI_approval='$PI_approval',";
	$value.="remark='$remark'";
	
	$res=$conn->query("UPDATE genomics_core.reagent SET $value where RgRID='".$RgRID."'");
	
	if (!$res){
		echo "UPDATE genomics_core.reagent SET $value where RgRID='".$RgRID."'<br>";
		echo "Sample information update failed.<br><br>";
		
	}
	else{
		#echo "UPDATE genomics_core.reagent SET $value where RgRID='".$RgRID."'<br>";
		echo "Sample information updated successfully.<br><br>";
	}
	
}

$result_search=search("select * from genomics_core.reagent where RgRID='$RgRID'");
if(count($result_search)>0){
	if($result_user[0]['main']=="y"){	
		echo "<form action=\"reagent_search_result_detial.php\" method=\"get\">";
		
		echo "<table border=\"1\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<tr align=\"center\"/>";
		echo "<td width=\"10%\">";
		echo "Submitter_Name:";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"text\" name=\"Submitter_Name\" value=\"".$result_search[0]['Submitter_Name']."\"/>";
		echo "</td>";
		echo "<td>";
		echo "Email:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"text\"  name=\"lab\" value=\"".$result_search[0]['email']."\"/>";
		echo "</td>";
		echo "<td>";
		echo "Lab:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"text\"  name=\"lab\" value=\"".$result_search[0]['lab']."\"/>";
		echo "</td>";
		echo "<td>";
		echo "Date:";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"hidden\" name=\"edit\" value=\"edit\"/>";
		echo "<input type=\"hidden\" name=\"RgRID\" value=\"$RgRID\"/>";
		echo "<input type=\"text\"  name=\"date\" value=\"".$result_search[0]['date']."\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Prices updated on 12/02/2019.</span><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";
		
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>A: DNA Quantification Kits</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Agilent DNA High Sensitivity Chip (11 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "5067-4626";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['DNA_High_sensitivty_chip'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Chip</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"DNA_High_sensitivty_chip\"  value=\"".$result_search[0]['DNA_High_sensitivty_chip']."\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Agilent RNA Nano Chip (12 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "5067-1511	";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['RNA_Nano'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Chip</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"RNA_Nano\"  value=\"".$result_search[0]['RNA_Nano']."\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"Qubit_dsDNA_HS\"  value=\"".$result_search[0]['Qubit_dsDNA_HS']."\">";
		echo "</td>";
		echo "</tr>";	
		
		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>B: Library prep Reagents (NEB)</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
			
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"NEBNEXT_PloyA\"  value=\"".$result_search[0]['NEBNEXT_PloyA']."\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_set1\" id=\"NEBNEXT_Ultra_set1\" value=\"".$result_search[0]['NEBNEXT_Ultra_set1']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_set2\" id=\"NEBNEXT_Ultra_set2\" value=\"".$result_search[0]['NEBNEXT_Ultra_set2']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_noIndex\" id=\"NEBNEXT_Ultra_noIndex\" value=\"".$result_search[0]['NEBNEXT_Ultra_noIndex']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_set1\" id=\"NEBNEXT_Ultra_II_set1\"  value=\"".$result_search[0]['NEBNEXT_Ultra_II_set1']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_set2\" id=\"NEBNEXT_Ultra_II_set2\"  value=\"".$result_search[0]['NEBNEXT_Ultra_II_set2']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_noIndex\" id=\"NEBNEXT_Ultra_II_noIndex\" value=\"".$result_search[0]['NEBNEXT_Ultra_II_noIndex']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "8";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina (96 reactions)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7645L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_96'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_96\" id=\"NEBNEXT_Ultra_II_96\" value=\"".$result_search[0]['NEBNEXT_Ultra_II_96']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index\" id=\"NEB_Index\" value=\"".$result_search[0]['NEB_Index']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "10";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_2'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index_2\" id=\"NEB_Index_2\" value=\"".$result_search[0]['NEB_Index_2']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";	
		
		/*CHANGE BELOW*/
		
		echo "</table><br>";
		
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Index will be distributed based on the number of reactions.</span><br>";
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
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>C: Enzymes</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Quickligation\" id=\"NEB_Quickligation\" value=\"".$result_search[0]['NEB_Quickligation']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Phusion High-Fidelity DNA Polymerase, 500 units";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M0530L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Phusion_DNA_Pol'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Phusion_DNA_Pol\" id=\"Phusion_DNA_Pol\" value=\"".$result_search[0]['Phusion_DNA_Pol']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEBNEXT_Ultra_II_EndRepair\" id=\"NEBNEXT_Ultra_II_EndRepair\" value=\"".$result_search[0]['NEBNEXT_Ultra_II_EndRepair']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Taq_DNA_Ligase\" id=\"Taq_DNA_Ligase\" value=\"".$result_search[0]['Taq_DNA_Ligase']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Rnaseh\" id=\"Rnaseh\" value=\"".$result_search[0]['Rnaseh']."\" onchange=\"total_cost()\">";
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
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Primestar_DNA_Pol\" id=\"Primestar_DNA_Pol\" value=\"".$result_search[0]['Primestar_DNA_Pol']."\" onchange=\"total_cost()\">";
		echo "</td>";	
		echo "</tr>";
	
		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>D: Purification beads</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Aline PCR clean up DX beads (per mL)";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "C1003";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_PCR'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "1mL Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"Aline_PCR\"  value=\"".$result_search[0]['Aline_PCR']."\">";
		echo "</td>";
		echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "Aline PCR clean up DX beads (per bottle)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "C1003";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Aline_PCR_bottle'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "Per Bottle</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"Aline_PCR_bottle\"  value=\"".$result_search[0]['Aline_PCR_bottle']."\">";
        echo "</td>";
        echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Aline Size selector-1 beads (per mL)";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "Z6001";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_Size'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "1mL Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" style=\"width: 50px;\" name=\"Aline_Size\"  value=\"".$result_search[0]['Aline_Size']."\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "4";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Aline Size selector-1 beads (per bottle)";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "Z6001";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_Size_selector_1_beads_bottle'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "Per Bottle</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"Aline_Size_selector_1_beads_bottle\"  value=\"".$result_search[0]['Aline_Size_selector_1_beads_bottle']."\">";
		echo "</td>";
		echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"center\">";
        echo "5";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "Agencourt AMPure XP (per mL) *for DropSeq";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "A63881";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Agencourt_AMPure_XP'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1mL Per Tube</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" style=\"width: 50px;\" name=\"Agencourt_AMPure_XP\"  value=\"".$result_search[0]['Agencourt_AMPure_XP']."\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"center\">";
        echo "6";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "ChemGenes Barcoded beads *for DropSeq";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Macosko-2011-10";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['ChemGenes_Barcoded_beads'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Sample Per Tube</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" style=\"width: 50px;\" name=\"ChemGenes_Barcoded_beads\"  value=\"".$result_search[0]['ChemGenes_Barcoded_beads']."\">";
        echo "</td>";
        echo "</tr>";

		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>E: QIAGEN Kits</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
		echo "<td align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"Spinminiprep\" id=\"Spinminiprep\"  value=\"".$result_search[0]['Spinminiprep']."\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_QIAquick_PCR_Purification\" id=\"QIAGEN_QIAquick_PCR_Purification\"  value=\"".$result_search[0]['QIAGEN_QIAquick_PCR_Purification']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_QIAquick_Gel_Extraction\" id=\"QIAGEN_QIAquick_Gel_Extraction\"  value=\"".$result_search[0]['QIAGEN_QIAquick_Gel_Extraction']."\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 150px;\" name=\"QIAGEN_RNeasy_Mini\" id=\"QIAGEN_RNeasy_Mini\"  value=\"".$result_search[0]['QIAGEN_RNeasy_Mini']."\">";
		echo "</td>";
		echo "</tr>";
		
		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>F: Miscellaneous</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
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
			
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Invitrogen SYBR Safe DNA gel stain";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "S33102";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['SYBR_gelstain'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"5\" style=\"width: 50px;\" name=\"SYBR_gelstain\"  value=\"".$result_search[0]['SYBR_gelstain']."\">";
		echo "</td>";
		echo "</tr>";		

		echo "</table><br>";

        /* TABLE F */

        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
        echo "<tr>";
        echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
        echo "<b>F: Helios/Hyperion</b>";
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
        echo "EQ™ Four Element Calibration Beads (per sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201078";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['EQ_Four_Element_Calibration_Beads'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1mL Per Sample</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"EQ_Four_Element_Calibration_Beads\" id=\"EQ_Four_Element_Calibration_Beads\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar Antibody Labeling Kit, 150Nd (per reaction)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201150A";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Antibody_Labeling_Kit'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Reaction</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Maxpar_Antibody_Labeling_Kit\" id=\"Maxpar_Antibody_Labeling_Kit\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "3";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Cell-ID Intercalator-Ir 125 uM (1 test for 1 sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201192A";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Cell_ID_Intercalator_Ir'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test Per Tube</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Cell_ID_Intercalator_Ir\" id=\"Cell_ID_Intercalator_Ir\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "4";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Cell-ID Cisplatin (1 test for 1 sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201064";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Cell_ID_Cisplatin'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test Per Tube</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Cell_ID_Cisplatin\" id=\"Cell_ID_Cisplatin\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "5";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar® Human PB Basic Phenotyping Panel Kit, 7 Markers";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201302";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit\" id=\"Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "6";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Centrifugal Filter Unit: 3 kDa Amicon Ultra-500 µL V bottom";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "UFC500396";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Centrifugal_Filter_Unit_3kDa'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Unit</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Centrifugal_Filter_Unit_3kDa\" id=\"Centrifugal_Filter_Unit_3kDa\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "7";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Centrifugal Filter Unit: 50 kDa Amicon Ultra-500 µL V bottom";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "UFC505096";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Centrifugal_Filter_Unit_50kDa'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Unit</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Centrifugal_Filter_Unit_50kDa\" id=\"Centrifugal_Filter_Unit_50kDa\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "8";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar Cell Staining Buffer (per 5mL)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201068";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Cell_Staining_Buffer'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "5mL Per Tube</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Maxpar_Cell_Staining_Buffer\" id=\"Maxpar_Cell_Staining_Buffer\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "</table><br>";


        /* TABLE H */
        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
        echo "<tr>";
        echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
        echo "<b>H: 10x Genomics</b>";
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
        echo "Eppendorf 8-Tube x 0.2mL PCR Tube Strips with Caps";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "951010022";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Eppendorf_8Tube_Strips_with_Caps'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Strip</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Eppendorf_8Tube_Strips_with_Caps\" id=\"Eppendorf_8Tube_Strips_with_Caps\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Rainin Wide-orifice 1000µL pipette tips";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "30389218";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Rainin_Wide_orifice_pipette_tips'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Rack</td><td>";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Rainin_Wide_orifice_pipette_tips\" id=\"Rainin_Wide_orifice_pipette_tips\"  value=\"0\" onchange=\"total_cost()\">";
        echo "</td>";
        echo "</tr>";

        echo "</table><br>";


        /* TABLE Cost */

        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"2\" align=\"center\" height=\"40px\" width=\"700\" valign=\"middle\">";
		echo "<b>G: Remarks (if you need to explain in detail)</b>";
		echo "</td>";
		echo "<td align=\"center\" height=\"40px\" width=\"100\" valign=\"middle\">";
		echo "Total Expenses";
		echo "</td>";
		echo "<td align=\"center\" height=\"40px\" width=\"100\" valign=\"middle\">";
		echo "PI_approval<br>(Yes/No)";
		echo "</td>";
		echo "<td align=\"center\" height=\"40px\" width=\"100\" valign=\"middle\">";
		echo "Distribution<br>(Yes/No)";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td colspan=\"2\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<textarea name=\"remark\" rows=\"3\" style=\"width:690px\">".$result_search[0]['remark']."</textarea>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"text\" name=\"total_cost\"  style=\"width: 50px;\" value=\"".$result_search[0]['total_cost']."\" value=\"".$result_search[0]['total_cost']."\"/> MOP";
		echo "</td>";
		echo "<td align=\"center\"  valign=\"middle\">";

		echo "<select name=\"PI_approval\">";
		echo "<option value=\"Yes\" ";
		if($result_search[0]['PI_approval']=="Yes"){
			echo " selected=\"selected\" ";	
		}
		echo ">Yes</option>";
		echo "<option value=\"No\" ";
		if($result_search[0]['PI_approval']=="No"){
			echo " selected=\"selected\" ";	
		}
		echo ">No</option>";
		echo "</select>";
		echo "</td>";
		echo "<td align=\"center\" valign=\"middle\">";

		echo "<select name=\"distributed\">";
		echo "<option value=\"Yes\" ";
		if($result_search[0]['distributed']=="Yes"){
			echo " selected=\"selected\" ";	
		}
		echo ">Yes</option>";
		echo "<option value=\"No\" ";
		if($result_search[0]['distributed']=="No"){
			echo " selected=\"selected\" ";	
		}
		echo ">No</option>";
		echo "</select>";
		echo "</td>";
		echo "</tr>";
				
		echo "</table><br>";

		echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" value=\"Reset\" class=\"button\"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href=\"del_info_mysql.php?id=".$RgRID."&database=reagent\"><input type=\"button\" name=\"button3\" class=\"button\" id=\"button3\" onclick=\"javascript:return window.confirm('Do you confirm to delete this Request?');\"  value=\"Delete \" /></a>";
		echo "</form>";
	}
	else{
		
		echo "<table border=\"1\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<tr align=\"center\"/>";
		echo "<td width=\"10%\">";
		echo "Submitter_Name:";
		echo "</td>";
		echo "<td>";
		echo $result_search[0]['Submitter_Name'];
		echo "</td>";
		echo "<td>";
		echo "Email:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo $result_search[0]['email'];
		echo "</td>";
		echo "<td>";
		echo "Lab:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo $result_search[0]['lab'];
		echo "</td>";
		echo "<td>";
		echo "Date:";
		echo "</td>";
		echo "<td>";
	
		echo $result_search[0]['date'];
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		
		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Prices updated on 27/06/2018 .</span><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>A: DNA Quantification Kits</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Agilent DNA High Sensitivity Chip (11 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "5067-4626	";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['DNA_High_sensitivty_chip'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Chip</td><td align=\"center\">";		
		echo $result_search[0]['DNA_High_sensitivty_chip'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Agilent RNA Nano Chip (12 Samples/Chip)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "5067-1511	";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['RNA_Nano'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Chip</td><td align=\"center\">";
		echo $result_search[0]['RNA_Nano'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<td align=\"center\">";
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['Qubit_dsDNA_HS'];
		echo "</td>";
		echo "</tr>";		

		echo "</table><br>";

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>B: Library prep Reagents (NEB)</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";				
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<td align=\"center\">";
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_PloyA'];
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
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_set1'];
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
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_set2'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_noIndex'];
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
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_II_set1'];
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
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_II_set2'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo $result_search[0]['NEBNEXT_Ultra_II_noIndex'];
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40 px\">";
		echo "<td align=\"center\">";
		echo "8";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "NEB-NEXT&reg; Ultra&trade; II DNA Library Prep Kit, E7645L for Illumina&reg; (96 reactions)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEBNEXT_Ultra_II_96'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo $result_search[0]['NEBNEXT_Ultra_II_96'];
		echo "</td>";	
		echo "</tr>";	

		echo "<tr height=\"40\">";
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
		echo $result_search[0]['NEB_Index'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "10";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_2'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo $result_search[0]['NEB_Index_2'];
		echo "</td>";
		echo "</tr>";	
			
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
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>C: Enzymes</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" colspan=\"2\">";	
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
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['NEB_Quickligation'];
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "2";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Phusion High-Fidelity DNA Polymerase, 500 units";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M0530L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Phusion_DNA_Pol'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Phusion_DNA_Pol'];
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
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['NEBNEXT_Ultra_II_EndRepair'];
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
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Taq_DNA_Ligase'];
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
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Rnaseh'];
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
		echo "<td align=\"center\">";
		echo "Per Set</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Primestar_DNA_Pol'];
		echo "</td>";	
		echo "</tr>";
		
		echo "</table><br>";		
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>D: Purification beads</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\">";
		echo "Catalog #";
		echo "</td>";		
		echo "<td align=\"center\" width=\"100\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" width=\"150\"colspan=\"2\">";
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Aline PCR clean up DX beads (per mL)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "C1003";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_PCR'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100\">";
		echo "1 mL Per Tube</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Aline_PCR'];
		echo "</td>";
		echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Aline PCR clean up DX beads (per bottle)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "C1003";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Aline_PCR_bottle'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo "Per Bottle</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Aline_PCR_bottle'];
        echo "</td>";
        echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Aline Size selector-1 beads (per mL)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Z6001";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_Size'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "1 mL Per Tube</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Aline_Size'];
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "4";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "Aline Size selector-1 beads (per bottle)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Z6001";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Aline_Size_selector_1_beads_bottle'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Bottle</td>";
        echo "<td align=\"center\">";
		echo $result_search[0]['Aline_Size_selector_1_beads_bottle'];
		echo "</td>";
		echo "</tr>";

        echo "<tr align=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "5";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "Agencourt AMPure XP (per mL) *for DropSeq";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "A63881";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Agencourt_AMPure_XP'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1mL Per Tube</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Agencourt_AMPure_XP'];
        echo "</td>";
        echo "</tr>";

        echo "<tr align=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "6";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "ChemGenes Barcoded beads *for DropSeq";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Macosko-2011-10";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['ChemGenes_Barcoded_beads'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Sample Per Tube</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['ChemGenes_Barcoded_beads'];
        echo "</td>";
        echo "</tr>";
		
		echo "</table><br>";
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>E: QIAGEN Kits</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "QlAprep Spin Miniprep kit";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "27106";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Spinminiprep'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_search[0]['Spinminiprep'];
		echo "</td>";
		echo "</tr>";		
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "2";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "QIAGEN QIAquick PCR Purification Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "28106";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_QIAquick_PCR_Purification'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_search[0]['QIAGEN_QIAquick_PCR_Purification'];
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "3";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "QIAGEN QIAquick Gel Extraction Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "28706";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_QIAquick_Gel_Extraction'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_search[0]['QIAGEN_QIAquick_Gel_Extraction'];
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"center\">";
		echo "4";
		echo "</td>"; 
		echo "<td align=\"center\" >";
		echo "QIAGEN RNeasy Mini Kit (250) ";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "74106";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['QIAGEN_RNeasy_Mini'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_search[0]['QIAGEN_RNeasy_Mini'];
		echo "</td>";
		echo "</tr>";
		
		echo "</table><br>";
			
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>F: Miscellaneous</b>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr height=\"25px\" valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\" width=\"40px\">";
		echo "No.";
		echo "</td>"; 
		echo "<td align=\"center\" width=\"500px\">";
		echo "Name";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Catalog #";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Price (In MOP)";
		echo "</td>";
		echo "<td align=\"center\" colspan=\"2\">";	
		echo "Quantity";		
		echo "</td>";
		echo "</tr>";				
		
		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "1";
		echo "</td>"; 
		echo "<td align=\"center\">";
		echo "Invitrogen SYBR Safe DNA gel stain";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "S33102";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['SYBR_gelstain'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Set</td><td align=\"center\">";
		echo $result_search[0]['SYBR_gelstain'];
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";


        /* TABLE F */

        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
        echo "<tr>";
        echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
        echo "<b>F: Helios/Hyperion</b>";
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
        echo "EQ™ Four Element Calibration Beads (per sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201078";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['EQ_Four_Element_Calibration_Beads'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1mL Per Sample</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['EQ_Four_Element_Calibration_Beads'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar Antibody Labeling Kit, 150Nd (per reaction)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201150A";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Antibody_Labeling_Kit'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Reaction</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Maxpar_Antibody_Labeling_Kit'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "3";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Cell-ID Intercalator-Ir 125 uM (1 test for 1 sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201192A";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Cell_ID_Intercalator_Ir'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test Per Tube</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Cell_ID_Intercalator_Ir'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "4";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Cell-ID Cisplatin (1 test for 1 sample)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201064";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Cell_ID_Cisplatin'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test Per Tube</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Cell_ID_Cisplatin'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "5";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar® Human PB Basic Phenotyping Panel Kit, 7 Markers";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201302";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Test</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "6";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Centrifugal Filter Unit: 3 kDa Amicon Ultra-500 µL V bottom";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "UFC500396";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Centrifugal_Filter_Unit_3kDa'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Unit</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Centrifugal_Filter_Unit_3kDa'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "7";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Centrifugal Filter Unit: 50 kDa Amicon Ultra-500 µL V bottom";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "UFC505096";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Centrifugal_Filter_Unit_50kDa'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Unit</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Centrifugal_Filter_Unit_50kDa'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "8";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "Maxpar Cell Staining Buffer (per 5mL)";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "201068";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Maxpar_Cell_Staining_Buffer'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "5mL Per Tube</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Maxpar_Cell_Staining_Buffer'];
        echo "</td>";
        echo "</tr>";

        echo "</table><br>";

        /* TABLE H */

        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
        echo "<tr>";
        echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
        echo "<b>H: 10x Genomics</b>";
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
        echo "<i>Eppendorf</i> 8-Tube x 0.2mL PCR Tube Strips with Caps";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "951010022";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Eppendorf_8Tube_Strips_with_Caps'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Strip</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Eppendorf_8Tube_Strips_with_Caps'];
        echo "</td>";
        echo "</tr>";

        echo "<tr valign=\"middle\">";
        echo "<td height=\"40px\" align=\"center\">";
        echo "2";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "<i>Rainin</i> Wide-orifice 1000µL pipette tips";
        echo "</td>";
        echo "<td align=\"center\" >";
        echo "30389218";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['Rainin_Wide_orifice_pipette_tips'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "1 Reaction</td>";
        echo "<td align=\"center\">";
        echo $result_search[0]['Rainin_Wide_orifice_pipette_tips'];
        echo "</td>";
        echo "</tr>";

        echo "</table><br>";

        /* TABLE Cost */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"2\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>G: Remarks (if you need to explain in detail)</b>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Total Expense";
		echo "</td>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "PI_approval<br>(Yes/No)";
		echo "</td>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "Distribution<br>(Yes/No)";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=\"2\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo $result_search[0]['remark'];
		echo "</td>";
		
		echo "<td align=\"center\">";
		echo "<span id=\"total_cost\" name=\"total_cost\"></span><input type=\"hidden\" id=\"total_cost_value\" name=\"total_cost_value\">";
		echo "".$result_search[0]['total_cost']." MOP";
		
		echo "</td>";
		
		echo "<td align=\"center\"  valign=\"middle\">";

		echo $result_search[0]['PI_approval'];
		echo "</td>";
		echo "<td align=\"center\" valign=\"middle\">";

		echo $result_search[0]['distributed'];
		echo "</td>";
		echo "</tr>";
		
		echo "</table><br>";
		
	}
}	
else{
	echo "Record $RgRID does not exist.<br>";
}

?>

</body>
</html>