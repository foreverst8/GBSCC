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
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>SEARCH RESULTS</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
     <?php
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
		
		if(count($result_user)==0){
			echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo "<p>You do not have permission to access this page.</p><br />";			
			exit;
		}
		
		$sample_count=0;
		if($_GET['sample_count']){
			$sample_count=$_GET['sample_count'];
		}
  	?>  
      
    <ul>
	<li> For sample preparation, please refer to the <a href="sanger_sample_preparation.php">"Sample Preparation"</a> instructions.</li>
	<li> <span style="color:red">Price</span> for Sanger Sequencing is <span style="color:red">33 MOP</span> per Reaction.</li>
	<li> For submission of sample names, please <span style="color:red">DO NOT use special characters</span> such as space(" "), hash("#") or asterisk("*"). The database only allows characters like "a-z,A-Z,0-9,-,_,."</li>
	<li>Submit your samples together with the hard-copy of the sequencing service form to the collection box located in <span style="color:red">N22-3009 before 2:00 p.m. every Monday</span>. The box is kept near the pH meter. If it is a <span style="color:red">public holiday on Monday</span>, the collection day will be on <span style="color:red">the next working day</span>.</li>
	</ul>
	<br>
	</td>
    <td valign="top">
    <?php require("search.php");?>
    </td>
	</tr>
</table>

<?php 
	 $tmp_id=$_GET['tmp_id'];
	 $keywords=$_GET['Keywords'];
	 $kk=0;
	 $column=array("run","tmp_id","Sample_name","DNA_type","conc","Size","Primer_type","Submitter","Lab","Email","Date");
	 
	 if($_GET['run']){
		   if($_GET['Keywords']!=""){
		    	if($result_user[0]['main']==y){
					$search_result=search("select * from sangerseq_record where run='".$_GET['run']."' and (Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
					$search_run_result=search("select distinct(run) from sangerseq_record where Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%'");
				}
				else{
					$search_result=search("select * from sangerseq_record where Submitter='".$result_user[0]['user_name']."' and run='".$_GET['run']."'  and (Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
					$search_run_result=search("select distinct(run) from sangerseq_record where Submitter='".$result_user[0]['user_name']."' and (Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
				}
			
			}
			else{
				if($result_user[0]['main']==y){
					$search_result=search("select * from sangerseq_record where run='".$_GET['run']."'");
					$search_run_result=search("select distinct(run) from sangerseq_record");
				}
				else{
					$search_result=search("select * from sangerseq_record where Submitter='".$result_user[0]['user_name']."' and run='".$_GET['run']."'");
					$search_run_result=search("select distinct(run) from sangerseq_record where Submitter='".$result_user[0]['user_name']."'");
				}
			}
	}
	else{
	 
	 if($_GET['Keywords']!=""){
			 
			if($result_user[0]['main']==y){
				
				$search_result=search("select * from sangerseq_record where run like '%$keywords%' or Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%'");
				$search_run_result=search("select distinct(run) from sangerseq_record where run like '%$keywords%' or Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%' ORDER BY run ASC");
			}
			else{
				
				$search_result=search("select * from sangerseq_record where (run like '%$keywords%' or Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%') and Submitter='".$result_user[0]['user_name']."'");
				$search_run_result=search("select distinct(run) from sangerseq_record where Submitter='".$result_user[0]['user_name']."' and ( run like '%$keywords%' or Sample_name like '%$keywords%' or DNA_type like '%$keywords%' or Primer_type like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%') ORDER BY run ASC");
				
			}
	 }
	 else{
			$kk=1;
			if($result_user[0]['main']==y){
            
				$search_result=search("select * from sangerseq_record");
				$search_run_result=search("select distinct(run) from sangerseq_record  ORDER BY seq_id");
	
			}
			else{
				$search_result=search("select * from sangerseq_record where Submitter='".$result_user[0]['user_name']."'");
				$search_run_result=search("select distinct(run) from sangerseq_record where Submitter='".$result_user[0]['user_name']."' ORDER BY run ASC");
			}	 
	}
		
}			
			
			$last_run_order=count($search_run_result)-1;
			
			$count_search_result=count($search_result); 
			if($count_search_result>0){
				
				echo "<table border=\"1\"  cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
				echo "<tr align=\"center\">";
				echo "<td width=\"100px\">Total Run</td>";
				echo "<td width=\"300px\">";
					
				echo "<form action=\"search_result.php\" method=\"get\">";
				echo "<input type=\"hidden\" name=\"Keywords\" value=\"".$keywords."\" id=\"Keywords\">";
				echo "<select name=\"run\" onChange=\"MM_jumpMenu('parent',this,0)\">";
				for($r=count($search_run_result)-1;$r>=0;$r--){
					
					echo "<option value=\"".$search_run_result[$r]['run']."\"";
					if($r==count($search_run_result)-1){
						echo " selected = \"selected\" ";	
					}
					echo ">".$search_run_result[$r]['run']."</option>";
				}
				echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" class=\"button\" name=\"submit\"></form>";
				echo "</td></tr></table><br>";
				echo "<p><b>Selected Run: </b></p>";
				echo $_GET['Keywords'].$_GET['run']."<br><br>";
				
				if(($_GET['run'] or $kk==1) and ($result_user[0]['main']==y)){
					echo "<a class=\"button\" href=\"export_txt_file.php?run=".$_GET['run']."\">Export .TXT File</a><br><br>";
				}
				
				echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
				echo "<tr align=\"center\">";
				if($result_user[0]['main']==y){
					echo "<td rowspan=\"2\" width=\"10px\">&nbsp;</td>";
				}
				echo "<td rowspan=\"2\" width=\"100px\">Run</td>";
				echo "<td rowspan=\"2\" width=\"40px\">No.</td>";
				echo "<td colspan=\"4\" width=\"600px\">DNA Template</td>";
				echo "<td rowspan=\"2\" width=\"100px\">Primer Type</td>";	
				echo "<td rowspan=\"2\" width=\"100px\">Submitter's Name</td>";	
				echo "<td rowspan=\"2\" width=\"100px\">Lab</td>";
				echo "<td rowspan=\"2\" width=\"100px\">Email</td>";
				echo "<td rowspan=\"2\" width=\"100px\">Date</td>";	
				echo "<td rowspan=\"2\" width=\"200px\">Result Download</td>";	
				echo "</tr>";
				echo "<tr align=\"center\">";
				echo "<td width=\"290px\">Sample Name</td>";
				echo "<td width=\"100px\">DNA Type</td>";
				echo "<td width=\"100px\">Conc. (ng/&micro;L)</td>";
				echo "<td width=\"80px\">Size (bp)</td>";
				echo "</tr>";

				$col=count($column);
				for($i=0;$i<$count_search_result;$i++){
					if($search_result[$i]['run']!=$search_run_result[$last_run_order]['run'] and ($_GET['run']=="")){
							continue;
					}
					echo "<tr align=\"center\">";
					
					if($result_user[0]['main']==y){
						echo "<td width=\"10\"><a class=\"button\" href=\"edit_record.php?tmp_id=".$search_result[$i]['tmp_id']."&run=".$search_result[$i]['run']."\">>></a></td>";
					}
					for($ii=0;$ii<$col;$ii++){
						echo "<td>";
						if($search_result[$i][$column[$ii]]==""){
							echo "&nbsp;";
						}
						else{
							echo $search_result[$i][$column[$ii]];
						}
						echo "</td>";
					}
					
					echo "<td>"; 
					$filesnames = scandir("../genomics_core/res/sanger/".$search_result[$i]['run']."/");
					
					$tmp=$search_result[$i]['run']."-".$search_result[$i]['tmp_id']."-";
					
					$k=0;
					for($f=2;$f<count($filesnames);$f++){
						if(preg_match("/$tmp.*seq$/",$filesnames[$f])){
							echo "<a class=\"button\" target=\"_blank\" href=\"../genomics_core/res/sanger/".$search_result[$i]['run']."/".$filesnames[$f]."\">Seq</a>";
							
							$k=1;
							break;
						}
					}
					for($f=2;$f<count($filesnames);$f++){
						if(preg_match("/$tmp.*ab1$/",$filesnames[$f])){
							
							echo ",";
							echo "<a class=\"button\" target=\"_blank\" href=\"../genomics_core/res/sanger/".$search_result[$i]['run']."/".$filesnames[$f]."\">ab1</a>";
							$k=1;
							break;
						}
					}
					
					if($k==0){
						echo "<p>Processing</p>";	
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";	
				
			}
			else{
				echo "<p>No record found.</p><br>";	
			}
	 
	
?>

<script language="javascript" type="text/javascript">
new TableSorter("tb1");
</script>

</body>
</html>