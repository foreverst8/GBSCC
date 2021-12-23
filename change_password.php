<html>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>
</head>
<body>

<?php 
session_start();?>

<br>
<table width="100%" border="0"  cellspacing="0">
<tr>
<td align="left" valign="top">
   <?php require('login.php');?>
   <hr>
   <br>
   <h6>CHANGE PASSWORD<h6>
   <?php 
	 
	 @$username= $_GET['username'];
	 
	 if($username!=""){
	
		  echo "<form method=\"post\" action=\"change_password.php\">";
		  echo "<table>";
		  
		  echo "<tr><td>Username</td>";
		  echo "<td>$username<input type=\"hidden\" name=\"username\" value=$username /></td></tr>";
		  
		  echo "<tr>";
		  echo "<td>Old Password</td>";
		  echo "<td><input type=\"password\" name=\"passwd\"/></td></tr>";
		  
		  echo "<tr>";
		  echo "<td>New Password</td>";
		  echo "<td><input type=\"password\" name=\"newpasswd1\"/></td></tr>";
		  
		  echo "<tr><td>Confirm New Password&nbsp;&nbsp;&nbsp;&nbsp;</td>";
		  echo "<td><input type=\"password\" name=\"newpasswd2\"/></td></tr>";
	
		  echo "<tr>";
		  echo "<td colspan=\"2\" align=\"center\">";
		  echo "<input type=\"submit\" class=\"button\" value=\"Submit\"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\" value=\"Reset\" /></td></tr>";
		  echo "</table></form>";
	  
	 }
	 else{
			 $username= $_POST['username'];
			 $passwd= $_POST['passwd'];
			 $newpasswd1= $_POST['newpasswd1'];
			 $newpasswd2= $_POST['newpasswd2'];
			 
			 if($newpasswd1 != $newpasswd2){
					 echo "<p><br>New passwords are not identical.</p><br>";
					 exitout();
					 exit;
			}

			$result4=search("select user_name from user where user_name='$username' and passwd='$passwd'");
			# echo "select user_name from user where user_name='$username' and passwd='$passwd'<br>";
			 $count4=count($result4);
			 if($count4==0){
				 echo "<p>Are you sure you want to change your password?&nbsp;<a href=\"change_password.php?username=".$_SESSION['username']."\" class=\"button\">Yes</a></p><br>";
				 exitout();
				 exit;
			 }
			 
			 
			$myeditquery="UPDATE genomics_core.user SET passwd='$newpasswd1' where user_name='$username'";
		    $conn = db_connect();
			  #echo "$myeditquery<br>";
			  $res=$conn->query($myeditquery);
			   if (!$res){
				echo 'Error: ' . mysql_error();
				echo "<br>";
				}
			  else
			  {
				  echo "<p><br>Password successfully changed.<br>";
			  } 
	}
?> 
</td>
</tr>

</body>
</html>