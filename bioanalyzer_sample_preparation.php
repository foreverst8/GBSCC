<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
th {
	font-weight: bold;
}
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>
<body>
<br>
<?php 
#session_start();
#require('login.php');?> 

<!--
<hr>
<br>
-->
	
<h6>BIOANALYZER USAGE<h6>
<table>
  <tr>
	<td><br><p style="font-size:20px"><b><span style="color: black">1. Introduction</span></b></p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><br>
	<p>The Agilent 2100 Bioanalyzer is a rapid, automated, and sensitive system advancing from traditional gel electrophoresis. It uses a microfluidics-based platform that provides sizing, quantitation, and purity assessments for nucleic acid samples, including total RNA, micro RNAs, small and large DNA fragments. The assays provide precise information on the fragment size distributions, RNA integrity and concentration.<br><br>
	For a high-quality assay run, we highly recommend users to prepare samples within specific range listed in the table below:</p><br><br>
	<table id="bioanalyzer_table" border="1" align="center" cellspacing="0" width="600" bordercolor="#999999">
	<tr><th>Sample Type</th><th>Qualitative Range</th></tr>
	<tr><td>Total RNA, mRNA</td><td>25-250 ng/&micro;L</td></tr>
	<tr><td>NGS sheared DNA or libraries</td><td>100 pg/&micro;L to 10 ng/&micro;L</td></tr>
	<tr><td>DNA PCR product</td><td>5-500 pg/&micro;L</td></tr>
	</table>
	</td>
	<td valign="top">
	<img src="layout/bioanalyzer1.jpg" align="right" style="width:250">
	</td>
  </tr>
  <tr>
	<td>
	<br>
	<p>The following kits and chips are kept in stock and provided by the Core upon request:</p>
	<br><br>
	<ul>
	<li>RNA 6000 Nano Kit (Cat no. 5067-1511): up to 12 samples/chip</li>
	<li>DNA High Sensitivity Kit (Cat no. 5067-4626): up to 11 samples/chip</li>
	</ul>
	<br>
	</td>
  </tr>
  <tr>
	<td align="left" valign="top">
	<p>Users can check out the reagents <a href="hiseq_reagent.php" class="button">Here</a>. The aliquoted reagents are kept in the 4 &deg;C fridge in N22-3009. For collection of any assay chips, please approach one of the core personnel at the designated time and log on our record sheet upon collection.</p>
	<br><br><br>
	<p style="color:red"><b>COLLECTION TIME: Every Tuesday (11:00-12:00) & Friday (11:00-12:00).</b></p>
	<br><br><br>
	<p>Reagent Storage Conditions:</p>
	<br><br>
	<ul>
	<li>Keep all reagents refrigerated at 4 &deg;C when not in use to avoid poor results caused by inappropriate storage</li>
	<li>Protect dye and dye mixtures from light. Remove aluminum foil cover ONLY when pipetting as the dye decomposes when exposed to light</li>
	<li>Prepared RNA ladder aliquots are to be stored at -80 &deg;C</li>
	</ul>
	<br>
	<p>For more information on the reagent kits and standard working protocol, refer to the following links:
	<br><br>
	1. Agilent RNA 6000 Nano Kit Quick Start Guide: <a class="button" target="_blank" href="https://www.agilent.com/cs/library/usermanuals/public/RNA-6000-Nano_QSG.pdf">Click</a>
	<br>
	2. Agilent High Sensitivity DNA Kit Quick Start Guide: <a class="button" target="_blank" href="https://www.agilent.com/cs/library/usermanuals/public/G2938-90322_HighSensitivityDNAKit_QSG.pdf">Click</a></p>
	</td>
	<td valign="top">
	<img src="layout/bioanalyzer2.jpg" align="right" style="width:250">
	</td>
  </tr>
</table>
<br>
<hr>
<br>
<table>
  <tr>
  	<td>
	<p style="font-size:20px"><b><span style="color: black">2. Sample Preparation</span></b></p><br><br>
	<p>All samples should meet the following criteria for Bioanalyzer assay run:</p>
	<br><br>
	<ul>
	<li><p style="color:red; font-weight:bold;">Users MUST be formally trained by a core personnel for their first run before independently working with the Bioanalyzer</p></li>
	<li>At least 1 &micro;L of each sample is required</li>
	<li>Sample concentration should fall in the recommended range for assay run. Please refer to the only table on this page above.</li>
	</ul>
	<br>
	<p>If you have any queries, please contact our laboratory personnel here&nbsp;&nbsp;</p><a href="contactus.php#lab_personnel" class="button">Click</a>
	<br><br>
	</td>
  </tr>
</table>
</body>
</html>			 