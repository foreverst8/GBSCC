<html>
<head>

<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>
<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>

<body>
<br>
<?php require('login.php');?>
<hr>
<br>
<h6>VISION</h6>
<br>
<p>With state-of-the-art equipment, the Genomics, Bioinformatics & Single Cell Core provides users with cutting-edge genomics technologies and high-quality services to facilitate and advance their research.</p>

<br>
<br>

<h6>MISSION</h6>
<br>
<ul>
<li> To assist users in their Gene expression, Genomics and Bioinformatics research</li>
<li> To assist users in Single Cell isolation</li>
<li> To provide high-quality genomic services</li>
<li> To provide technical and Bioinformatics support</li>
<li> To foster development of innovative Genomics applications</li>
</ul>

<br>
<br>

<?php

	$conn = db_connect();
	mysqli_query($conn,"SET NAMES GB2312");
	
	$date=date("Y-m-d");
	
	$myquery="SELECT * FROM `genomics_core`.`stats_newcore` WHERE `date`='$date'";
	$res=search($myquery);
	
		 if (count($res)==0){
			$insertQuery=search("INSERT INTO `genomics_core`.`stats_newcore` (`date`) VALUES ('$date')");
		 }
		else{
			$ttt="UPDATE `genomics_core`.`stats_newcore` SET `page_views`=".($res[0]['page_views']+1)." WHERE `date`='$date'";
		   	$conn->query($ttt);
		} 
?>

</body>
</html>