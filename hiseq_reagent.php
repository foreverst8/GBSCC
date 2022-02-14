<html>

<head>
	<style>
		body {
			margin-left: 20%;
			margin-right: 20%;
		}

		table,
		th,
		td {
			color: #002A60;
			font-family: sans-serif;
			font-size: 17px;
			font-weight: 100;
			margin-top: 2px;
			margin-bottom: 2px;
		}

		.test {
			font-family: sans-serif;
			font-size: 17px;
			font-weight: 100;
			display: inline;
			background-color: #ffffff;
			border: 2px solid #002A60;
			border-radius: 10px;
			color: #002A60;
			padding: 5px 5px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			-webkit-transition-duration: 0.4s;
			/* Safari */
			transition-duration: 0.4s;
			cursor: pointer;
		}

		.test:hover {
			background-color: #002A60;
			color: #e6ecff;
		}
	</style>
</head>

<body>
	<br>
	<?php session_start(); ?>
	<?php require('login.php'); ?>
	<hr>
	<br>
	<h6>REAGENT REQUEST</h6>
	<br>

	<?php
	$result_price = search("select * from price_table");
	$result_price_array = array();

	for ($i = 0; $i < count($result_price); $i++) {
		$result_price_array[$result_price[$i]['name']] = $result_price[$i]['price'];
	}


	$result_stock = search("select * from price_table");
	$result_stock_array = array();

	for ($i = 0; $i < count($result_stock); $i++) {
		$result_stock_array[$result_stock[$i]['name']] = $result_stock[$i]['stock'];
	}
	?>


	<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
	<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="jquery.editable-select.min.js"></script>
	<script type="text/javascript">
		function gradeChange1() {
			var objS = document.getElementById("Category");
			var val = objS.options[objS.selectedIndex].value;
			if (val == "Others") {
				//document.getElementById("ohter_category").style.display="block";
				document.getElementById("tb_cate").style.display = "block";
			} else {
				//document.getElementById("ohter_category").style.display="none";
				document.getElementById("tb_cate").style.display = "none";
			}
		}

		function gradeChange2() {
			var objS = document.getElementById("Kit");
			var val = objS.options[objS.selectedIndex].value;
			if (val == "Others") {
				//document.getElementById("ohter_kit").style.display="block";
				document.getElementById("tb_kit").style.display = "block";
			} else {
				//document.getElementById("ohter_kit").style.display="none";
				document.getElementById("tb_kit").style.display = "none";
			}
		}

		function gradeChange3() {
			var objS = document.getElementById("Index_Number");
			var val = objS.options[objS.selectedIndex].value;
			if (val == "1") {
				//document.getElementById("ohter_kit").style.display="block";
				document.getElementById("tb_index").style.display = "block";
				document.getElementById("span_index").style.display = "none";
			} else {
				//document.getElementById("ohter_kit").style.display="none";
				document.getElementById("tb_index").style.display = "none";
				document.getElementById("span_index").style.display = "block";
			}
		}

		function total_cost() {
			var v1 = document.getElementById("DNA_High_sensitivty_chip").value;
			var v2 = document.getElementById("RNA_Nano").value;
			var v3 = document.getElementById("NEBNEXT_PloyA").value;
			var v41 = document.getElementById("NEBNEXT_Ultra_set1").value;
			var v51 = document.getElementById("NEBNEXT_Ultra_II_set1").value;
			var v61 = document.getElementById("NEB_Index").value;
			var v7 = document.getElementById("Aline_PCR").value;
			var v8 = document.getElementById("Aline_Size").value;
			var v81 = document.getElementById("Aline_Size_selector_1_beads_bottle").value;
			var v42 = document.getElementById("NEBNEXT_Ultra_set2").value;
			var v52 = document.getElementById("NEBNEXT_Ultra_II_set2").value;
			var v43 = document.getElementById("NEBNEXT_Ultra_noIndex").value;
			var v53 = document.getElementById("NEBNEXT_Ultra_II_noIndex").value;
			var v62 = document.getElementById("NEB_Index_2").value;

			/*CHANGE BELOW*/

			var v63 = document.getElementById("NEB_Quickligation").value;
			var v64 = document.getElementById("NEBNEXT_Ultra_II_96").value;
			var v65 = document.getElementById("Phusion_DNA_Pol").value;
			var v66 = document.getElementById("Qubit_dsDNA_HS").value;
			var v67 = document.getElementById("Aline_PCR_bottle").value;
			var v68 = document.getElementById("NEBNEXT_Ultra_II_EndRepair").value;
			var v69 = document.getElementById("Taq_DNA_Ligase").value;
			var v70 = document.getElementById("Rnaseh").value;
			var v71 = document.getElementById("Spinminiprep").value;
			var v72 = document.getElementById("Primestar_DNA_Pol").value;
			var v73 = document.getElementById("SYBR_gelstain").value;

			var vd1 = document.getElementById("QIAGEN_RNeasy_Mini").value;
			var vd2 = document.getElementById("QIAGEN_QIAquick_PCR_Purification").value;

			var vd3 = document.getElementById("QIAGEN_QIAquick_Gel_Extraction").value;
			var vd4 = document.getElementById("Agencourt_AMPure_XP").value;
			var vd5 = document.getElementById("ChemGenes_Barcoded_beads").value;
			var vd6 = document.getElementById("EQ_Four_Element_Calibration_Beads").value;
			var vd7 = document.getElementById("Maxpar_Antibody_Labeling_Kit").value;
			var vd8 = document.getElementById("Cell_ID_Intercalator_Ir").value;
			var vd9 = document.getElementById("Cell_ID_Cisplatin").value;
			var vd10 = document.getElementById("Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit").value;
			var vd11 = document.getElementById("Centrifugal_Filter_Unit_3kDa").value;
			var vd12 = document.getElementById("Centrifugal_Filter_Unit_50kDa").value;
			var vd13 = document.getElementById("Maxpar_Cell_Staining_Buffer").value;

			var vd14 = document.getElementById("Eppendorf_8Tube_Strips_with_Caps").value;
			var vd15 = document.getElementById("Rainin_Wide_orifice_pipette_tips").value;

			var vd16 = document.getElementById("NEB_Index_fullset").value;
			var vd17 = document.getElementById("NEB_Index_2_fullset").value;
			var vd18 = document.getElementById("Q5_HighFidelity_DNA_Polymerase").value;


			var pv1 = <?php echo $result_price_array["DNA_High_sensitivty_chip"] ?>;
			var pv2 = <?php echo $result_price_array["RNA_Nano"] ?>;
			var pv3 = <?php echo $result_price_array["NEBNEXT_PloyA"] ?>;
			var pv41 = <?php echo $result_price_array["NEBNEXT_Ultra_set1"] ?>;
			var pv51 = <?php echo $result_price_array["NEBNEXT_Ultra_II_set1"] ?>;
			var pv61 = <?php echo $result_price_array["NEB_Index"] ?>;
			var pv7 = <?php echo $result_price_array["Aline_PCR"] ?>;
			var pv8 = <?php echo $result_price_array["Aline_Size"] ?>;
			var pv81 = <?php echo $result_price_array["Aline_Size_selector_1_beads_bottle"] ?>;
			var pv42 = <?php echo $result_price_array["NEBNEXT_Ultra_set2"] ?>;
			var pv52 = <?php echo $result_price_array["NEBNEXT_Ultra_II_set2"] ?>;
			var pv43 = <?php echo $result_price_array["NEBNEXT_Ultra_noIndex"] ?>;
			var pv53 = <?php echo $result_price_array["NEBNEXT_Ultra_II_noIndex"] ?>;
			var pv62 = <?php echo $result_price_array["NEB_Index_2"] ?>;

			/*CHANGE BELOW*/

			var pv63 = <?php echo $result_price_array["NEB_Quickligation"] ?>;
			var pv64 = <?php echo $result_price_array["NEBNEXT_Ultra_II_96"] ?>;
			var pv65 = <?php echo $result_price_array["Phusion_DNA_Pol"] ?>;
			var pv66 = <?php echo $result_price_array["Qubit_dsDNA_HS"] ?>;
			var pv67 = <?php echo $result_price_array["Aline_PCR_bottle"] ?>;
			var pv68 = <?php echo $result_price_array["NEBNEXT_Ultra_II_EndRepair"] ?>;
			var pv69 = <?php echo $result_price_array["Taq_DNA_Ligase"] ?>;
			var pv70 = <?php echo $result_price_array["Rnaseh"] ?>;
			var pv71 = <?php echo $result_price_array["Spinminiprep"] ?>;
			var pv72 = <?php echo $result_price_array["Primestar_DNA_Pol"] ?>;
			var pv73 = <?php echo $result_price_array["SYBR_gelstain"] ?>;

			var pvd1 = <?php echo $result_price_array["QIAGEN_RNeasy_Mini"] ?>;
			var pvd2 = <?php echo $result_price_array["QIAGEN_QIAquick_PCR_Purification"] ?>;
			var pvd3 = <?php echo $result_price_array["QIAGEN_QIAquick_Gel_Extraction"] ?>;

			var pvd4 = <?php echo $result_price_array["Agencourt_AMPure_XP"] ?>;
			var pvd5 = <?php echo $result_price_array["ChemGenes_Barcoded_beads"] ?>;
			var pvd6 = <?php echo $result_price_array["EQ_Four_Element_Calibration_Beads"] ?>;
			var pvd7 = <?php echo $result_price_array["Maxpar_Antibody_Labeling_Kit"] ?>;
			var pvd8 = <?php echo $result_price_array["Cell_ID_Intercalator_Ir"] ?>;
			var pvd9 = <?php echo $result_price_array["Cell_ID_Cisplatin"] ?>;
			var pvd10 = <?php echo $result_price_array["Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit"] ?>;
			var pvd11 = <?php echo $result_price_array["Centrifugal_Filter_Unit_3kDa"] ?>;
			var pvd12 = <?php echo $result_price_array["Centrifugal_Filter_Unit_50kDa"] ?>;
			var pvd13 = <?php echo $result_price_array["Maxpar_Cell_Staining_Buffer"] ?>;

			var pvd14 = <?php echo $result_price_array["Eppendorf_8Tube_Strips_with_Caps"] ?>;
			var pvd15 = <?php echo $result_price_array["Rainin_Wide_orifice_pipette_tips"] ?>;

			var pvd16 = <?php echo $result_price_array["NEB_Index_fullset"] ?>;
			var pvd17 = <?php echo $result_price_array["NEB_Index_2_fullset"] ?>;
			var pvd18 = <?php echo $result_price_array["Q5_HighFidelity_DNA_Polymerase"] ?>;

			/*CHANGE BELOW*/

			var cost = v1 * pv1 + v2 * pv2 + v3 * pv3 + v41 * pv41 + v51 * pv51 + v61 * pv61 + v42 * pv42 + v52 * pv52 + v62 * pv62 + v63 * pv63 + v64 * pv64 + v65 * pv65 + v66 * pv66 + v67 * pv67 + v68 * pv68 + v69 * pv69 + v7 * pv7 + v70 * pv70 + v71 * pv71 + v72 * pv72 + v73 * pv73 + v8 * pv8 + vd1 * pvd1 + vd2 * pvd2 + vd3 * pvd3 + v43 * pv43 + v53 * pv53 + v81 * pv81 + vd4 * pvd4 + vd5 * pvd5 + vd6 * pvd6 + vd7 * pvd7 + vd8 * pvd8 + vd9 * pvd9 + vd10 * pvd10 + vd11 * pvd11 + vd12 * pvd12 + vd13 * pvd13 + vd14 * pvd14 + vd15 * pvd15 + vd16 * pvd16 + vd17 * pvd17 + vd18 * pvd18;
			document.getElementById("total_cost").innerHTML = cost;
			document.getElementById("total_cost_value").value = cost;
		}
	</script>

	<table>
		<tr>
			<td align="left" valign="top">
				<?PHP
				$result_user = search("select * from user where user_name='" . $_SESSION['username'] . "' and hiseq='y'");
				$permission = $result_user[0]['hiseq'];
				if (count($result_user) == 0) {
					#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
					echo 'You do not have permission to access this page.<br />';
					exit;
				}
				?>

				<?php require "reagent_notice.php" ?>
			</td>

			<td valign="top">
				<?php require("search_reagent.php"); ?>
			</td>
		</tr>
	</table>

	<br>
	<hr><br>
	<?php
	if (!$_GET['Submitter_Name']) {

		echo "<h6>REQUEST FORM<h6><br>";

		echo "<form name=\"reagent\" action=\"hiseq_reagent.php#top\" method=\"get\">";
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
		echo "<tr height=\"30px\" align=\"left\"/>";
		echo "<td width=\"200\">";
		echo "&nbsp&nbspSubmitter:&nbsp";
		echo $result_user[0]['user_name'];
		echo "<input type=\"hidden\" name=\"Submitter_Name\" value=\"" . $result_user[0]['user_name'] . "\"/>";
		echo "</td>";
		echo "<td width=\"200\">";
		echo "&nbsp&nbspLab:&nbsp";
		echo $result_user[0]['lab'];
		echo "</td>";
		echo "<td width=\"200\">";
		echo "&nbsp&nbspDate:&nbsp";
		echo date("Y/m/d");
		echo "<input type=\"hidden\" name=\"date\" value=\"" . date("Y/m/d") . "\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";

		echo "<span style=\"color:gray;font-size:12px\">&nbsp;&nbsp;&nbsp;&nbsp;*Prices last updated on 12/02/2019.</span><br>";

		/* TABLE A */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";

		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
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
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
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
		echo "9a";
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
		echo "9b";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "*NEB Index (2.5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;<b>**full set</b>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_fullset'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index_fullset\" id=\"NEB_Index_fullset\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "10a";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;";
		echo "</td>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_2_fullset'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index_2\" id=\"NEB_Index_2\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr height=\"40px\">";
		echo "<td align=\"center\">";
		echo "10b";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;<b>**full set</b>";
		echo "</td>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "E7335L;E7500L";
		echo "<td align=\"center\">";
		echo $result_price_array['NEB_Index_2_fullset'];
		echo "</td>";
		echo "<td align=\"center\">";
		echo "Per Reaction</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"NEB_Index_2_fullset\" id=\"NEB_Index_2_fullset\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		/*CHANGE BELOW*/

		echo "</table>";
		echo "<span style=\"font-size:15px\"><b>**full set</b>: for every 5µl of Index, full set includes 2.5µl NEBNext Adaptor for Illumina, 3µl USER™ Enzyme and 5µl Universal PCR Primer.</span><br><br>";

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
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
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
		echo "Q5 High-Fidelity DNA Polymerase (500 units)";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "M0491L";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['Q5_HighFidelity_DNA_Polymerase'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Q5_HighFidelity_DNA_Polymerase\" id=\"Q5_HighFidelity_DNA_Polymerase\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td height=\"40px\" align=\"center\">";
		echo "6";
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
		echo "7";
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
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>D: Purification Beads</b>";
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

		echo "<tr valign=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_PCR\" id=\"Aline_PCR\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr align=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_PCR_bottle\" id=\"Aline_PCR_bottle\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr align=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_Size\" id=\"Aline_Size\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "<tr align=\"middle\">";
		echo "<td height=\"40px\" align=\"center\">";
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
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Aline_Size_selector_1_beads_bottle\" id=\"Aline_Size_selector_1_beads_bottle\"  value=\"0\" onchange=\"total_cost()\">";
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
		echo "1mL Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Agencourt_AMPure_XP\" id=\"Agencourt_AMPure_XP\"  value=\"0\" onchange=\"total_cost()\">";
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
		echo "1 Sample Per Tube</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"ChemGenes_Barcoded_beads\" id=\"ChemGenes_Barcoded_beads\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";


		/* TABLE E */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>E: Helios/Hyperion</b>";
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

		/* TABLE F */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>F: 10x Genomics</b>";
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
		echo "1 Strip</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Eppendorf_8Tube_Strips_with_Caps\" id=\"Eppendorf_8Tube_Strips_with_Caps\"  value=\"0\" onchange=\"total_cost()\">";
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
		echo "1 Rack</td><td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"Rainin_Wide_orifice_pipette_tips\" id=\"Rainin_Wide_orifice_pipette_tips\"  value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";

		/* TABLE G */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";

		echo "<tr>";
		echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>G: Miscellaneous</b>";
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
		echo "Invitrogen SYBR Safe DNA gel stain";
		echo "</td>";
		echo "<td align=\"center\" >";
		echo "S33102";
		echo "</td>";
		echo "<td align=\"center\">";
		echo $result_price_array['SYBR_gelstain'];
		echo "</td>";
		echo "<td align=\"center\" width=\"100px\">";
		echo "Per Set";
		echo "</td>";
		echo "<td>";
		echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"SYBR_gelstain\" id=\"SYBR_gelstain\" value=\"0\" onchange=\"total_cost()\">";
		echo "</td>";
		echo "</tr>";

		echo "</table><br>";


		/* TABLE H */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\"  width=\"1000\">";
		echo "<tr>";
		echo "<td colspan=\"5\" align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<b>H: QIAGEN Kits</b>";
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
		echo "QlAprep Spin Miniprep Kit<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
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
		echo "QIAGEN QIAquick PCR Purification Kit (250)<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
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
		echo "QIAGEN QIAquick Gel Extraction Kit (250)<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
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



		/* TABLE Cost */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"1000\">";

		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\" width=\"500\">";
		echo "<b>G: Remarks (if you need to explain in detail)</b>";
		echo "</td>";
		echo "<td align=\"center\" width=\"500\">";
		echo "<p style='color:#002A60'><b>Total Expenditure</b></p>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"center\" height=\"40px\" valign=\"middle\">";
		echo "<textarea name=\"remark\" rows=\"3\" style=\"width:500px\"></textarea>";
		echo "</td>";
		echo "<td align=\"center\" width=\"500\">";
		echo "<span id=\"total_cost\" name=\"total_cost\" style=\"display:none\"></span><input type=\"text\" value=\"0\" id=\"total_cost_value\" readonly=\"true\" style=\"width:90;height:30;font-family:sans-serif;font-size:20px;font-weight:700;color:#002A60;text-align:center;border:solid #e6ecff;background-color:#e6ecff;\" name=\"total_cost_value\"><p style='color:#002A60'><b>MOP</b></p>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br><br>";
		echo "<button class=\"test\" id=\"demo\" onclick=\"javascript:{this.disabled=true;document.reagent.submit();document.getElementById('demo').innerHTML='Waiting...';}\">Submit</button>";

		echo "</form>";

		echo "<br><p style=\"color:#002A60;font-size:12px;line-height:30px\">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p><br>";
	} else {
		$Friday = date("ymd", strtotime("Friday"));
		$Tuesday = date("ymd", strtotime("Tuesday"));
		ini_set("date.timezone", "Asia/Shanghai");

		$collect_date = "";
		$collect_date_detail = "";

		if ($Friday > $Tuesday) {
			if (date("ymd", strtotime("Tuesday")) == date("ymd")) {
				$collect_date = "Friday";
				$collect_date_detail = date("d/m/Y", strtotime("Friday"));
			} else {
				$collect_date = "Tuesday";
				$collect_date_detail = date("d/m/Y", strtotime("Tuesday"));
			}
		} else {
			if (date("ymd", strtotime("Friday")) == date("ymd")) {
				$collect_date = "Tuesday";
				$collect_date_detail = date("d/m/Y", strtotime("Tuesday"));
			} else {
				$collect_date = "Friday";
				$collect_date_detail = date("d/m/Y", strtotime("Friday"));
			}
		}

		$Submitter_Name = $_GET['Submitter_Name'];
		$Sample_Name = $_GET['Sample_Name'];

		$DNA_High_sensitivty_chip = $_GET['DNA_High_sensitivty_chip'];
		$RNA_Nano = $_GET['RNA_Nano'];
		$NEBNEXT_PloyA = $_GET['NEBNEXT_PloyA'];

		$NEBNEXT_Ultra_set1 = $_GET['NEBNEXT_Ultra_set1'];
		$NEBNEXT_Ultra_II_set1 = $_GET['NEBNEXT_Ultra_II_set1'];
		$NEB_Index = $_GET['NEB_Index'];

		$NEBNEXT_Ultra_set2 = $_GET['NEBNEXT_Ultra_set2'];
		$NEBNEXT_Ultra_II_set2 = $_GET['NEBNEXT_Ultra_II_set2'];

		$NEBNEXT_Ultra_noIndex = $_GET['NEBNEXT_Ultra_noIndex'];
		$NEBNEXT_Ultra_II_noIndex = $_GET['NEBNEXT_Ultra_II_noIndex'];

		$NEB_Index_2 = $_GET['NEB_Index_2'];

		$NEB_Quickligation = $_GET['NEB_Quickligation'];
		$NEBNEXT_Ultra_II_96 = $_GET['NEBNEXT_Ultra_II_96'];
		$Phusion_DNA_Pol = $_GET['Phusion_DNA_Pol'];
		$Primestar_DNA_Pol = $_GET['Primestar_DNA_Pol'];
		$Qubit_dsDNA_HS = $_GET['Qubit_dsDNA_HS'];

		/*CHANGE BELOW*/

		$Aline_Size = $_GET['Aline_Size'];
		$Aline_Size_selector_1_beads_bottle = $_GET['Aline_Size_selector_1_beads_bottle'];
		$Aline_PCR = $_GET['Aline_PCR'];

		$QIAGEN_RNeasy_Mini = $_GET['QIAGEN_RNeasy_Mini'];
		$QIAGEN_QIAquick_PCR_Purification = $_GET['QIAGEN_QIAquick_PCR_Purification'];
		$QIAGEN_QIAquick_Gel_Extraction = $_GET['QIAGEN_QIAquick_Gel_Extraction'];

		$NEBNEXT_Ultra_II_EndRepair = $_GET['NEBNEXT_Ultra_II_EndRepair'];
		$Taq_DNA_Ligase = $_GET['Taq_DNA_Ligase'];
		$Aline_PCR_bottle = $_GET['Aline_PCR_bottle'];
		$Rnaseh = $_GET['Rnaseh'];
		$Spinminiprep = $_GET['Spinminiprep'];
		$SYBR_gelstain = $_GET['SYBR_gelstain'];

		$Agencourt_AMPure_XP = $_GET['Agencourt_AMPure_XP'];
		$ChemGenes_Barcoded_beads = $_GET['ChemGenes_Barcoded_beads'];

		$EQ_Four_Element_Calibration_Beads = $_GET['EQ_Four_Element_Calibration_Beads'];
		$Maxpar_Antibody_Labeling_Kit = $_GET['Maxpar_Antibody_Labeling_Kit'];
		$Cell_ID_Intercalator_Ir = $_GET['Cell_ID_Intercalator_Ir'];
		$Cell_ID_Cisplatin = $_GET['Cell_ID_Cisplatin'];
		$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit = $_GET['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'];
		$Centrifugal_Filter_Unit_3kDa = $_GET['Centrifugal_Filter_Unit_3kDa'];
		$Centrifugal_Filter_Unit_50kDa = $_GET['Centrifugal_Filter_Unit_50kDa'];
		$Maxpar_Cell_Staining_Buffer = $_GET['Maxpar_Cell_Staining_Buffer'];

		$Eppendorf_8Tube_Strips_with_Caps = $_GET['Eppendorf_8Tube_Strips_with_Caps'];
		$Rainin_Wide_orifice_pipette_tips = $_GET['Rainin_Wide_orifice_pipette_tips'];

		$NEB_Index_fullset = $_GET['NEB_Index_fullset'];
		$NEB_Index_2_fullset = $_GET['NEB_Index_2_fullset'];
		$Q5_HighFidelity_DNA_Polymerase = $_GET['Q5_HighFidelity_DNA_Polymerase'];

		$total_cost = $_GET['total_cost_value'];

		$Remark = $_GET['remark'];
		$date = $_GET['date'];
		$Remark = htmlspecialchars($Remark, ENT_QUOTES);




		$result_tmp = search("select max(reagent_id) from genomics_core.reagent");

		if ($result_tmp[0]['max(reagent_id)'] == "") {
			$result_tmp[0]['max(reagent_id)'] = 0;
		}

		$RgRID = "RgRID" . ($result_tmp[0]['max(reagent_id)'] + 1);

		/*CHANGE BELOW*/

		$value = "'" . ($result_tmp[0]['max(reagent_id)'] + 1) . "','$RgRID','$DNA_High_sensitivty_chip','$RNA_Nano','$NEBNEXT_PloyA','$NEBNEXT_Ultra_set1','$NEBNEXT_Ultra_set2','$NEBNEXT_Ultra_II_set1','$NEBNEXT_Ultra_II_set2','$NEBNEXT_Ultra_noIndex','$NEBNEXT_Ultra_II_noIndex', '$NEB_Index','$NEB_Index_2', '$NEB_Quickligation', '$NEBNEXT_Ultra_II_96', '$NEBNEXT_Ultra_II_EndRepair', '$Taq_DNA_Ligase', '$Phusion_DNA_Pol', '$Primestar_DNA_Pol', '$Qubit_dsDNA_HS', '$Aline_PCR', '$Aline_PCR_bottle', '$Aline_Size','$Aline_Size_selector_1_beads_bottle','$Rnaseh','$Spinminiprep','$QIAGEN_RNeasy_Mini','$QIAGEN_QIAquick_PCR_Purification','$QIAGEN_QIAquick_Gel_Extraction','$SYBR_gelstain','$Agencourt_AMPure_XP','$ChemGenes_Barcoded_beads','$EQ_Four_Element_Calibration_Beads','$Maxpar_Antibody_Labeling_Kit','$Cell_ID_Intercalator_Ir','$Cell_ID_Cisplatin','$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit','$Centrifugal_Filter_Unit_3kDa','$Centrifugal_Filter_Unit_50kDa','$Maxpar_Cell_Staining_Buffer','$Eppendorf_8Tube_Strips_with_Caps','$Rainin_Wide_orifice_pipette_tips','$NEB_Index_fullset','$NEB_Index_2_fullset','$Q5_HighFidelity_DNA_Polymerase','$total_cost','" . $_SESSION['username'] . "','" . $result_user[0]['email'] . "','" . $result_user[0]['lab'] . "','$date','$Remark'";

		/*CHANGE BELOW*/

		$name = "reagent_id,RgRID,DNA_High_sensitivty_chip,RNA_Nano,NEBNEXT_PloyA,NEBNEXT_Ultra_set1,NEBNEXT_Ultra_set2,NEBNEXT_Ultra_II_set1,NEBNEXT_Ultra_II_set2,NEBNEXT_Ultra_noIndex,NEBNEXT_Ultra_II_noIndex,NEB_Index,NEB_Index_2,NEB_Quickligation,NEBNEXT_Ultra_II_96,NEBNEXT_Ultra_II_EndRepair,Taq_DNA_Ligase,Phusion_DNA_Pol,Primestar_DNA_Pol,Qubit_dsDNA_HS,Aline_PCR,Aline_PCR_bottle,Aline_Size,Aline_Size_selector_1_beads_bottle,Rnaseh,Spinminiprep,QIAGEN_RNeasy_Mini,QIAGEN_QIAquick_PCR_Purification,QIAGEN_QIAquick_Gel_Extraction,SYBR_gelstain,Agencourt_AMPure_XP,ChemGenes_Barcoded_beads,EQ_Four_Element_Calibration_Beads,Maxpar_Antibody_Labeling_Kit,Cell_ID_Intercalator_Ir,Cell_ID_Cisplatin,Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit,Centrifugal_Filter_Unit_3kDa,Centrifugal_Filter_Unit_50kDa,Maxpar_Cell_Staining_Buffer,Eppendorf_8Tube_Strips_with_Caps,Rainin_Wide_orifice_pipette_tips,NEB_Index_fullset,NEB_Index_2_fullset,Q5_HighFidelity_DNA_Polymerase,total_cost,Submitter_Name,email,lab,date,remark";

		$err_count = 0;

		/* TABLE A */
		if ($DNA_High_sensitivty_chip > $result_stock_array['DNA_High_sensitivty_chip']) {
			echo "<p><span style=\"color:red\">The number of Agilent DNA High Sensitivity Chip you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($RNA_Nano > $result_stock_array['RNA_Nano']) {
			echo "<p><span style=\"color:red\">The number of Agilent RNA Nano Chip you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Qubit_dsDNA_HS > $result_stock_array['Qubit_dsDNA_HS']) {
			echo "<p><span style=\"color:red\">The number of Invitrogen Qubit dsDNA HS Assay with Assay Tubes you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE B */
		if ($NEBNEXT_PloyA > $result_stock_array['NEBNEXT_PloyA']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Poly(A) mRNA magnetic isolation module you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_set1 > $result_stock_array['NEBNEXT_Ultra_set1']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra directional RNA library prep Kit for Illumina with 12 NEB Index Set1 you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_set2 > $result_stock_array['NEBNEXT_Ultra_set2']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra directional RNA library prep Kit for Illumina with 12 NEB Index Set2 you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_noIndex > $result_stock_array['NEBNEXT_Ultra_noIndex']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra directional RNA library prep Kit for Illumina without Index you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_II_set1 > $result_stock_array['NEBNEXT_Ultra_II_set1']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra II DNA Library Prep Kit for Illumina with 12 NEB Index Set1 you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_II_set2 > $result_stock_array['NEBNEXT_Ultra_II_set2']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra II DNA Library Prep Kit for Illumina with 12 NEB Index Set2 you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_II_noIndex > $result_stock_array['NEBNEXT_Ultra_II_noIndex']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra II DNA Library Prep Kit for Illumina without Index you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_II_96 > $result_stock_array['NEBNEXT_Ultra_II_96']) {
			echo "<p><span style=\"color:red\">The number of NEB-NEXT Ultra II DNA Library Prep Kit for Illumina you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEB_Index > $result_stock_array['NEB_Index']) {
			echo "<p><span style=\"color:red\">The number of NEB Index (2.5µL, 10µM, Per Reaction) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEB_Index_fullset > $result_stock_array['NEB_Index_fullset']) {
			echo "<p><span style=\"color:red\">The number of NEB Index (2.5µL, 10µM, Per Reaction) full set you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEB_Index_2 > $result_stock_array['NEB_Index_2']) {
			echo "<p><span style=\"color:red\">The number of NEB Index (5µL, 10µM, Per Reaction) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEB_Index_2_fullset > $result_stock_array['NEB_Index_2_fullset']) {
			echo "<p><span style=\"color:red\">The number of NEB Index (5µL, 10µM, Per Reaction) full set you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE C */
		if ($NEB_Quickligation > $result_stock_array['NEB_Quickligation']) {
			echo "<p><span style=\"color:red\">The number of NEB Quick Ligation Kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Phusion_DNA_Pol > $result_stock_array['Phusion_DNA_Pol']) {
			echo "<p><span style=\"color:red\">The number of Phusion High-Fidelity DNA Polymerase you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($NEBNEXT_Ultra_II_EndRepair > $result_stock_array['NEBNEXT_Ultra_II_EndRepair']) {
			echo "<p><span style=\"color:red\">The number of NEBNext Ultra II End Repair/dA-Tailing Module you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Taq_DNA_Ligase > $result_stock_array['Taq_DNA_Ligase']) {
			echo "<p><span style=\"color:red\">The number of NEB Taq DNA Ligase you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Q5_HighFidelity_DNA_Polymerase > $result_stock_array['Q5_HighFidelity_DNA_Polymerase']) {
			echo "<p><span style=\"color:red\">The number of Q5 High-Fidelity DNA Polymerase you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Rnaseh > $result_stock_array['Rnaseh']) {
			echo "<p><span style=\"color:red\">The number of Takara SYBR Premix Ex Taq (Tli RNaseH Plus) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Primestar_DNA_Pol > $result_stock_array['Primestar_DNA_Pol']) {
			echo "<p><span style=\"color:red\">The number of Takara PrimeSTAR GXL DNA Polymerase you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE D */
		if ($Aline_PCR > $result_stock_array['Aline_PCR']) {
			echo "<p><span style=\"color:red\">The number of Aline PCR clean up DX beads (per mL) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Aline_PCR_bottle > $result_stock_array['Aline_PCR_bottle']) {
			echo "<p><span style=\"color:red\">The number of Aline PCR clean up DX beads (per bottle) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Aline_Size > $result_stock_array['Aline_Size']) {
			echo "<p><span style=\"color:red\">The number of Aline Size selector-1 beads (per mL) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Aline_Size_selector_1_beads_bottle > $result_stock_array['Aline_Size_selector_1_beads_bottle']) {
			echo "<p><span style=\"color:red\">The number of Aline Size selector-1 beads (per bottle) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Agencourt_AMPure_XP > $result_stock_array['Agencourt_AMPure_XP']) {
			echo "<p><span style=\"color:red\">The number of Agencourt AMPure XP (per mL) *for DropSeq you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($ChemGenes_Barcoded_beads > $result_stock_array['ChemGenes_Barcoded_beads']) {
			echo "<p><span style=\"color:red\">The number of ChemGenes Barcoded beads *for DropSeq you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE E */
		if ($Spinminiprep > $result_stock_array['Spinminiprep']) {
			echo "<p><span style=\"color:red\">The number of QlAprep Spin Miniprep kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($QIAGEN_QIAquick_PCR_Purification > $result_stock_array['QIAGEN_QIAquick_PCR_Purification']) {
			echo "<p><span style=\"color:red\">The number of QIAGEN QIAquick PCR Purification Kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($QIAGEN_QIAquick_Gel_Extraction > $result_stock_array['QIAGEN_QIAquick_Gel_Extraction']) {
			echo "<p><span style=\"color:red\">The number of QIAGEN QIAquick Gel Extraction Kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($QIAGEN_RNeasy_Mini > $result_stock_array['QIAGEN_RNeasy_Mini']) {
			echo "<p><span style=\"color:red\">The number of QIAGEN RNeasy Mini Kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE F */
		if ($SYBR_gelstain > $result_stock_array['SYBR_gelstain']) {
			echo "<p><span style=\"color:red\">The number of Invitrogen SYBR Safe DNA gel stain you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE G */
		if ($EQ_Four_Element_Calibration_Beads > $result_stock_array['EQ_Four_Element_Calibration_Beads']) {
			echo "<p><span style=\"color:red\">The number of EQ™ Four Element Calibration Beads you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Maxpar_Antibody_Labeling_Kit > $result_stock_array['Maxpar_Antibody_Labeling_Kit']) {
			echo "<p><span style=\"color:red\">The number of Maxpar Antibody Labeling Kit 150Nd you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Cell_ID_Intercalator_Ir > $result_stock_array['Cell_ID_Intercalator_Ir']) {
			echo "<p><span style=\"color:red\">The number of Cell-ID Intercalator-Ir 125uM you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Cell_ID_Cisplatin > $result_stock_array['Cell_ID_Cisplatin']) {
			echo "<p><span style=\"color:red\">The number of Cell-ID Cisplatin you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit > $result_stock_array['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit']) {
			echo "<p><span style=\"color:red\">The number of Maxpar® Human PB Basic Phenotyping Panel Kit you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Centrifugal_Filter_Unit_3kDa > $result_stock_array['Centrifugal_Filter_Unit_3kDa']) {
			echo "<p><span style=\"color:red\">The number of Centrifugal Filter Unit: 3 kDa Amicon Ultra-500 µL V bottom you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Centrifugal_Filter_Unit_50kDa > $result_stock_array['Centrifugal_Filter_Unit_50kDa']) {
			echo "<p><span style=\"color:red\">The number of Centrifugal Filter Unit: 50 kDa Amicon Ultra-500 µL V bottom you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Maxpar_Cell_Staining_Buffer > $result_stock_array['Maxpar_Cell_Staining_Buffer']) {
			echo "<p><span style=\"color:red\">The number of Maxpar Cell Staining Buffer (per 5mL) you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}

		/* TABLE H */
		if ($Eppendorf_8Tube_Strips_with_Caps > $result_stock_array['Eppendorf_8Tube_Strips_with_Caps']) {
			echo "<p><span style=\"color:red\">The number of Eppendorf 8-Tube x 0.2mL PCR Tube Strips with Caps you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}
		if ($Rainin_Wide_orifice_pipette_tips > $result_stock_array['Rainin_Wide_orifice_pipette_tips']) {
			echo "<p><span style=\"color:red\">The number of Rainin Wide-orifice 1000µL pipette tips you ordered exceeds the current stock, please change the quantity of you order.</span></p><br><br>";
			$err_count++;
		}


		$request_record = "";

		if ($DNA_High_sensitivty_chip > 0) {
			$request_record .= "Agilent DNA High Sensitivity Chip (11 Samples/Chip), Quantity(Per Chip) :  $DNA_High_sensitivty_chip<br>";
		}
		if ($RNA_Nano > 0) {
			$request_record .= "Agilent RNA Nano Chip (12 Samples/Chip), Quantity(Per Chip) :  $RNA_Nano<br>";
		}
		if ($NEBNEXT_PloyA > 0) {
			$request_record .= "NEB-NEXT Poly(A) mRNA magnetic isolation module, #E7490L, (12 Reaction/Set), Quantity(Per Set) : $NEBNEXT_PloyA<br>";
		}
		if ($NEBNEXT_Ultra_set1 > 0) {
			$request_record .= "NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index Set 1 (2.5µL, 10µM Per tube) : $NEBNEXT_Ultra_set1<br>";
		}
		if ($NEBNEXT_Ultra_set2 > 0) {
			$request_record .= "NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), with 12 NEB Index Set 2 (2.5µL, 10µM Per tube) : $NEBNEXT_Ultra_set2<br>";
		}
		if ($NEBNEXT_Ultra_noIndex > 0) {
			$request_record .= "NEB-NEXT Ultra directional RNA library prep Kit for Illumina, #E7420L, (12 Reaction/Set), without Index: $NEBNEXT_Ultra_noIndex<br>";
		}
		if ($NEBNEXT_Ultra_II_set1 > 0) {
			$request_record .= "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina,#E7645L, (12 Reaction/Set), with 12 NEB Index Set 1 (5µL, 10µM) : $NEBNEXT_Ultra_II_set1<br>";
		}
		if ($NEBNEXT_Ultra_II_set2 > 0) {
			$request_record .= "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina,#E7645L, (12 Reaction/Set), with 12 NEB Index Set 2 (5µL, 10µM) : $NEBNEXT_Ultra_II_set2<br>";
		}
		if ($NEBNEXT_Ultra_II_noIndex > 0) {
			$request_record .= "NEB-NEXT Ultra II DNA Library Prep Kit for Illumina, #E7645L, (12 Reaction/Set), without Index : $NEBNEXT_Ultra_II_noIndex<br>";
		}
		if ($NEB_Index > 0) {
			$request_record .= "NEB Index(2.5µL, 10µM, Per Reaction), Quantity(Per Reaction) : $NEB_Index<br>";
		}
		if ($NEB_Index_fullset > 0) {
			$request_record .= "NEB Index(2.5µL, 10µM, Per Reaction) full set, Quantity(Per Reaction) : $NEB_Index_fullset<br>";
		}
		if ($NEB_Index_2 > 0) {
			$request_record .= "NEB Index (5µL, 10µM, Per Reaction), Quantity(Per Reaction) : $NEB_Index_2<br>";
		}
		if ($NEB_Index_2_fullset > 0) {
			$request_record .= "NEB Index (5µL, 10µM, Per Reaction) full set, Quantity(Per Reaction) : $NEB_Index_2_fullset<br>";
		}
		if ($NEB_Quickligation > 0) {
			$request_record .= "NEB #: M2200L Quick Ligation&trade; Kit, 150 reactions : $NEB_Quickligation<br>";
		}
		if ($NEBNEXT_Ultra_II_96 > 0) {
			$request_record .= "NEB #: E7645L NEBNext&reg; Ultra&trade; II DNA Library Prep Kit for Illumina (96 reactions) : $NEBNEXT_Ultra_II_96<br>";
		}
		if ($Phusion_DNA_Pol > 0) {
			$request_record .= "Phusion High-Fidelity DNA Polymerase - 500 units : $Phusion_DNA_Pol<br>";
		}
		if ($Primestar_DNA_Pol > 0) {
			$request_record .= "Takara PrimeSTAR GXL DNA Polymerase (250 units) : $Primestar_DNA_Pol<br>";
		}
		if ($Qubit_dsDNA_HS > 0) {
			$request_record .= "Invitrogen Qubit&trade; dsDNA HS Assay with Assay Tubes : $Qubit_dsDNA_HS<br>";
		}

		/*CHANGE BELOW*/

		if ($Aline_PCR > 0) {
			$request_record .= "Aline PCR clean up DX beads, #C-1003, Quantity(1mL Per Tube) : $Aline_PCR<br>";
		}
		if ($Aline_Size > 0) {
			$request_record .= "Aline Size selector-1 beads (per tube), #Z-6001, Quantity(1mL Per Tube) : $Aline_Size<br>";
		}
		if ($Aline_Size_selector_1_beads_bottle > 0) {
			$request_record .= "Aline Size selector-1 beads (per bottle), #Z-6001, Quantity(Per bottle) : $Aline_Size_selector_1_beads_bottle<br>";
		}
		if ($Rnaseh > 0) {
			$request_record .= "Takara SYBR Premix Ex Taq (Tli RNaseH Plus), #RR420A (200 reactions) : $Rnaseh<br>";
		}
		if ($Spinminiprep > 0) {
			$request_record .= "QlAprep Spin Miniprep kit, #27106 : $Spinminiprep<br>";
		}
		if ($QIAGEN_RNeasy_Mini > 0) {
			$request_record .= "QIAGEN RNeasy Mini Kit (250): $QIAGEN_RNeasy_Mini<br>";
		}
		if ($QIAGEN_QIAquick_PCR_Purification > 0) {
			$request_record .= "QIAGEN QIAquick PCR Purification Kit (250) : $QIAGEN_QIAquick_PCR_Purification<br>";
		}
		if ($QIAGEN_QIAquick_Gel_Extraction > 0) {
			$request_record .= "QIAGEN QIAquick Gel Extraction Kit (250) : $QIAGEN_QIAquick_Gel_Extraction<br>";
		}
		if ($NEBNEXT_Ultra_II_EndRepair > 0) {
			$request_record .= "NEBNext #E7546L Ultra II End Repair/dA-Tailing Module: $NEBNEXT_Ultra_II_EndRepair<br>";
		}
		if ($Taq_DNA_Ligase > 0) {
			$request_record .= "Taq #M0208L DNA Ligase: $Taq_DNA_Ligase<br>";
		}
		if ($Aline_PCR_bottle > 0) {
			$request_record .= "Aline PCR bottle clean up DX beads: $Aline_PCR_bottle<br>";
		}
		if ($SYBR_gelstain > 0) {
			$request_record .= "Invitrogen SYBR Safe DNA gel stain, #S33102: $SYBR_gelstain<br>";
		}
		if ($Agencourt_AMPure_XP > 0) {
			$request_record .= "Agencourt AMPure XP (per mL) *for DropSeq, #A63881, Quantity(1mL Per Tube): $Agencourt_AMPure_XP<br>";
		}
		if ($ChemGenes_Barcoded_beads > 0) {
			$request_record .= "ChemGenes Barcoded beads *for DropSeq, #Macosko-2011-10, Quantity(1 Sample Per Tube): $ChemGenes_Barcoded_beads<br>";
		}
		if ($EQ_Four_Element_Calibration_Beads > 0) {
			$request_record .= "EQ™ Four Element Calibration Beads, #201078, Quantity(1mL Per Sample): $EQ_Four_Element_Calibration_Beads<br>";
		}
		if ($Maxpar_Antibody_Labeling_Kit > 0) {
			$request_record .= "Maxpar Antibody Labeling Kit 150Nd (per reaction), #201150A, Quantity(Per Reaction): $Maxpar_Antibody_Labeling_Kit<br>";
		}
		if ($Cell_ID_Intercalator_Ir > 0) {
			$request_record .= "Cell-ID Intercalator-Ir 125 uM (1 test for 1 sample), #201192A, Quantity(1 Test Per Tube): $Cell_ID_Intercalator_Ir<br>";
		}
		if ($Cell_ID_Cisplatin > 0) {
			$request_record .= "Cell-ID Cisplatin (1 test for 1 sample), #201064, Quantity(1 Test Per Tube): $Cell_ID_Cisplatin<br>";
		}

		if ($Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit > 0) {
			$request_record .= "Maxpar® Human PB Basic Phenotyping Panel Kit, 7 Markers, #201302, Quantity(1 Test): $Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit<br>";
		}
		if ($Centrifugal_Filter_Unit_3kDa > 0) {
			$request_record .= "Centrifugal Filter Unit: 3 kDa Amicon Ultra-500 µL V bottom, #UFC500396, Quantity(1 Unit): $Centrifugal_Filter_Unit_3kDa<br>";
		}
		if ($Centrifugal_Filter_Unit_50kDa > 0) {
			$request_record .= "Centrifugal Filter Unit: 50 kDa Amicon Ultra-500 µL V bottom, #UFC505096, Quantity(1 Unit): $Centrifugal_Filter_Unit_50kDa<br>";
		}
		if ($Maxpar_Cell_Staining_Buffer > 0) {
			$request_record .= "Maxpar Cell Staining Buffer (per 5mL), #201068, Quantity(5mL Per Tube): $Maxpar_Cell_Staining_Buffer<br>";
		}
		if ($Eppendorf_8Tube_Strips_with_Caps > 0) {
			$request_record .= "Eppendorf 8-Tube x 0.2mL PCR Tube Strips with Caps, #951010022, Quantity(Per Strip): $Eppendorf_8Tube_Strips_with_Caps<br>";
		}
		if ($Rainin_Wide_orifice_pipette_tips > 0) {
			$request_record .= "Rainin Wide-orifice 1000µL pipette tips, #30389218, Quantity(Per Rack): $Rainin_Wide_orifice_pipette_tips<br>";
		}
		if ($Q5_HighFidelity_DNA_Polymerase > 0) {
			$request_record .= "Q5 High-Fidelity DNA Polymerase (500 units), M0491L, Quantity(Per Set): $Q5_HighFidelity_DNA_Polymerase<br>";
		}

		$request_record .= "Total Cost: $total_cost<br>";

		if ($Remark != "") {
			$request_record .= "Remark: $Remark<br>";
		}


		if ($err_count < 1) {

			$conn = db_connect();
			$res = $conn->query("INSERT INTO genomics_core.reagent ($name) VALUES (" . $value . ")");

			/* TABLE A */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['DNA_High_sensitivty_chip']}-{$DNA_High_sensitivty_chip} WHERE name='DNA_High_sensitivty_chip'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['RNA_Nano']}-{$RNA_Nano} WHERE name='RNA_Nano'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Qubit_dsDNA_HS']}-{$Qubit_dsDNA_HS} WHERE name='Qubit_dsDNA_HS'");

			/* TABLE B */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_PloyA']}-{$NEBNEXT_PloyA} WHERE name='NEBNEXT_PloyA'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_set1']}-{$NEBNEXT_Ultra_set1} WHERE name='NEBNEXT_Ultra_set1'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_set2']}-{$NEBNEXT_Ultra_set2} WHERE name='NEBNEXT_Ultra_set2'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_noIndex']}-{$NEBNEXT_Ultra_noIndex} WHERE name='NEBNEXT_Ultra_noIndex'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_II_set1']}-{$NEBNEXT_Ultra_II_set1} WHERE name='NEBNEXT_Ultra_II_set1'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_II_set2']}-{$NEBNEXT_Ultra_II_set2} WHERE name='NEBNEXT_Ultra_II_set2'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_II_noIndex']}-{$NEBNEXT_Ultra_II_noIndex} WHERE name='NEBNEXT_Ultra_II_noIndex'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_II_96']}-{$NEBNEXT_Ultra_II_96} WHERE name='NEBNEXT_Ultra_II_96'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEB_Index']}-{$NEB_Index} WHERE name='NEB_Index'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEB_Index_fullset']}-{$NEB_Index_fullset} WHERE name='NEB_Index_fullset'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEB_Index_2']}-{$NEB_Index_2} WHERE name='NEB_Index_2'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEB_Index_2_fullset']}-{$NEB_Index_2_fullset} WHERE name='NEB_Index_2_fullset'");

			/* TABLE C */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEB_Quickligation']}-{$NEB_Quickligation} WHERE name='NEB_Quickligation'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Phusion_DNA_Pol']}-{$Phusion_DNA_Pol} WHERE name='Phusion_DNA_Pol'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['NEBNEXT_Ultra_II_EndRepair']}-{$NEBNEXT_Ultra_II_EndRepair} WHERE name='NEBNEXT_Ultra_II_EndRepair'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Taq_DNA_Ligase']}-{$Taq_DNA_Ligase} WHERE name='Taq_DNA_Ligase'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Q5_HighFidelity_DNA_Polymerase']}-{$Q5_HighFidelity_DNA_Polymerase} WHERE name='Q5_HighFidelity_DNA_Polymerase'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Rnaseh']}-{$Rnaseh} WHERE name='Rnaseh'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Primestar_DNA_Pol']}-{$Primestar_DNA_Pol} WHERE name='Primestar_DNA_Pol'");

			/* TABLE D */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Aline_PCR']}-{$Aline_PCR} WHERE name='Aline_PCR'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Aline_PCR_bottle']}-{$Aline_PCR_bottle} WHERE name='Aline_PCR_bottle'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Aline_Size']}-{$Aline_Size} WHERE name='Aline_Size'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Aline_Size_selector_1_beads_bottle']}-{$Aline_Size_selector_1_beads_bottle} WHERE name='Aline_Size_selector_1_beads_bottle'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Agencourt_AMPure_XP']}-{$Agencourt_AMPure_XP} WHERE name='Agencourt_AMPure_XP'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['ChemGenes_Barcoded_beads']}-{$ChemGenes_Barcoded_beads} WHERE name='ChemGenes_Barcoded_beads'");

			/* TABLE E */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Spinminiprep']}-{$Spinminiprep} WHERE name='Spinminiprep'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['QIAGEN_QIAquick_PCR_Purification']}-{$QIAGEN_QIAquick_PCR_Purification} WHERE name='QIAGEN_QIAquick_PCR_Purification'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['QIAGEN_QIAquick_Gel_Extraction']}-{$QIAGEN_QIAquick_Gel_Extraction} WHERE name='QIAGEN_QIAquick_Gel_Extraction'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['QIAGEN_RNeasy_Mini']}-{$QIAGEN_RNeasy_Mini} WHERE name='QIAGEN_RNeasy_Mini'");

			/* TABLE F */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['SYBR_gelstain']}-{$SYBR_gelstain} WHERE name='SYBR_gelstain'");

			/* TABLE G */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['EQ_Four_Element_Calibration_Beads']}-{$EQ_Four_Element_Calibration_Beads} WHERE name='EQ_Four_Element_Calibration_Beads'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Maxpar_Antibody_Labeling_Kit']}-{$Maxpar_Antibody_Labeling_Kit} WHERE name='Maxpar_Antibody_Labeling_Kit'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Cell_ID_Intercalator_Ir']}-{$Cell_ID_Intercalator_Ir} WHERE name='Cell_ID_Intercalator_Ir'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Cell_ID_Cisplatin']}-{$Cell_ID_Cisplatin} WHERE name='Cell_ID_Cisplatin'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit']}-{$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit} WHERE name='Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Centrifugal_Filter_Unit_3kDa']}-{$Centrifugal_Filter_Unit_3kDa} WHERE name='Centrifugal_Filter_Unit_3kDa'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Centrifugal_Filter_Unit_50kDa']}-{$Centrifugal_Filter_Unit_50kDa} WHERE name='Centrifugal_Filter_Unit_50kDa'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Maxpar_Cell_Staining_Buffer']}-{$Maxpar_Cell_Staining_Buffer} WHERE name='Maxpar_Cell_Staining_Buffer'");

			/* TABLE H */
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Eppendorf_8Tube_Strips_with_Caps']}-{$Eppendorf_8Tube_Strips_with_Caps} WHERE name='Eppendorf_8Tube_Strips_with_Caps'");
			$res = $conn->query("UPDATE genomics_core.price_table SET stock = {$result_stock_array['Rainin_Wide_orifice_pipette_tips']}-{$Rainin_Wide_orifice_pipette_tips} WHERE name='Rainin_Wide_orifice_pipette_tips'");



			if (!$res) {
				echo "<span style=\"font-family:sans-serif;font-size:20px;color:red\">Your request submission failed. Please contact Genomics Core Tech support.</span>";
			} else {

				echo "<p><b style=\"font-family:sans-serif;font-size:20px;color:red\">Your reagent request submitted successfully.</b><br><br></p>";


				$result_lab = search("select * from lab where lab_name='" . $result_user[0]['lab'] . "'");

				$tomail = $result_lab[0]['director_email'] . "," . $result_user[0]['email'];
				require('email_CC.php');
				$tomail_arr = explode(',', $tomail);
				$main_mesg = "Dear " . $_SESSION['username'] . " and " . $result_lab[0]['lab_director'] . ",<br><br>Thank you for requesting the following reagents. Your reagent (<a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=&Keywords=$RgRID\">$RgRID</a>) will be ready for collection on $collect_date ($collect_date_detail).<br><br>RgRID: <a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=&Keywords=$RgRID\">$RgRID</a><br>Request summary:<br>" . $request_record . "<br>Please note the Reagent Request ID(<font color=\"red\">RgRID</font>) for reference and find the reagent request information from this link: <a href=\"http://161.64.198.12/GBSCC/reagent_search_result.php?RgRID=&Keywords=$RgRID\">Genomics Core database Reagent Request</a>.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Genomics Core database</a>. Please do not reply to this email address. For any queries, please contact the Genomics Core Support team.";

				$Subject = "FYI: Reagent request of " . $_SESSION['username'] . " from " . $result_user[0]['lab'] . "  ($RgRID).";
				$CC_arr = explode(',', $CC);

				if ($tomail != "") {

					$main_mesg .= $main_mesg_email;

					require './PHPMailer-master/PHPMailerAutoload.php';
					$mail = new PHPMailer;
					$mail->CharSet    = "UTF-8";
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = "ssl";
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 465;
					$mail->Username   = "fhs.genomics.core@gmail.com";
					$mail->Password   = "genomicscore";
					$mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');
					$mail->Subject    = $Subject;
					$mail->MsgHTML($main_mesg);


					for ($i = 0; $i < count($tomail_arr); $i++) {
						$mail->AddAddress($tomail_arr[$i]);
					}
					for ($i = 0; $i < count($CC_arr); $i++) {
						$mail->AddCC($CC_arr[$i]);
					}

					//$mail->AddAttachment("images/phpmailer.gif"); // attachment
					if (!$mail->Send()) {
						echo "Request email failed. Please contact Genomics Core Tech support.<br><br>" . $mail->ErrorInfo;
					} else {
						echo "<p>Request email send to: $tomail<br><br>Request email CC: $CC<br><br>Record:<br>$request_record<br><br></p>";
					}
				}
			}
		}
	}
	?>

</body>

</html>