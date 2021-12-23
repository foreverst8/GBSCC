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
	   <h6>EDIT LAB<h6>
	   <br>

	<table border="0" cellspacing="0">
      <tr>
		<td width="650">
		<?PHP
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo '<p>You are not an administrator so you do not have permission to access this page.</p><br />';			
			exit;	
		}
		?>  
     	</td>
      </tr>
    </table>

	<?php 
		if($_GET['lab_id']){
			$result1=search("desc user");
			$count_result1=count($result1);
			if(!$_GET['lab_name']){
				
				$result3=search("select * from lab where lab_id='".$_GET['lab_id']."'");
				$count_result3=count($result3);
				
				echo "<form id=\"form1\" name=\"form1\" method=\"get\" action=\"edit_lab.php\"  enctype=\"multipart/form-data\">";
				echo "<input type=\"hidden\" value=\"".$_GET['lab_id']."\" name=\"lab_id\">";
				echo "<table width=\"95%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
				
				
				echo "<tr valign=\"top\"><td width=\"200\" align=\"right\">";
				echo "Lab Name";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"lab_name\" id=\"lab_name\" value=\"".$result3[0]['lab_name']."\"/>*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Lab Director";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"lab_director\" id=\"lab_director\" value=\"".$result3[0]['lab_director']."\"/>*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Director Email";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"director_email\" id=\"director_email\"value=\"".$result3[0]['director_email']."\" />*</td></tr>";
				
				echo "<tr valign=\"top\"><td  width=\"200\" align=\"right\">";
				echo "Description";
				echo " :</td>";
				echo "<td><input type=\"text\" size=\"60\" name=\"desc\" id=\"desc\"value=\"".$result3[0]['desc']."\" />*</td></tr>";
				
				
				echo "<tr>";
				echo "   <td align=\"right\">&nbsp;</td>";
				echo "   <td><span style=\"color:gray;font-size:12px\">* means necessary field.</span></td>";
				echo " </tr>";
				echo " <tr>";
				echo "  <td align=\"right\">&nbsp;</td>";
				echo "   <td><input type=\"submit\" name=\"button\" id=\"button\" class=\"button\" value=\"Submit\" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <input type=\"reset\" name=\"button2\" class=\"button\" id=\"button2\"  value=\"Reset \" />";
				echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "     <a href=\"del_info_mysql.php?database=lab&id=".$result3[0]['lab_id']." \"><input type=\"button\" name=\"button3\" class=\"button\" id=\"button3\" onclick=\"javascript:return window.confirm('confirm to delete lab ".$result3[0]['lab_name']."?');\"  value=\"Delete \" /></a></td>";
				echo " </tr>";
				
				echo "</table></form>";
			}
			else{
			
				
				$lab_name=$_GET['lab_name'];
				$lab_director=$_GET['lab_director'];
				$director_email=$_GET['director_email'];
				$desc=$_GET['desc'];
				
				if($desc==""){
					$desc="-";	
				}
				
				
				$result1=search("desc lab");
				$count_result1=count($result1);
				
				#UPDATE `genomics_core`.`user` SET `miseq`='n' WHERE `lab_id`='5';
				
				#$name="user_name,passwd,";
				$value="`lab_name`='$lab_name',`lab_director`='$lab_director',`director_email`='$director_email',`desc`='$desc'";
				#`lab_name`='Bee',`lab_director`='Aye',`director_email`='a@a',`desc`='NANIwqtret'
				
				$value=preg_replace('/,$/',' ',$value);
				#$name=preg_replace('/,$/',' ',$name);
				
				$conn = db_connect();
				mysqli_query($conn,"SET NAMES GB2312");
		
				#$res=$conn->query("INSERT INTO genomics_core.user($name) VALUES (".$value.")");
				$res=$conn->query("UPDATE genomics_core.lab SET $value WHERE `lab_id`='".$_GET['lab_id']."'");
				
				#echo "UPDATE genomics_core.lab SET $value WHERE lab_id='".$_POST['lab_id']."'<br>";
				if (!$res){
					echo "Error: mysql_1 " . mysql_error();
					
				}
				else{
					echo "<p>Lab $lab_id is edited.</p>";
				}
				
			}
			
			#-----------------------------------------
		}
		else{
			$result1=search("select * from lab");
			$count_result1=count($result1);
			if($count_result1>0){
				$result2=search("desc lab");
				$count_result2=count($result2);
				$color[0]="#D2E9FF";	
				$color[1]="#e6ecff";
				$lab_item=array("lab_id","lab_name","lab_director","director_email","desc");
				
				echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"gray\" width=\"100%\">";
				echo "<tr align=\"center\" bgcolor=\"#666699\">";
				echo "<td>&nbsp;</td>";
				#for($i=1;$i<$count_result2;$i++){
				#	echo "<th width=\"200\" ><span style=\"color:#CCCCCC\">";
				#	echo $lab_item[$i];
				#	echo "</span></th>";	
				#}
				echo "<th class=\"two\">Lab Name</th><th class=\"two\">Lab Director</th><th class=\"two\">Director Email</th><th class=\"two\">Description</th></tr>";
				
				for($i=0;$i<$count_result1;$i++){
					echo "<tr align=\"center\" bgcolor=\"".$color[$i%2]."\"><td><a href=\"edit_lab.php?lab_id=".$result1[$i]['lab_id']."\">>></a></td>";
					for($j=1;$j<$count_result2;$j++){
						echo "<td>";
						if($result2[$j]['Field']=="passwd"){
							echo "******";
							echo "</td>";
							continue;	
						}
						if($result1[$i][$result2[$j]['Field']]==""){
							echo "&nbsp;";
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
     
	</td>
  </tr>
</table>

</body>
</html>
