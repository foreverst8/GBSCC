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
input[type="file"] {
    display: none;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>

<table>
  <tr>
    <td align="left" valign="top">
	<?php
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br/>';			
			exit;
		}
		
		$sample_count=0;
		if($_GET['sample_count']){
			$sample_count=$_GET['sample_count'];
		}
	?>  

	<h6>MICROARRAY INSTRUCTIONS<p style="color:red">&nbsp&nbsp&nbsp(currently not in service)</p></h6>
	<br>
	<ul>
	<li>mRNA samples for microarray will be processed by using Illumina iScan System and TargetAmp&trade;-Nano Labeling Kit. The BeadChip platform offers a 12-sample format.</li>
	<li>All mRNA samples should meet the following criteria:
		<ol>
		<li>RNA integrity number (RIN) must be > 8 on Bioanalyzer</li>
		<li>Submit  at least 10 &micro;L of 125 ng/&micro;L mRNA sample (follow the dilution guideline below*)</li>
		<br>
		*Use 8-strip PCR tubes to dilute your purified mRNA samples to a concentration of 125 ng/&micro;L, and label them numerically (from sample 1 to 12). Please refer to the following template (.xlsx) to calculate the correction dilution: <a class="button" href="./files/Dilution Template for Microarray.xlsx">Click</a><br><br>
		</ol>
	</li>
	<li>Please contact Tiffany when your samples are ready to submit, and the <span style="color:red">submission form</span> below is filled.</li>
	<li>If you have any queries, please contact our laboratory personnel here: <a href="contactus.php#lab_personnel" class="button">Click</a></li>
	<li>For detailed instructions, please refer to the Microarray sample preparation instructions: <a class="button" href="microarray_sample_preparation.php">Click</a></li>
	</ul>
	</td>
  </tr>
</table>

<br>
<hr>
<br>

<form action="microarray.php" method="get">
<p>How many samples do you want to submit? (Maximum 12)&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" min="0" max="12"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>

<form action="microarray.php" method="post" enctype="multipart/form-data">
<p>Or upload from file*&nbsp;&nbsp;</p>
<label for="txt_file" class="button">Choose File</label>
<input name="txt_file" id="txt_file" type="file"/>
<input class="button" value="Attach" type="submit"/>
</p>
<br><br>

<p style="font-size:12px">*Please fill up this excel file <a href="./files/microarray_upload_file.xlsx"><span style="color:red">Microarray_upload_file.xlsx</span></a>,upload it and click Attach.</p>

</form>
<br><br><hr><br>

