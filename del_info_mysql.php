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
#box{
	width:150px;height: 150px;border: 1px solid red;
} 
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>

<script type="text/javascript" src="XMLhttpReuest.js"></script>
<script src="dropzone.js"></script>
<link rel="stylesheet" href="dropzone.css" />

<hr>
<br>
<h6>DELETE DATABASE INFORMATION</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
    <?PHP
	$id = $_GET['id'];
	$database= $_GET['database'];
 
	$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
	
	if(count($result_user)==0){
		#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
		echo '<p>You do not have permission to access this page.<br/></p>';			
		exit;
	}
	
   	?>  
    </td>
  </tr>
</table>

<?php
   	if($database=="user"){
		 $myquery="delete from $database where user_id='$id'";
	}
	if($database=="sangerseq_record"){
		 $myquery="delete from $database where seq_id='$id'";
	}
	if($database=="cytof"){
        $myquery="delete from $database where run='$id'";
    }
    if($database=="hyperion"){
        $myquery="delete from $database where seq_id='$id'";
    }
	if($database=="lab"){
		 $myquery="delete from $database where lab_id='$id'";
	}
	if($database=="hiseq_sample"){
		 $myquery="delete from $database where Hiseq_Sample_ID='$id'";
	}
	if($database=="reagent"){
		 $myquery="delete from $database where RgRID='$id'";
	}
	if($database=="novo_hiseq"){
		 $myquery="delete from $database where run='$id'";
	}
	if($database=="Chromium_10x_Genomics"){
        $myquery="delete from $database where run='$id'";
    }
    if($database=="equipment"){
        $myquery="delete from $database where equipment_id='$id'";
    }

		 $conn = db_connect();
		 mysqli_query($conn,"SET NAMES GB2312");
		 $res=$conn->query($myquery);
		 if (!$res){
			echo 'Error: ' . mysql_error();
			echo "<br>";
		 }
		else{
		   echo "<p>This record has been deleted.<br></p>";
		} 
?>

</body>
</html>