<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
#box{
	width:150px;height: 150px;border: 1px solid red;
}
span{
	background-color: #e6ecff;
}
form{
	background-color: #e6ecff;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="XMLhttpReuest.js"></script>
<script src="dropzone.js"></script>
<link rel="stylesheet" href="dropzone.css" />

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>

<hr>
<br>
<h6>EXPORT TEXT</h6>
<br>
<table width="100%">
  <tr>
    <td width="50%" align="left" valign="top">
     <?php
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		$search_run_result=search("select distinct(run) from sangerseq_record ORDER BY run ASC");

   	?>  
      
	<form action="export_txt_file.php" method="get"><span>Select Run&nbsp;&nbsp;</span><select name="run">
		<option value="0">Select</option>
		
		<?php
			for($i=count($search_run_result)-1;$i>=0;$i--){
				echo "<option value=\"".$search_run_result[$i]['run']."\">".$search_run_result[$i]['run']."</option>";	
				}
		?>
		</select><span>&nbsp;</span>
		<input type="submit" class="button" name="submit"/>
	</form>
      
		<?php
			if($_GET['run']){
				$run=$_GET['run'];
				$result_run=search("select * from sangerseq_record where run='$run' ORDER BY tmp_id");
				#echo "select * from sangerseq_record where run=$run<br>";
				if(count($result_run)==0){
					echo "There is no record for this run.<br>";
				}
				else{
					$file_name="../genomics_core/export_txt/$run-".date("ymdHis").".txt";
					$fp = fopen($file_name, "w");//empty the file and write
					if($fp){ 
					
						for($i=0;$i<count($result_run);$i++){
							$flag=fwrite($fp,$result_run[$i]['run']."-".$result_run[$i]['tmp_id']."-".$result_run[$i]['Sample_name']."-".$result_run[$i]['Primer_type']."\t".$result_run[$i]['Sample_name']."\t".$result_run[$i]['Primer_type']."\t".$result_run[$i]['conc']."\t".$result_run[$i]['Size']."\t".$result_run[$i]['Lab']."\t".$result_run[$i]['Submitter']."\n"); 
							#echo "$flag<br>";
							if(!$flag){ 
								echo "Write failed.<br>"; 
								break; 
							} 
						}
					}
					else{ 
						echo "Cannot write to the .TXT file"; 
					} 
					fclose($fp); 
						
				}
				
				if (file_exists($file_name)){
					echo "<br>";
					echo "Export .TXT File:&nbsp;<a href=\"$file_name\" class=\"button\" target=\"_blank\">Export</a>";
					echo "<br>";
				} 
				else{
					echo "Something went wrong. Please contact the developer.";	
				}
				
			}
			
		?>
		</td>
		<td width="50%" valign="top">
		<?php require("search.php");?>
		</td>
	</tr>
</table>

</body>
</html>