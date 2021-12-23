<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
th, td, tr {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
th.two {
	color: #ffffff;
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
	   <h6>EDIT USER<h6>
	   <br>
	   
	   <?php 
			$permission=$result_user[0]['sangerseq'];
			$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
			
			if(count($result_user)==0){
				#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
				echo 'You are not an Administrator so you do not have permission to access this page.<br />';			
				exit;	
			}
		?>  
   </tr>
</table>

<?php 
		if($_GET['user_id'] or $_POST['add_new_user_name']){
			$result1=search("desc user");
			$count_result1=count($result1);
			if(!$_POST['add_new_user_name']){
				$result2=search("select distinct(lab_name) from lab");
				$count_result2=count($result2);
				$result3=search("select * from user where user_id='".$_GET['user_id']."'");
				$count_result3=count($result3);
				
				echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"edit_user.php\"  enctype=\"multipart/form-data\">";
				echo "<input type=\"hidden\" value=\"".$_GET['user_id']."\" name=\"user_id\">";
				echo "<table width=\"95%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\">";
				
				echo "<tr valign=\"top\"><td width=\"200\" align=\"right\">";
				echo "User Name";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"add_new_user_name\" id=\"add_new_user_name\" value=\"".$result3[0]['user_name']."\"/>*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Password";
				echo " :</td>";
				echo "<td><input type=\"password\" size=\"60\" name=\"add_new_passwd\" id=\"add_new_passwd\" value=\"".$result3[0]['passwd']."\"/>*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Confirm Password";
				echo " :</td>";
				echo "<td><input type=\"password\" size=\"60\" name=\"add_new_passwd_conf\" id=\"add_new_passwd_conf\"value=\"".$result3[0]['passwd']."\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Service";
				echo " :</td><td>";
				
				for($i=3;$i<$count_result1-2;$i++){	
					echo "<input name=\"".$result1[$i]["Field"]."\" type=\"checkbox\" value=\"".$result1[$i]["Field"]."\"";
					if($result3[0][$result1[$i]["Field"]]=='y'){
						echo "checked=\"checked\"";
					}
					echo "/>".$result1[$i]["Field"]."<br>";
				}
				#echo "<input name=\"main\" type=\"checkbox\" value=\"main\" />Main user <span style=\"color:gray;font-size:12px\">* make sure you want this user as a main user.</span>";
				echo "</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Lab";
				echo " :</td>";
				echo "<td>";
				
				echo "<select name=\"lab\">";
				
				for($i=0;$i<$count_result2;$i++){
					echo "<option value=\"".$result2[$i]['lab_name']."\"";
					if($result3[0]['lab']==$result2[$i]['lab_name']){
						echo " selected=\"selected\"";	
					}
					echo ">".$result2[$i]['lab_name']."</option>";
				}
				echo "</select>";
				
				echo "*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Email";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"email\" id=\"email\" value=\"".$result3[0]['email']."\"/>*</td></tr>";
	
	echo "<tr>";
				echo "  <td align=\"right\">&nbsp;</td>";
				echo "   <td><input type=\"submit\" name=\"button\" id=\"button\" class=\"button\" value=\"Submit\" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <input type=\"reset\" name=\"button2\" id=\"button2\"  class=\"button\" value=\"Reset \" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <a href=\"del_info_mysql.php?database=user&id=".$_GET['user_id']." \"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" onclick=\"javascript:return window.confirm('confirm to delete user ".$result3[0]['user_name']." ?');\"  value=\"Delete \" /></a></td>";
				echo " </tr>";
				#echo "     <a href=\"del_info_mysql.php?database=$database&id=$id \"><input type=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('confirm to delete oligo $id?');\"  value=\"Delete \" /></a>";
				echo "</table></form>";
			}
			else{
			
				$add_new_user_name=$_POST['add_new_user_name'];
				$add_new_passwd=$_POST['add_new_passwd'];
				$add_new_passwd_conf=$_POST['add_new_passwd_conf'];
				if($add_new_passwd!=$add_new_passwd_conf){
					echo 'Passwords do not match.<br />';			
					exit;	
				}
				$lab=$_POST['lab'];
				$email=$_POST['email'];
				if(!$_POST['lab'] or !$_POST['email']){
					echo "Lab or Email fields cannot be empty.<br />";			
					exit;	
				}
				
				$result1=search("desc user");
				$count_result1=count($result1);
				
				#UPDATE `genomics_core`.`user` SET `miseq`='n' WHERE `user_id`='5';
				
				#$name="user_name,passwd,";
				$value="user_name='$add_new_user_name',passwd='$add_new_passwd',";
				for($i=3;$i<$count_result1-2;$i++){	
					#$name.=$result1[$i]['Field'].",";
					if($_POST[$result1[$i]['Field']]){
						
						$value.=$result1[$i]['Field']."='y',";	
					}
					else{
						$value.=$result1[$i]['Field']."='n',";
					}
				}
				for($i=$count_result1-2;$i<$count_result1;$i++){	
					#$name.=$result1[$i]['Field'].",";
					$value.=$result1[$i]['Field']."='".$_POST[$result1[$i]['Field']]."',";	
					
				}
				
				$value=preg_replace('/,$/',' ',$value);
				#$name=preg_replace('/,$/',' ',$name);
				
				$conn = db_connect();
				mysqli_query($conn,"SET NAMES GB2312");
		
				#$res=$conn->query("INSERT INTO genomics_core.user($name) VALUES (".$value.")");
				$res=$conn->query("UPDATE genomics_core.user SET $value WHERE user_id='".$_POST['user_id']."'");
				#echo "UPDATE genomics_core.user SET $value WHERE user_id='".$_GET['user_id']."'<br>";
				if (!$res){
					echo "Error: mysql_1 " . mysql_error();
					
				}
				else{
					echo "<p>User $add_new_user_name has been edited successfully.</p>";
				}
			}
	
			#-----------------------------------------
		}
		else{
			$result1=search("select * from user ORDER BY lab");
			$count_result1=count($result1);
			if($count_result1>0){
				$result2=search("desc user");
				$count_result2=count($result2);
				$color[0]="#D2E9FF";	
				$color[1]="#e6ecff";
				echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"gray\" width=\"100%\">";
				echo "<tr align=\"center\" bgcolor=\"#666699\">";
				echo "<td>&nbsp;</td>";
				#for($i=1;$i<$count_result2;$i++){
				#	echo "<th width=\"200\" ><span style=\"color:#ffffff\">";
				#	#echo $result2[$i]['Field'];
				#	echo "</span></th>";	
				#}
				
				echo "<th class=\"two\">User Name</th><th class=\"two\">Password</th><th class=\"two\">SangerSeq</th><th class=\"two\">HiSeq</th><th class=\"two\">MiSeq</th><th class=\"two\">Lab Admin</th><th class=\"two\">Main</th><th class=\"two\">Lab Name</th><th class=\"two\">Email</th></tr>";
				
				for($i=0;$i<$count_result1;$i++){
					echo "<tr align=\"center\" bgcolor=\"".$color[$i%2]."\"><td><a href=\"edit_user.php?user_id=".$result1[$i]['user_id']."\">>></a></td>";
					for($j=1;$j<$count_result2;$j++){
						echo "<td>";
						if($result2[$j]['Field']=="passwd"){
							echo "******";
							echo "</td>";
							continue;	
						}
						echo $result1[$i][$result2[$j]['Field']];
						echo "</td>";		
					}
					echo "</tr>";
					
				}
				echo "</table>";
				
				
			 }
			 else{
					echo "ERROR:2<br>";
					exitout();
					exit;
			 }
		}
?>

</body>
</html>