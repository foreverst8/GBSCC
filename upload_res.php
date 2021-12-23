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

<?php 
session_start();?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="XMLhttpReuest.js"></script>
<script src="dropzone.js"></script>
<link rel="stylesheet" href="dropzone.css" />

<br>
<?php require('login.php');?>
<hr>
<br>
<h6>UPLOAD RESULT<h6>
<br>

<table width="100%" border="0"  cellspacing="0">
   <tr>
	<td align="left" valign="top">
    <?PHP
	  	$run=$_GET['run'];
		$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
				
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq']."--".$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		if($run=="0"){
			echo 'Please select a Run.<br />';			
			exit;
		}
   	?>  
    					
	<?php echo "Upload to Run ID <a href=\"search_result.php?Keywords=$run\"><span style=\"color:red\">$run</span></a><br><br>";?>
	
	<form width="300px" action="upload.php" class="dropzone" method="post"><input type="hidden" value="<?php echo "$run";?>" name="run" /></form>
	<br>
		  
	<?php 
		$result_user_email=search("select email from user where user_name in (select distinct Submitter from sangerseq_record where run='".$run."')");

		$tomail="";
		for($i=0;$i<count($result_user_email);$i++){
			$tomail.=$result_user_email[$i]['email'].",";  
		}
		#$tomail="niranjan.shirgaonkar@gmail.com";
		require('email_CC.php');
		$Subject="Sanger sequencing is done.";
		#$main_mesg="Dear Users,<br><br>Your Sanger sequencing is completed and the result is ready for collection. To download your results, please go to Faculty of Health Sciences, Core website via this link:<br><br>http://161.64.198.12/GBSCC/search_result.php?&run=$run";
		$main_mesg="Dear Users,<br><br>Your Sanger sequencing is completed and the result is ready for collection. To download your results, please go to Faculty of Health Sciences, Core website via this link:<br><br>http://161.64.198.12/GBSCC/search_result.php?database=sangerseq_record&run=$run";
		$main_mesg.=$main_mesg_email;
			
		echo "<form action=\"sent_email.php\" method=\"get\">";
		echo "<input type=\"hidden\" name=\"CC\" value=\"$CC\">";
		echo "<input type=\"hidden\"  name=\"tomail\" value=\"$tomail\">";
		echo "<input type=\"hidden\"  name=\"Subject\" value=\"$Subject\">";
		echo "<input type=\"hidden\"  name=\"main_mesg\" value=\"$main_mesg\">";
		echo "Inform users that results have been done.&nbsp;<input type=\"submit\" class=\"button\" value=\"Send\">";
		echo "</form>";
	?>
		  
	<br>
    </td>
	<td valign="top">
	<?php require("search.php");?>
	</td>
  </tr>
</table>

</body>
</html>