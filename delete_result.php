<html>
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

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<?php 
session_start();
require('login.php');?>  

<hr>
<br>
<h6>DELETE RESULT<h6>
<br>
   
<table>
  <tr>
	<td align="left" valign="top">
	
	<?PHP
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		
   	?>  
   			
     <?php 
	  $run=$_GET['run'];
	  $name=$_GET['name'];
	  
	  #echo "X $run";
	  #echo "X $name";
	  
	 $result_run=search("select distinct(run) from sangerseq_record");
	    
	  echo "<table border=\"0\"  cellpadding=\"0\" cellspacing=\"0\" >";
	  
	  echo "<tr align=\"center\">";
	  echo "<td align=\"left\">Total Run: </td>";
	  
	  echo "<td  align=\"left\">";
	  echo "<form action=\"delete_result.php\" method=\"get\">";
	  echo "<select name=\"run\">";
	  echo "<option value=\"0\">Select a run</option>";
	  for($r=count($result_run)-1;$r>=0;$r--){
		  
		  echo "<option value=\"".$result_run[$r]['run']."\"";
		  #if($r==count($result_run)-1){
			#  echo " selected = \"selected\" ";	
		  #}
		  
		  echo ">".$result_run[$r]['run']."</option>";
	  }
	  echo "</select>&nbsp;<input type=\"submit\" class=\"button\" name=\"submit\"></form>";
	  echo "</td></tr></table><br>";
	   
	#$hostdir=dirname("./res");
	
	
	
	  if($_GET['name']){
			unlink("../genomics_core/res/sanger/$run/$name");  
			echo "<br>$name has been deleted.<br><br><br>";
		}
	 
	  if($_GET['run'] and $_GET['run']!="0"){
		
		echo "<span style=\"color:red\">Warning</span>: Deletion is permanent!";
		echo "<br>Uploaded files must have names that start with their RUN ID in order to be detected!<br><br>";
		$filesnames = scandir("../genomics_core/res/sanger/$run"); 
		for($i=2;$i<count($filesnames);$i++){
			if(preg_match("/^$run/",$filesnames[$i])){
				echo "<a href=\"delete_result.php?name=".$filesnames[$i]."&run=$run \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Confirm to delete file ".$filesnames[$i]." ?');\"  value=\"Delete \" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "$filesnames[$i]<br>";		
			}
		} 
	  }
	  #else{
		 #$filesnames = scandir("./res/sanger/$run");  
		 #for($i=2;$i<count($filesnames);$i++){
		 #	if(preg_match("/^R/",$filesnames[$i])){
		#		echo "     <a href=\"delete_result.php?name=".$filesnames[$i]." \"><input type=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('confirm to delete file ".$filesnames[$i]." ?');\"  value=\"Delete \" /></a>&nbsp;&nbsp;-->&nbsp;&nbsp;";
		#		echo "$filesnames[$i]<br>";		
		#	}
		# }
	 # }
	 ?>
	  </td>
      <td valign="top">
       <?php require("search.php");?>
      </td>
      </tr>
      </table>
	  
</body>
</html>