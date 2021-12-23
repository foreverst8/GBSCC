<html>
<head>
<style>
a, a:visited { 
    color:#002A60; text-decoration:none; 
}
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

<br>
<table width="100%" border="0"  cellspacing="0">
  <tr>
	<td align="left" valign="top">
	<?php require('login.php');?>
	<hr>
	<br>
	<h6>ADD NEW USER<h6>
	<br>
	<?php 
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and (main='y' or lab_admin='y')");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You are not an Administrator so you do not have permission to access this page.<br />';exit;	
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
		$result1=search("desc user");
		$count_result1=count($result1);
		$result2=search("select distinct(lab_name) from lab");
		$count_result2=count($result2);
		if($count_result1>0){
			if(!$_POST['add_new_user_name']){
				echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"add_new_user.php\"  enctype=\"multipart/form-data\">";
				echo "<table width=\"95%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\">";
	
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "User Name";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"add_new_user_name\" id=\"add_new_user_name\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Password";
				echo " :</td>";
				echo "<td><input type=\"password\" size=\"60\" name=\"add_new_passwd\" id=\"add_new_passwd\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Confirm Password";
				echo " :</td>";
				echo "<td><input type=\"password\" size=\"60\" name=\"add_new_passwd_conf\" id=\"add_new_passwd_conf\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Service";
				echo " :</td><td>";
				
				for($i=3;$i<$count_result1-4;$i++){	
					echo "<input name=\"".$result1[$i]["Field"]."\" type=\"checkbox\" value=\"".$result1[$i]["Field"]."\" checked=\"checked\"/>".$result1[$i]["Field"]."<br>";
				}
				if($result_user[0]['main']=='y'){
					echo "<input name=\"lab_admin\" type=\"checkbox\" value=\"lab_admin\" />Lab admin user <span style=\"color:gray;font-size:12px\">*Make sure you want this user as a <b>Lab admin user</b>.</span><br>";
					echo "<input name=\"main\" type=\"checkbox\" value=\"main\" />Main user <span style=\"color:gray;font-size:12px\">*Make sure you want this user as a <b>main user</b>.</span>";
				}
				echo "</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Lab";
				echo " :</td>";
				echo "<td>";
				if($result_user[0]['main']=='y'){
					echo "<select name=\"lab\">";
					echo "<option value=\"0\" selected=\"selected\">Select lab</option>";
					for($i=0;$i<$count_result2;$i++){
						echo "<option value=\"".$result2[$i]['lab_name']."\">".$result2[$i]['lab_name']."</option>";
					}
					echo "</select>*";
				}
				else{
					echo "<input type=\"hidden\" name=\"lab\" value=\"".$result_user[0]['lab']."\">".$result_user[0]['lab'];	
				}
				echo "</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200px\" align=\"right\">";
				echo "Email";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"email\" id=\"email\" />*</td></tr>";
				
				

				echo " <tr>";
				echo "  <td align=\"right\">&nbsp;</td>";
				echo "   <td><input type=\"submit\" name=\"button\" id=\"button\" value=\"Submit\" class=\"button\" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <input type=\"reset\" name=\"button2\" id=\"button2\"  value=\"Reset \" class=\"button\" /></td>";
				echo " </tr>";
				echo "</table></form>";
			}
			else{
				
				$add_new_user_name=$_POST['add_new_user_name'];
				$add_new_passwd=$_POST['add_new_passwd'];
				$add_new_passwd_conf=$_POST['add_new_passwd_conf'];
				if($add_new_passwd!=$add_new_passwd_conf){
					echo '<p>Password and password confirmation are not the same.<br><br></p>';			
					echo "</td></tr></table>";
					exit;	
				}
				$lab=$_POST['lab'];
				$email=$_POST['email'];
				
				
				if($_POST['lab']=="0"){
					echo "<p>Please select a lab.<br><br/></p>";	
					echo "</td></tr></table>";
					exit;	
				}
				
				if(!$_POST['email']){
					echo "<p>Email cannot be empty.<br><br/></p>";		
					echo "</td></tr></table>";
					exit;	
				}
				
				$name="user_name,passwd,";
				$value="'$add_new_user_name','$add_new_passwd',";
				for($i=3;$i<$count_result1-2;$i++){	
					$name.=$result1[$i]['Field'].",";
					if($_POST[$result1[$i]['Field']]){
						
						$value.="'y',";	
					}
					else{
						$value.="'n',";
					}
				}
				for($i=$count_result1-2;$i<$count_result1;$i++){	
					$name.=$result1[$i]['Field'].",";
					$value.="'".$_POST[$result1[$i]['Field']]."',";	
					
				}
				
				$value=preg_replace('/,$/',' ',$value);
				$name=preg_replace('/,$/',' ',$name);
				
				$conn = db_connect();
				mysqli_query($conn,"SET NAMES GB2312");
		
				$res=$conn->query("INSERT INTO genomics_core.user($name) VALUES (".$value.")");
				//echo "INSERT INTO core_server.$database($name) VALUES (".$value.")";
				if (!$res){
					echo "INSERT INTO genomics_core.user($name) VALUES (".$value.")";
					echo "Error: mysql_1 " . mysql_error();
					
				}
				else{
					echo "<p>New user $add_new_user_name has been added successfully.</p>";
				}
			}
		 }
		 else{
				echo "ERROR:2<br>";
				exitout();
				exit;
		 }
?>

</body>
</html>