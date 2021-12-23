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
<h6>Edit Reagent Stock</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top" >
            <?PHP
            $result_user=search("select * from user where user_name='".$_SESSION['username']."'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            if(!($result_user[0]["lab"]=="General Office" or $result_user[0]["main"]=="y")){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            ?>
        </td>
    </tr>
</table>



<?php
$result_price=search("select * from price_table");
$result_price_array=array();

for($i=0;$i<count($result_price);$i++){
    $result_price_array[$result_price[$i]['name']]=$result_price[$i]['price'];
}


$result_stock=search("select * from price_table");
$result_stock_array=array();

for($i=0;$i<count($result_stock);$i++){
    $result_stock_array[$result_stock[$i]['name']]=$result_stock[$i]['stock'];
}


echo "<form action=\"stock_edit_action.php#top\" method=\"post\">";


/* TABLE A */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>A: DNA Quantification Kits</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\" width=\"700px\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "Agilent DNA High Sensitivity Chip (11 Samples/Chip)";
echo "</td>";
echo "<td align=\"center\">";
echo "5067-4626";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['DNA_High_sensitivty_chip'];
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Per Chip";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['DNA_High_sensitivty_chip'] . "\" name=\"DNA_High_sensitivty_chip_stock\" id=\"DNA_High_sensitivty_chip_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "Agilent RNA Nano Chip (12 Samples/Chip)";
echo "</td>";
echo "<td align=\"center\">";
echo "5067-1511";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['RNA_Nano'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Chip";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['RNA_Nano'] . "\" name=\"RNA_Nano_stock\" id=\"RNA_Nano_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td align=\"center\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "Invitrogen Qubit dsDNA HS Assay with Assay Tubes";
echo "</td>";
echo "<td align=\"center\">";
echo "Q32854";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['Qubit_dsDNA_HS'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Qubit_dsDNA_HS'] . "\" name=\"Qubit_dsDNA_HS_stock\" id=\"Qubit_dsDNA_HS_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE B */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>B: Library prep Reagents (NEB)</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\" width=\"700px\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_PloyA'] . "\" name=\"NEBNEXT_PloyA_stock\" id=\"NEBNEXT_PloyA_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px;\" width=\"700px\">";
echo "NEB-NEXT Ultra directional RNA library prep Kit for Illumina (12 Reaction/Set) with 12 NEB Index Set 1 (2.5&micro;L, 10&micro;M Per tube)";
echo "</td>";
echo "<td align=\"center\">";
echo "E7420L;E7335L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_set1'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_set1'] . "\" name=\"NEBNEXT_Ultra_set1_stock\" id=\"NEBNEXT_Ultra_set1_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "NEB-NEXT Ultra directional RNA library prep Kit for Illumina (12 Reaction/Set) with 12 NEB Index Set 2 (2.5&micro;L, 10&micro;M Per tube)";
echo "</td>";
echo "<td align=\"center\">";
echo "E7420L;E7500L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_set2'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_set2'] . "\" name=\"NEBNEXT_Ultra_set2_stock\" id=\"NEBNEXT_Ultra_set2_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "4";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "NEB-NEXT Ultra directional RNA library prep Kit for Illumina (12 Reaction/Set) without Index";
echo "</td>";
echo "<td align=\"center\">";
echo "E7420L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_noIndex'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_noIndex'] . "\" name=\"NEBNEXT_Ultra_noIndex_stock\" id=\"NEBNEXT_Ultra_noIndex_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "5";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set) with 12 NEB Index <span style=\"color:#548C00\"><u>Set 1</u></span> (5&micro;L, 10&micro;M)";
echo "</td>";
echo "<td align=\"center\">";
echo "E7645L;E7335L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_II_set1'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_II_set1'] . "\" name=\"NEBNEXT_Ultra_II_set1_stock\" id=\"NEBNEXT_Ultra_II_set1_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "6";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set) with 12 NEB Index <span style=\"color:#548C00\"><u>Set 2</u></span> (5&micro;L, 10&micro;M)";
echo "</td>";
echo "<td align=\"center\">";
echo "E7645L;E7500L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_II_set2'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_II_set2'] . "\" name=\"NEBNEXT_Ultra_II_set2_stock\" id=\"NEBNEXT_Ultra_II_set2_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "7";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "NEB-NEXT Ultra II <span style=\"color:#6F00D2\"><u>DNA Library Prep</u></span> Kit for Illumina (12 Reaction/Set) <b>without</b> Index";
echo "</td>";
echo "<td align=\"center\">";
echo "E7645L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEBNEXT_Ultra_II_noIndex'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Set</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_II_noIndex'] . "\" name=\"NEBNEXT_Ultra_II_noIndex_stock\" id=\"NEBNEXT_Ultra_II_noIndex_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "8";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_II_96'] . "\" name=\"NEBNEXT_Ultra_II_96_stock\" id=\"NEBNEXT_Ultra_II_96_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "9a";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEB_Index'] . "\" name=\"NEB_Index_stock\" id=\"NEB_Index_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "9b";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "*NEB Index (2.5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;**full set";
echo "</td>";
echo "<td align=\"center\">";
echo "E7335L;E7500L";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['NEB_Index_fullset'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Reaction</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEB_Index_fullset'] . "\" name=\"NEB_Index_fullset_stock\" id=\"NEB_Index_fullset_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "10a";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEB_Index_2'] . "\" name=\"NEB_Index_2_stock\" id=\"NEB_Index_2_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align=\"center\" height=\"50px\">";
echo "10b";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "*NEB Index (5&micro;L, 10&micro;M, Per Reaction)&nbsp;&nbsp;**full set";
echo "</td>";
echo "</td>";
echo "<td align=\"center\">";
echo "E7335L;E7500L";
echo "<td align=\"center\">";
echo $result_price_array['NEB_Index_2_fullset'];
echo "</td>";
echo "<td align=\"center\">";
echo "Per Reaction</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEB_Index_2_fullset'] . "\" name=\"NEB_Index_2_fullset_stock\" id=\"NEB_Index_2_fullset_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE C */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>C: Enzymes</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEB_Quickligation'] . "\" name=\"NEB_Quickligation_stock\" id=\"NEB_Quickligation_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Phusion_DNA_Pol'] . "\" name=\"Phusion_DNA_Pol_stock\" id=\"Phusion_DNA_Pol_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['NEBNEXT_Ultra_II_EndRepair'] . "\" name=\"NEBNEXT_Ultra_II_EndRepair_stock\" id=\"NEBNEXT_Ultra_II_EndRepair_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "4";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Taq_DNA_Ligase'] . "\" name=\"Taq_DNA_Ligase_stock\" id=\"Taq_DNA_Ligase_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "5";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Q5_HighFidelity_DNA_Polymerase'] . "\" name=\"Q5_HighFidelity_DNA_Polymerase_stock\" id=\"Q5_HighFidelity_DNA_Polymerase_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "6";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Rnaseh'] . "\" name=\"Rnaseh_stock\" id=\"Rnaseh_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height=\"40px\" align=\"center\">";
echo "7";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Primestar_DNA_Pol'] . "\" name=\"Primestar_DNA_Pol_stock\" id=\"Primestar_DNA_Pol_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE D */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>D: Purification Beads</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Aline_PCR'] . "\" name=\"Aline_PCR_stock\" id=\"Aline_PCR_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Aline_PCR_bottle'] . "\" name=\"Aline_PCR_bottle_stock\" id=\"Aline_PCR_bottle_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Aline_Size'] . "\" name=\"Aline_Size_stock\" id=\"Aline_Size_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "4";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Aline_Size_selector_1_beads_bottle'] . "\" name=\"Aline_Size_selector_1_beads_bottle_stock\" id=\"Aline_Size_selector_1_beads_bottle_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "5";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Agencourt_AMPure_XP'] . "\" name=\"Agencourt_AMPure_XP_stock\" id=\"Agencourt_AMPure_XP_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "6";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['ChemGenes_Barcoded_beads'] . "\" name=\"ChemGenes_Barcoded_beads_stock\" id=\"ChemGenes_Barcoded_beads_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE E */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>E: Helios/Hyperion</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['EQ_Four_Element_Calibration_Beads'] . "\" name=\"EQ_Four_Element_Calibration_Beads_stock\" id=\"EQ_Four_Element_Calibration_Beads_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Maxpar_Antibody_Labeling_Kit'] . "\" name=\"Maxpar_Antibody_Labeling_Kit_stock\" id=\"Maxpar_Antibody_Labeling_Kit_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Cell_ID_Intercalator_Ir'] . "\" name=\"Cell_ID_Intercalator_Ir_stock\" id=\"Cell_ID_Intercalator_Ir_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "4";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Cell_ID_Cisplatin'] . "\" name=\"Cell_ID_Cisplatin_stock\" id=\"Cell_ID_Cisplatin_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "5";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'] . "\" name=\"Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit_stock\" id=\"Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "6";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Centrifugal_Filter_Unit_3kDa'] . "\" name=\"Centrifugal_Filter_Unit_3kDa_stock\" id=\"Centrifugal_Filter_Unit_3kDa_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "7";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Centrifugal_Filter_Unit_50kDa'] . "\" name=\"Centrifugal_Filter_Unit_50kDa_stock\" id=\"Centrifugal_Filter_Unit_50kDa_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "8";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Maxpar_Cell_Staining_Buffer'] . "\" name=\"Maxpar_Cell_Staining_Buffer_stock\" id=\"Maxpar_Cell_Staining_Buffer_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE F */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>F: 10x Genomics</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Eppendorf_8Tube_Strips_with_Caps'] . "\" name=\"Eppendorf_8Tube_Strips_with_Caps_stock\" id=\"Eppendorf_8Tube_Strips_with_Caps_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "Rainin Wide-orifice 1000µL pipette tips";
echo "</td>";
echo "<td align=\"center\" >";
echo "30389218";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['Rainin_Wide_orifice_pipette_tips'];
echo "</td>";
echo "<td align=\"center\" width=\"100\">";
echo "Per Rack</td><td>";
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['Rainin_Wide_orifice_pipette_tips'] . "\" name=\"Rainin_Wide_orifice_pipette_tips_stock\" id=\"Rainin_Wide_orifice_pipette_tips_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


/* TABLE G */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>G: Miscellaneous</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\" colspan=\"2\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
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
echo "<input type=\"text\" size=\"5\" value=\"" . $result_stock_array['SYBR_gelstain'] . "\" name=\"SYBR_gelstain_stock\" id=\"SYBR_gelstain_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";

/* TABLE H */
echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td colspan=\"6\" align=\"center\" height=\"40px\" valign=\"middle\">";
echo "<b>H: QIAGEN Kits</b>";
echo "</td>";
echo "</tr>";

echo "<tr height=\"30px\" valign=\"middle\">";
echo "<td align=\"center\" width=\"40px\">";
echo "No.";
echo "</td>";
echo "<td align=\"center\">";
echo "Name";
echo "</td>";
echo "<td align=\"center\" width=\"150px\">";
echo "Catalog #";
echo "</td>";
echo "<td align=\"center\" width=\"100px\">";
echo "Price";
echo "</td>";
echo "<td align=\"center\">";
echo "Stock";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "1";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "QlAprep Spin Miniprep kit<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
echo "</td>";
echo "<td align=\"center\" >";
echo "27106";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['Spinminiprep'];
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"14\" value=\"" . $result_stock_array['Spinminiprep'] . "\" name=\"Spinminiprep_stock\" id=\"Spinminiprep_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "2";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "QIAGEN QIAquick PCR Purification Kit (250)<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
echo "</td>";
echo "<td align=\"center\" >";
echo "28106";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['QIAGEN_QIAquick_PCR_Purification'];
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"14\" value=\"" . $result_stock_array['QIAGEN_QIAquick_PCR_Purification'] . "\" name=\"QIAGEN_QIAquick_PCR_Purification_stock\" id=\"QIAGEN_QIAquick_PCR_Purification_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "3";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "QIAGEN QIAquick Gel Extraction Kit (250)<p style=\"color:red\">&nbsp&nbsp(currently unavailable)</p>";
echo "</td>";
echo "<td align=\"center\" >";
echo "28706";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['QIAGEN_QIAquick_Gel_Extraction'];
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"14\" value=\"" . $result_stock_array['QIAGEN_QIAquick_Gel_Extraction'] . "\" name=\"QIAGEN_QIAquick_Gel_Extraction_stock\" id=\"QIAGEN_QIAquick_Gel_Extraction_stock\">";
echo "</td>";
echo "</tr>";

echo "<tr height=\"40px\" valign=\"middle\">";
echo "<td height=\"40px\" align=\"center\">";
echo "4";
echo "</td>";
echo "<td align=\"left\" style=\"padding-left:10px\" width=\"700px\">";
echo "QIAGEN RNeasy Mini Kit (250) ";
echo "</td>";
echo "<td align=\"center\" >";
echo "74106";
echo "</td>";
echo "<td align=\"center\">";
echo $result_price_array['QIAGEN_RNeasy_Mini'];
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"14\" value=\"" . $result_stock_array['QIAGEN_RNeasy_Mini'] . "\" name=\"QIAGEN_RNeasy_Mini_stock\" id=\"QIAGEN_RNeasy_Mini_stock\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";


echo "<input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";

echo "</form>";


?>
</body>
</html>
