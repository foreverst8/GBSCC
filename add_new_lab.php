<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
textarea {
  width: 450px;
  height: 150px;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

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
	   <h6>ADD NEW LAB<h6>
	   <br>
	   
    <?PHP
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo '<p>You are not an Administrator so you do not have permission to access this page.</p><br />';		
			exit;	
		}
			
		$sample_count=0;
		if($_GET['sample_count']){
			$sample_count=$_GET['sample_count'];
		}
   	?>  
    </td>
  </tr>
</table>

<?php 
		$result1=search("desc lab");
		$count_result1=count($result1);
		if($count_result1>0){
			if(!$_POST['lab_name']){
				echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"add_new_lab.php\"  enctype=\"multipart/form-data\">";
				echo "<table width=\"95%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\">";
	
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Lab Name";
				echo " :</td>";
				echo "<td><input type=\"text\" style=\"width: 450px;\" size=\"60\" name=\"lab_name\" id=\"lab_name\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Lab Director";
				echo " :</td>";
				echo "<td><input type=\"text\" style=\"width: 450px;\" size=\"60\" name=\"lab_director\" id=\"lab_director\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Director Email";
				echo " :</td>";
				echo "<td><input type=\"text\" style=\"width: 450px;\" size=\"60\" name=\"director_email\" id=\"director_email\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Description";
				echo " :</td>";
				echo "<td><textarea name=\"desc\" cols=\"50\"></textarea></td></tr>";
				echo " <tr>";
				echo "  <td align=\"right\">&nbsp;</td>";
				echo " <td><input type=\"submit\" name=\"button\" class=\"button\" id=\"button\" value=\"Submit\" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <input type=\"reset\" name=\"button2\" class=\"button\" id=\"button2\"  value=\"Reset \" /></td>";
				echo " </tr>";
				
				echo "</table></form>";
			}
			else{
			
				$lab_name=$_POST['lab_name'];
				
				$lab_director=$_POST['lab_director'];
				$director_email=$_POST['director_email'];
				$desc=$_POST['desc'];
			
				if(!$_POST['lab_director'] or !$_POST['director_email']){
					echo "<p>Lab Director or Director Email cannot be empty.<br /></p>";			
					exit;	
				}
			
				$name="`lab_name`,`lab_director`,`director_email`,`desc`";
				$value="'$lab_name','$lab_director','$director_email','$desc'";
				
				
				$conn = db_connect();
				mysqli_query($conn,"SET NAMES GB2312");
		
				$res=$conn->query("INSERT INTO `genomics_core`.`lab` ($name) VALUES ($value)");
				#echo "INSERT INTO `genomics_core`.`lab` ($name) VALUES ($value)<br>";
				if (!$res){
					echo "<p>Lab name already exists.</p>";
					
				}
				else{
					echo "<p>New lab $lab_name has been added successfully.</p>";
				}
			}
		 }
		 else{
				echo "<p>ERROR:2</p><br>";
				exitout();
				exit;
		 }
?>

</body>
</html>