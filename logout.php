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

<br>
<br>

<?php require('db_cancer.php')?>

<?php
session_start();
$old_user = $_SESSION['username'];
echo "<h6>LOGOUT</h6><br>";
echo "<p>Hello ".$_SESSION['username'].".</p><br>";

// store  to test if they *were* logged in
unset($_SESSION['username']);
$result_dest = session_destroy();
	
if (!empty($old_user)) {
	 if ($result_dest)  {
		 // if they were logged in and are now logged out
		 echo "<p>You are now logged out.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"home.php\" class=\"button\">Log In</a></p>";
		 
		 // echo("<button onclick=\"location.href='home.php'\">Log In</button>");
		 } else {
			 // they were logged in and could not be logged out
			 echo '<p>Could not log you out.</p><br>';
			 }
	} else {
	  // if they weren't logged in but came to this page somehow
	  echo '<p>You were not logged in so you cannot log out.</p><br>';
	  echo "<p>You are now logged out.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"home.php\">Log In</a></p>";
	}
?>
	
</body>
</html>
