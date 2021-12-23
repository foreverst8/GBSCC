<html>
<body>

<script>
function goBack() {
    window.history.back()
}
</script>

<?php
// Turn off all error reporting
error_reporting(0);
?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<?php 
session_start();
require('db_cancer.php');

if (isset($_POST["username"]))
{
  $username = $_POST["username"];
} 
else 
{
  $username = null;
}

if (isset($_POST["passwd"]))
{
  $passwd = $_POST["passwd"];
} 
else 
{
  $passwd = null;
}

# Check if a session exists
if (isset($_SESSION['username']))  {
		 
		 		 $result4=search("select user_name from user where user_name='".$_SESSION['username']."' ");
				 #echo "select user_name,$database from main_user where user_name='".$_SESSION['username']."' and $database='y'<br>";
				 $count4=count($result4);
				 if($count4==0){
					 echo "<p>You do not have permission to view this page.</p><br>";
					 echo "<p>Please Logout and Login again.</p><br><br>";
					 echo "<a href=\"logout.php\" class=\"button\">Logout</a>";
					 exitout();
					 exit;
					 }
		 
			  echo "<table width=\"100%\"><tr><td align=\"left\" width=\"50%\"><p>Logged in as ".$_SESSION['username'].".</p></td><td width=\"50%\" align=\"right\"><button type=\"button\" class=\"button\" onclick=\"goBack()\">Go Back</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"button\">Logout</a></td></tr></table>";
			  
			 } 
	else {
# If a session doesnt exist check if the username or password matches
# If the fields are blank then
					
					if($username==null or $passwd==null){
						
						echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF'].$_SERVER["QUERY_STRING"]."\">";
						echo "<table>";
						echo "<tr>";
						echo "<td colspan=\"2\"><p>Members login here</p></td>";
						echo "<tr>";
						echo "<td><p>Username</p></td>";
						echo "<td><input type=\"text\" name=\"username\"/></td></tr>";
						echo "<tr>";
						echo "<td><p>Password</p></td>";
						echo "<td><input type=\"password\" name=\"passwd\"/></td></tr>";
						echo "<tr>";
						echo "<td colspan=\"2\" align=\"center\">";
						echo "<input type=\"submit\" class=\"button\" value=\"Log in\"/></td></tr>";
						echo "</table></form>";
						echo "<br>";
						exit;
					}
					else{

# If the fields are not blank then we need to check the records to see if they match
							 $myquery="select * from user where user_name=? and passwd =?";
							 $conn = db_connect();
							 mysqli_query($conn,"SET NAMES GB2312");
							
							
							 if($stmt = $conn->prepare($myquery)){
									$stmt->bind_param("ss",$username,$passwd);
									$stmt->execute();
									$meta = $stmt->result_metadata();
									while ($field = $meta->fetch_field()) 
									{ 
										$params[] = &$row[$field->name];
										$name[]= $field->name;
									
									} 
								
									call_user_func_array(array($stmt, 'bind_result'), $params); 
	
									while ($stmt->fetch()) { 
										foreach($row as $key => $val) 
										{ 
											$c[$key] = $val; 
										}
										$result_user[] = $c; 
									}
									$stmt->close(); 
							 }
							 else{
									echo "<p>ERROR:2</p><br>";
									exitout();
									exit;
							 }
/* Notice: Undefined variable: result_user in C:\Niranjan\Core\login.php on line 100

Warning: count(): Parameter must be an array or an object that implements Countable in C:\Niranjan\Core\login.php on line 100
Unable to log in. Please make sure that your username and password is correct.
Access restricted to logged-in users.
Please recheck your user information and login.*/			
							
							$count_result_user=count($result_user);
							
							if($count_result_user>0){
								$_SESSION['username']=$username;
								
								echo "<table width=\"100%\"><tr><td align=\"left\" width=\"50%\"><p>Logged in as ".$_SESSION['username'].".</p></td><td width=\"50%\" align=\"right\" rowspan=\"2\"><a href=\"logout.php\" class=\"button\">Logout</a></td></tr><tr><td><p>Welcome $username.</p></td></tr></table>";
								
				
								
							}
							else{
								echo '<p>Unable to log in. Please make sure that your username and password is correct.</p><br>';			
								echo '<p>Access restricted to users with a valid login.<br>Please recheck your user information and login.</p><br>';
								echo '<br><br>';
								exit;
							}
					}
		 }

?>
<br>
</body>
</html> 