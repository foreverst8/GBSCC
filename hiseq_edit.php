<html>
<head>
<style>
body {
	margin-left:2%;
	margin-right:2%;
}
</style>
</head>
<body>
<br>

<?php session_start();?>
<?php require('login.php');?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

<script type="text/javascript"> 
       function gradeChange1(){ 
        var objS = document.getElementById("Category"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="Others"){
			//document.getElementById("ohter_category").style.display="block";
			document.getElementById("tb_cate").style.display="block";
		}
		else{
			//document.getElementById("ohter_category").style.display="none";
			document.getElementById("tb_cate").style.display="none";
		}
       } 
	   function gradeChange2(){ 
        var objS = document.getElementById("Kit"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="Others"){
			//document.getElementById("ohter_kit").style.display="block";
			document.getElementById("tb_kit").style.display="block";
		}
		else{
			//document.getElementById("ohter_kit").style.display="none";
			document.getElementById("tb_kit").style.display="none";
		}
       } 
	   function gradeChange3(){ 
        var objS = document.getElementById("Index_Number"); 
        var val = objS.options[objS.selectedIndex].value; 
		if(val=="1"){
			//document.getElementById("ohter_kit").style.display="block";
			document.getElementById("tb_index").style.display="block";
			document.getElementById("span_index").style.display="none";
		}
		else{
			//document.getElementById("ohter_kit").style.display="none";
			document.getElementById("tb_index").style.display="none";
			document.getElementById("span_index").style.display="block";
		}
       }
</script>

<hr>
<br>
<h6>EDIT SAMPLE INFORMATION</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
     <?PHP
	  	
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo '<p>You do not have permission to access this page.</p><br />';			
			exit;
		}
   	?>  

	<?php
	$conn = db_connect();
	$Hiseq_Sample_ID=$_GET['ID'];
	$result_sample=search("select * from hiseq_sample where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");

	if(count($result_sample)<1){
		echo "Could not find the record.<br>";
	}
	else{
			echo "<br><form action=\"hiseq_edit_mysql.php\" method=\"post\">";
			echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
			echo "<input type=\"hidden\" name=\"Hiseq_Sample_ID\" value=\"".$Hiseq_Sample_ID."\"/>";
			echo "<tr>";
			echo "<td colspan=\"4\">";
			echo "<table border=\"1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
			echo "<tr align=\"center\"/>";
			echo "<td width=\"10%\">";
			echo "Submitter_Name:";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Submitter_Name\" value=\"".$result_sample[0]['Submitter_Name']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "Lab:&nbsp;";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"lab\" value=\"".$result_sample[0]['lab']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "Date:";
			echo "</td>";
			echo "<td>";
			echo $result_sample[0]['date']."<input type=\"hidden\" name=\"date\" value=\"".$result_sample[0]['date']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "Run:";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Run\" value=\"".$result_sample[0]['Run']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "Lane:";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Lanes\" value=\"".$result_sample[0]['Lanes']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "Lane Count:";
			echo "</td>";
			echo "<td>";			
			echo "<input type=\"text\" name=\"lane_count\" value=\"".$result_sample[0]['lane_count']."\"/>";
			echo "</td>";			
			echo "</tr>";
			echo "</table>";
			
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td align=\"right\" >";
			echo "Sample Name:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\" >";
			echo "<input type=\"text\" name=\"Sample_Name\" size=\"50\" value=\"".$result_sample[0]['Sample_Name']."\"/>";
			echo "</td>";
			echo "<td align=\"right\" width=\"200\">";
			echo "Request Reads Count(M):";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<input type=\"number\" name=\"reads_count\" min=\"1\" size=\"10\" value=\"".$result_sample[0]['reads_count']."\"/>";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td align=\"right\">";
			echo "No. of multiplexed libraries&nbsp;";
			echo "</td>";
			echo "<td align=\"left\" >";
			echo "<input type=\"number\" name=\"libraries\" min=\"1\"  value=\"".$result_sample[0]['libraries']."\"/>";
			echo "</td>";
			echo "<td align=\"right\" >";
			echo "Read Length(bp):&nbsp;";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<select name=\"Read_Length\" ><option value=\"".$result_sample[0]['Read_Length']."\" selected=\"selected\">".$result_sample[0]['Read_Length']."</option><option value=\"60\">&nbsp;&nbsp;60&nbsp;&nbsp;</option><option value=\"100\">&nbsp;&nbsp;100&nbsp;&nbsp;</option></select>";
			echo "</td>";
			
			echo "</tr>";
		
			
			echo "<tr>";
			echo "<td  align=\"right\">";
			echo "Index Number:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<select name=\"Index_Number\" id=\"Index_Number\"  onchange=\"gradeChange3()\">";
			echo "<option value=\"".$result_sample[0]['Index_Number']."\" selected=\"selected\">".$result_sample[0]['Index_Number']."</option>";
			echo "<option value=\"0\" >0</option>";
			echo "<option value=\"1\" >1</option>";
			echo "<option value=\"2\" >2</option>";
			echo "</select>";
			echo "</td>";
			echo "<td align=\"right\">";
			echo "Index Position:&nbsp;";
			echo "</td>";
			echo "<td>";
			echo "<select name=\"Index_Position\">";
			echo "<option value=\"".$result_sample[0]['Index_Position']."\" selected=\"selected\">".$result_sample[0]['Index_Position']."</option>";
			echo "<option value=\"3_end_adapor\" >3' end of adapter</option>";
			echo "<option value=\"on_adaptor\" >on adapter</option>";
			echo "</select>";
			echo "</td>";
			echo "</tr>";
		
			echo "<tr>";
			echo "<td align=\"right\" >";
			echo "Category:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<select name=\"Category\" id=\"Category\" onchange=\"gradeChange1()\">";
			echo "<option value=\"".$result_sample[0]['Category']."\" selected=\"selected\">".$result_sample[0]['Category']."</option>";
			echo "<option value=\"Targeted_Resequencing\">Targeted Resequencing</option>";
			echo "<option value=\"Genome_Sequencing\">Genome Sequencing</option>";
			echo "<option value=\"RNA_Sequencing\">RNA Sequencing</option>";
			echo "<option value=\"ChIP_Sequencing\">ChIP Sequencing</option>";
			echo "<option value=\"Library_QC\">Library QC</option>";
			echo "<option value=\"Others\">Others</option>";
			echo "</select>";
			echo "<table id=\"tb_cate\" style=\"display:none\" ><tr><td><span id=\"note2\" style=\"font-size:12px\">Please Specify:</span></td><td><input type=\"text\" name=\"ohter_category\" id=\"ohter_category\"/></td></tr></table>";
			echo "</td>";
			echo "<td align=\"right\">";
			echo "Single/Paird end:&nbsp;";
			echo "</td>";
			echo "<td>";
			echo "<select name=\"end\">";
			echo "<option value=\"".$result_sample[0]['end']."\" selected=\"selected\">".$result_sample[0]['end']."</option>";
			echo "<option value=\"single_end\" >Single End</option>";
			echo "<option value=\"paired_end\" >Paired End</option>";
			echo "</select>";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td align=\"right\" >";
			echo "Average Size of Library Pool:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<input type=\"text\" name=\"Avg_Pool\" value=\"".$result_sample[0]['Avg_Pool']."\" >";
			echo "</td>";
			echo "<td align=\"right\">";
			echo "Hiseq/Miseq:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\" >";
		
			echo "<input type=\"text\" name=\"Mode\" value=\"".$result_sample[0]['Mode']."\" >";
			
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td align=\"right\" >";
			echo "Concentration of Library Pool:&nbsp;";
			echo "</td>";
			echo "<td  align=\"left\">";
			
			echo "<input type=\"text\" name=\"Conc\" value=\"".$result_sample[0]['Conc']."\" >";
			
			echo "</td>";
			echo "<td align=\"right\">";
			echo "Volume of Library Pool:&nbsp;";
			echo "</td>";
			echo "<td align=\"left\">";
			
			echo "<input type=\"text\" name=\"Volume\" value=\"".$result_sample[0]['Volume']."\" >";
			
			echo "</td>";
			echo "</tr>";
			
			
			echo "<tr align=\"center\">";
			echo "<td align=\"right\" >";
			echo "Remarks:&nbsp;";
			echo "</td>";
			echo "<td colspan=\"2\" align=\"left\">";
			echo "<textarea name=\"Remark\" rows=\"5\" cols=\"80\">".$result_sample[0]['Remark']."</textarea>";
			echo "</td>";
			echo "<td align=\"left\">";
			echo "<span style=\"font-size:12px;color:gray\">&nbsp;If you need the Core to analyze the data, please list the brief purpose of the library:<br>&nbsp;(For eg.  What is your Case/Control and what do you need the Core to do)</span>";
			echo "</td>";
			
			echo "</tr>";
			
			/*echo "<tr align=\"center\">";
			echo "<td>";
			echo "Concentration of Library Pool (nM)";
			echo "</td>";
			echo "<td>";
			echo "Volume of Library Pool submitted (&micro;L)";
			echo "</td>";
			echo "<td>";
			echo "Buffer for Library Pool";
			echo "</td>";
			echo "<td>";
			echo "Average GC content";
			echo "</td>";
			echo "</tr>";
			
			echo "<tr align=\"center\">";
			echo "<td>";
			echo "<input type=\"text\" name=\"Concentration\" value=\"".$result_sample[0]['Concentration']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Volume\"  value=\"".$result_sample[0]['Volume']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Buffer\"  value=\"".$result_sample[0]['Buffer']."\"/>";
			echo "</td>";
			echo "<td>";
			echo "<input type=\"text\" name=\"Average_GC\"  value=\"".$result_sample[0]['Average_GC']."\"/>";
			echo "</td>";
			echo "</tr>";*/
			
			echo "<td colspan=\"4\">";
			echo "Bioanalyzer Result";
			echo "</td>";
			echo "</tr>";
			echo "<tr align=\"center\">";
			echo "<td colspan=\"4\">";
			
			// echo "".$result_sample[0]['bioanalyzer_file']."<br>";
			
			$phrase  = "".$result_sample[0]['bioanalyzer_file']."";
			
			$healthy = "./res/";
			$yummy = "http://161.64.198.12/genomics_core/res/";
			
			$newphrase = str_replace($healthy, $yummy, $phrase);	
			
			// echo "<embed src=\"".$result_sample[0]['bioanalyzer_file']."\" width=\"800\" height=\"600\">";
			echo "<embed src=\"".$newphrase."\" width=\"800\" height=\"600\">";
			echo "</td>";
			echo "<tr align=\"left\">";
			
			echo "</table><br>";
			echo "<br>";
			
			$result_Library=search("select * from hiseq_library where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
			
			if(count($result_Library)<1){
				echo "There is no Library record.<br>";	
			}
			else{
				
				$I7="";
				$I5="";
				$barcode="";
				$Kit="";
				
				$result_I7=search("select distinct No,Seq from Index_barcode where Position='I7'");
				$result_I5=search("select distinct No,Seq from Index_barcode where Position='I5'");
				$result_barcode=search("select distinct No,Seq from Index_barcode where Position='-'");
				$result_Kit=search("select distinct Kit from Index_barcode where Position='I7'");
				
				
				
				for($ii=0;$ii<count($result_I7);$ii++){
					if(preg_match("/NEB/",$result_I7[$ii]['No'])){
						$I7.="<option value=\"".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."\">".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."</option>";	
					}
				}
				for($ii=0;$ii<count($result_I7);$ii++){
					if(!preg_match("/NEB/",$result_I7[$ii]['No'])){
						$I7.="<option value=\"".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."\">".$result_I7[$ii]['No']." ".$result_I7[$ii]['Seq']."</option>";	
					}	
				}
				for($ii=0;$ii<count($result_I5);$ii++){
					$I5.="<option value=\"".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."\">".$result_I5[$ii]['No']." ".$result_I5[$ii]['Seq']."</option>";	
				}
				for($ii=0;$ii<count($result_barcode);$ii++){
					$barcode.="<option value=\"".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."\">".$result_barcode[$ii]['No']." ".$result_barcode[$ii]['Seq']."</option>";	
				}
				
				for($ii=0;$ii<count($result_Kit);$ii++){
					$Kit.="<option value=\"".$result_Kit[$ii]['Kit']."\">".$result_Kit[$ii]['Kit']."</option>";	
				}
				$Kit.="<option value=\"ChrisLabProtocal\">ChrisLabProtocal</option>";
				
				echo "<h6>LIBRARY INFORMATION</h6><br>";
				echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
				echo "<tr align=\"center\">";
				echo "<td>";
				echo "Library ID";
				echo "</td>";
				echo "<td>";
				echo "Sample Name";
				echo "</td>";
				echo "<td>";
				echo "Library Name";
				echo "</td>";
				echo "<td>";
				echo "Project Type";
				echo "</td>";
				echo "<td>";
				echo "Construction  Kit";
				echo "</td>";
				echo "<td>";
				echo "I7 Index";
				echo "</td>";
				echo "<td>";
				echo "I5 Index";
				echo "</td>";
				echo "<td>";
				echo "Barcode";
				echo "</td>";
				echo "<td>";
				echo "Buffer for the Library Pool";
				echo "</td>";
				echo "<td>";
				echo "Concentration of the Library Pool(nM)";
				echo "</td>";
				echo "<td>";
				echo "Volume of the Library Pool submitted(&micro;L)";
				echo "</td>";

				echo "</tr>";
				
				for($i=0;$i<count($result_Library);$i++){
					echo "<tr>";
					
					echo "<td>";
					echo "<input type=\"hidden\" name=\"Hiseq_Library_ID"."_".$i."\"  value=\"".$result_Library[$i]['Hiseq_Library_ID']."\"/>".$result_Library[$i]['Hiseq_Library_ID'];
					echo "</td>";
					echo "<td>";
					echo "<input type=\"text\" name=\"Sample_Name"."_".$i."\"  value=\"".$result_sample[0]['Sample_Name']."\"/>";
					echo "</td>";
					echo "<td>";
					echo "<input type=\"text\" name=\"Library_Name"."_".$i."\"  value=\"".$result_Library[$i]['Library_Name']."\"/>";
					echo "</td>";
					echo "<td>";
					echo "<input type=\"text\" name=\"Project_Type"."_".$i."\"  value=\"".$result_Library[$i]['Project_Type']."\"/>";
					echo "</td>";
					
					echo "<td  bgcolor=\"#FFFFFF\">";
					echo "<select name=\"Construction_Kit_".$i."\" id=\"Construction_Kit_".$i."\">";
					echo "<option value=\"".$result_Library[$i]['Kit']."\" selected=\"selected\">".$result_Library[$i]['Kit']."</option>";
					echo "$Kit";
					echo "</select>";
					echo "</td>";
					echo "<td  bgcolor=\"#FFFFFF\">";
					echo "<select name=\"I7_Index_".$i."\" id=\"I7_Index_".$i."\">";
					echo "<option value=\"".$result_Library[$i]['I7_No']." ".$result_Library[$i]['I7_Seq']."\" selected=\"selected\">".$result_Library[$i]['I7_No']." ".$result_Library[$i]['I7_Seq']."</option>";
					#echo "$I7";
					echo "</select>";
					echo "</td>";
					echo "<td  bgcolor=\"#FFFFFF\">";
					echo "<select name=\"I5_Index_".$i."\" id=\"I5_Index_".$i."\">";
					echo "<option value=\"".$result_Library[$i]['I5_No']." ".$result_Library[$i]['I5_Seq']."\" selected=\"selected\">".$result_Library[$i]['I5_No']." ".$result_Library[$i]['I5_Seq']."</option>";
					#echo "$I5";
					echo "</select>";
					echo "</td>";
					echo "<td bgcolor=\"#FFFFFF\">";
					echo "<select name=\"barcode_".$i."\" id=\"barcode_".$i."\">";
					echo "<option value=\"".$result_Library[$i]['Barcode_No']." ".$result_Library[$i]['Barcode_Seq']."\" selected=\"selected\">".$result_Library[$i]['Barcode_No']." ".$result_Library[$i]['Barcode_Seq']."</option>";
					#echo "$barcode";
					echo "</select>";
					echo "</td>";
					echo "<td>";
					#echo $result_Library[$i]['Buffer'];
					echo "<input type=\"text\" name=\"Buffer"."_".$i."\"  value=\"".$result_Library[$i]['Buffer']."\"/>";
					echo "</td>";
					echo "<td>";
					echo "<input type=\"text\" name=\"Conc"."_".$i."\"  value=\"".$result_Library[$i]['Conc']."\"/>";
					echo "</td>";
					echo "<td>";
					#echo $result_Library[$i]['Volume'];
					echo "<input type=\"text\" name=\"Volume"."_".$i."\"  value=\"".$result_Library[$i]['Volume']."\"/>";
					echo "</td>";
					
					echo "</tr>";
					
				}
				echo "</table>";
				
				
				echo "<script type=\"text/javascript\">";
				for($i=0;$i<count($result_Library);$i++){
					
					echo "$('#Construction_Kit_".$i."').editableSelect();";
					echo "$('#barcode_".$i."').editableSelect();";
					echo "$('#I7_Index_".$i."').editableSelect();";
					echo "$('#I5_Index_".$i."').editableSelect();";
						
				}
				
				echo "</script><br><br>";
	
				
			}
				
			
			echo "<input type=\"reset\" class=\"button\" value=\"Reset\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"del_info_mysql.php?database=hiseq_sample&id=".$result_sample[0]['Hiseq_Sample_ID']." \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure you want to delete this sample?');\"  value=\"Delete \" /></a>";
			echo "</form>";
	}
	?>
	</td>
	<td valign="top">
	<?php require("search_hiseq.php");?>
	</td>
  </tr>
</table>
</body>
</html>