<html>
<head>
    <style>
        a, a:visited {
            color:#002A60; text-decoration:none;
        }
        body {
            margin-left:5%;
            margin-right:5%;
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
    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
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

$DNA_High_sensitivty_chip_stock=$_POST['DNA_High_sensitivty_chip_stock'];
$RNA_Nano_stock=$_POST['RNA_Nano_stock'];
$Qubit_dsDNA_HS_stock=$_POST['Qubit_dsDNA_HS_stock'];

$NEBNEXT_PloyA_stock=$_POST['NEBNEXT_PloyA_stock'];
$NEBNEXT_Ultra_set1_stock=$_POST['NEBNEXT_Ultra_set1_stock'];
$NEBNEXT_Ultra_set2_stock=$_POST['NEBNEXT_Ultra_set2_stock'];
$NEBNEXT_Ultra_noIndex_stock=$_POST['NEBNEXT_Ultra_noIndex_stock'];
$NEBNEXT_Ultra_II_set1_stock=$_POST['NEBNEXT_Ultra_II_set1_stock'];
$NEBNEXT_Ultra_II_set2_stock=$_POST['NEBNEXT_Ultra_II_set2_stock'];
$NEBNEXT_Ultra_II_noIndex_stock=$_POST['NEBNEXT_Ultra_II_noIndex_stock'];
$NEBNEXT_Ultra_II_96_stock=$_POST['NEBNEXT_Ultra_II_96_stock'];
$NEB_Index_stock=$_POST['NEB_Index_stock'];
$NEB_Index_2_stock=$_POST['NEB_Index_2_stock'];
$NEB_Index_fullset_stock=$_POST['NEB_Index_fullset_stock'];
$NEB_Index_2_fullset_stock=$_POST['NEB_Index_2_fullset_stock'];

$NEB_Quickligation_stock=$_POST['NEB_Quickligation_stock'];
$Phusion_DNA_Pol_stock=$_POST['Phusion_DNA_Pol_stock'];
$NEBNEXT_Ultra_II_EndRepair_stock=$_POST['NEBNEXT_Ultra_II_EndRepair_stock'];
$Taq_DNA_Ligase_stock=$_POST['Taq_DNA_Ligase_stock'];
$Q5_HighFidelity_DNA_Polymerase_stock=$_POST['Q5_HighFidelity_DNA_Polymerase_stock'];
$Rnaseh_stock=$_POST['Rnaseh_stock'];
$Primestar_DNA_Pol_stock=$_POST['Primestar_DNA_Pol_stock'];

$Aline_PCR_stock=$_POST['Aline_PCR_stock'];
$Aline_PCR_bottle_stock=$_POST['Aline_PCR_bottle_stock'];
$Aline_Size_stock=$_POST['Aline_Size_stock'];
$Aline_Size_selector_1_beads_bottle_stock=$_POST['Aline_Size_selector_1_beads_bottle_stock'];
$Agencourt_AMPure_XP_stock=$_POST['Agencourt_AMPure_XP_stock'];
$ChemGenes_Barcoded_beads_stock=$_POST['ChemGenes_Barcoded_beads_stock'];

$Spinminiprep_stock=$_POST['Spinminiprep_stock'];
$QIAGEN_QIAquick_PCR_Purification_stock=$_POST['QIAGEN_QIAquick_PCR_Purification_stock'];
$QIAGEN_QIAquick_Gel_Extraction_stock=$_POST['QIAGEN_QIAquick_Gel_Extraction_stock'];
$QIAGEN_RNeasy_Mini_stock=$_POST['QIAGEN_RNeasy_Mini_stock'];

$SYBR_gelstain_stock=$_POST['SYBR_gelstain_stock'];

$EQ_Four_Element_Calibration_Beads_stock=$_POST['EQ_Four_Element_Calibration_Beads_stock'];
$Maxpar_Antibody_Labeling_Kit_stock=$_POST['Maxpar_Antibody_Labeling_Kit_stock'];
$Cell_ID_Intercalator_Ir_stock=$_POST['Cell_ID_Intercalator_Ir_stock'];
$Cell_ID_Cisplatin_stock=$_POST['Cell_ID_Cisplatin_stock'];
$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit_stock=$_POST['Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit_stock'];
$Centrifugal_Filter_Unit_3kDa_stock=$_POST['Centrifugal_Filter_Unit_3kDa_stock'];
$Centrifugal_Filter_Unit_50kDa_stock=$_POST['Centrifugal_Filter_Unit_50kDa_stock'];
$Maxpar_Cell_Staining_Buffer_stock=$_POST['Maxpar_Cell_Staining_Buffer_stock'];

$Eppendorf_8Tube_Strips_with_Caps_stock=$_POST['Eppendorf_8Tube_Strips_with_Caps_stock'];
$Rainin_Wide_orifice_pipette_tips_stock=$_POST['Rainin_Wide_orifice_pipette_tips_stock'];



$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$DNA_High_sensitivty_chip_stock' WHERE name='DNA_High_sensitivty_chip'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$RNA_Nano_stock' WHERE name='RNA_Nano'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Qubit_dsDNA_HS_stock' WHERE name='Qubit_dsDNA_HS'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_PloyA_stock' WHERE name='NEBNEXT_PloyA'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_set1_stock' WHERE name='NEBNEXT_Ultra_set1'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_set2_stock' WHERE name='NEBNEXT_Ultra_set2'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_noIndex_stock' WHERE name='NEBNEXT_Ultra_noIndex'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_II_set1_stock' WHERE name='NEBNEXT_Ultra_II_set1'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_II_set2_stock' WHERE name='NEBNEXT_Ultra_II_set2'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_II_noIndex_stock' WHERE name='NEBNEXT_Ultra_II_noIndex'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_II_96_stock' WHERE name='NEBNEXT_Ultra_II_96'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEB_Index_stock' WHERE name='NEB_Index'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEB_Index_2_stock' WHERE name='NEB_Index_2'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEB_Index_fullset_stock' WHERE name='NEB_Index_fullset'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEB_Index_2_fullset_stock' WHERE name='NEB_Index_2_fullset'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEB_Quickligation_stock' WHERE name='NEB_Quickligation'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Phusion_DNA_Pol_stock' WHERE name='Phusion_DNA_Pol'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$NEBNEXT_Ultra_II_EndRepair_stock' WHERE name='NEBNEXT_Ultra_II_EndRepair'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Taq_DNA_Ligase_stock' WHERE name='Taq_DNA_Ligase'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Q5_HighFidelity_DNA_Polymerase_stock' WHERE name='Q5_HighFidelity_DNA_Polymerase'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Rnaseh_stock' WHERE name='Rnaseh'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Primestar_DNA_Pol_stock' WHERE name='Primestar_DNA_Pol'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Aline_PCR_stock' WHERE name='Aline_PCR'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Aline_PCR_bottle_stock' WHERE name='Aline_PCR_bottle'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Aline_Size_stock' WHERE name='Aline_Size'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Aline_Size_selector_1_beads_bottle_stock' WHERE name='Aline_Size_selector_1_beads_bottle'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Agencourt_AMPure_XP_stock' WHERE name='Agencourt_AMPure_XP'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$ChemGenes_Barcoded_beads_stock' WHERE name='ChemGenes_Barcoded_beads'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Spinminiprep_stock' WHERE name='Spinminiprep'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$QIAGEN_QIAquick_PCR_Purification_stock' WHERE name='QIAGEN_QIAquick_PCR_Purification'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$QIAGEN_QIAquick_Gel_Extraction_stock' WHERE name='QIAGEN_QIAquick_Gel_Extraction'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$QIAGEN_RNeasy_Mini_stock' WHERE name='QIAGEN_RNeasy_Mini'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$SYBR_gelstain_stock' WHERE name='SYBR_gelstain'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$EQ_Four_Element_Calibration_Beads_stock' WHERE name='EQ_Four_Element_Calibration_Beads'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Maxpar_Antibody_Labeling_Kit_stock' WHERE name='Maxpar_Antibody_Labeling_Kit'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Cell_ID_Intercalator_Ir_stock' WHERE name='Cell_ID_Intercalator_Ir'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Cell_ID_Cisplatin_stock' WHERE name='Cell_ID_Cisplatin'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit_stock' WHERE name='Maxpar_Human_PB_Basic_Phenotyping_Panel_Kit'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Centrifugal_Filter_Unit_3kDa_stock' WHERE name='Centrifugal_Filter_Unit_3kDa'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Centrifugal_Filter_Unit_50kDa_stock' WHERE name='Centrifugal_Filter_Unit_50kDa'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Maxpar_Cell_Staining_Buffer_stock' WHERE name='Maxpar_Cell_Staining_Buffer'");

$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Eppendorf_8Tube_Strips_with_Caps_stock' WHERE name='Eppendorf_8Tube_Strips_with_Caps'");
$result = $conn->query("UPDATE genomics_core.price_table SET stock = '$Rainin_Wide_orifice_pipette_tips_stock' WHERE name='Rainin_Wide_orifice_pipette_tips'");



if (!$result) {
    echo "<p>Stock failed to update. Please contact Genomics Core support: siyunliu@um.edu.mo</p>";
} else {
    echo "<p>Stock has been updated.<br><br></p>";
}

?>
</body>
</html>
