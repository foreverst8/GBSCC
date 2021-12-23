<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
form {
	margin: 8px 0px;
}
#box{
	width:150px;height: 150px;border: 1px solid red;
}
</style>
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
	   
<table width="100%" border="0"  cellspacing="0">
   <tr>
	<td align="left" valign="top">
    <?PHP
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		$search_run_result=search("select distinct(run) from sangerseq_record ORDER BY run ASC");
   	?>  
      
	<form action="upload_res.php" method="get">Select Run : <select name="run"><option value="0">Select</option>
	<?php
		for($i=count($search_run_result)-1;$i>=0;$i--){
			echo "<option value=\"".$search_run_result[$i]['run']."\">".$search_run_result[$i]['run']."</option>";	
		}
	?>
	</select><p>&nbsp;</p><input type="submit" class="button" name="submit"/></form>
    </td>
	
    <td valign="top">
    <?php require("search.php");?>
    </td>
  </tr>
</table>
</body>
</html>