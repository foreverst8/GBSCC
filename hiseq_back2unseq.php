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

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

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
</script>
   
<hr>
<br>
<h6>EDIT</h6>
<br>
<table>
  <tr>
	<td align="left" valign="top">
     <?PHP
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
	?>  
	</td>
	<td valign="top">
	<?php require("search_hiseq.php");?>
	</td>
  </tr>
</table>

<p>DETAILS</p><br><br>

<?php

$conn = db_connect();
$Hiseq_Sample_ID=$_GET['ID'];

$value="Run='-',";
$value.="Lanes=''";

$res=$conn->query("UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");


if (!$res){
	echo "Sample set failed.<br>";
	echo '<br>There was something wrong with the script.<br /><br><br>';	
	echo "UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'<br>";		
	exit;	
	
}
else{
	echo "Sample is set back to un-sequenced. Sample ID: $Hiseq_Sample_ID<br>";
}
echo "<br>";
?>

</body>
</html>