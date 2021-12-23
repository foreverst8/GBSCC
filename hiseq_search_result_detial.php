<html>
<head>
<style>
body {
	margin-left:2%;
	margin-right:2%;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 0px;
    margin-bottom: 2px;
}
</style>
</head>
<body>
<br>

<?php 
session_start();
require('login.php');?> 

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<script language="javascript"> 
function printdiv(printpage) { 
	var headstr = "<html><head><title></title></head><body>"; 
	var footstr = "</body>"; 
	var newstr = document.all.item(printpage).innerHTML; 
	var oldstr = document.body.innerHTML; 
	document.body.innerHTML = headstr+newstr+footstr; 
	window.print(); 
	document.body.innerHTML = oldstr; 
	return false; 
}
function trans(tb,dv){
	var rows = document.getElementById(tb).rows.length;
	var cells = document.getElementById(tb).rows.item(0).cells.length;
	alert(cells);
	var str="";
	for(i=0;i<rows;i++){
		var str2="";
		for(j=0;j<cells;j++){
			str2=str2+"<td>"+document.getElementById(tb).rows[i].cells[j].innerText+"</td>";
			//alert(document.getElementById("tb1").rows.item(i).cells.item(j).value)
			//alert(document.getElementById("tb1").rows[i].cells[j].innerText)
		}
		str=str+"<tr>"+str2+"</tr>";
		
	}
	document.getElementById(dv).innerHTML="<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">"+str+"</table>";
	alert(dv);
	printdiv(dv);
	
} 
</script> 
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

<h6>FHS ILLUMINA SEQUENCING SERVICE<h6>

<table>
  <tr>
  	<td align="left" valign="top">
	<br>
    
    <?PHP
	  	
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
	?>
	
	<ul>
	<li>For sample preparation, please refer to the NGS sample preparation instructions: <a class="button" href="ngs_sample_preparation.php">Click</a>.</li>
	<li> For submission of sample names, please <span style="color:red">DO NOT use special characters</span> such as space(" "), hash("#"), asterisk("*") or hyphen("-"). The database only allows characters like "a-z,A-Z,0-9,_,."</li>
	<li>The price of <span style="color:red">Hiseq</span> Sequencing:
	<ul>
		<li class="end">Single-end 60 bp, ~230-250M reads/Lane, MOP 8,000.</li>
		<li class="end">Paired-end 60 bp, ~230-280M reads/Lane, MOP 12,300.</li>
		<li class="end">Paired-end 100 bp, ~230-280M reads/Lane, MOP 16,700.</li>
	</ul>
	</li>	
	<li>The price of <span style="color:red">Miseq</span> Sequencing:
	<ul>
		<li class="end">Per run, ~20-25M reads, MOP 8,900.</li>
	</ul>	
	<li>The kit,index or barcode information can be checked from the Kit index database: <a class="button" href="check_kit.php">Click</a>. The kit name or the index no. should exactly match with the database.</li>
	</ul>
      
	</td>
    <td valign="top">
    <?php require("search_hiseq.php");?>
    </td>
  </tr>
</table>

<br>
<h6>DETAILS<h6>
<br>
<table width="800" border="0" cellspacing="0"><tr><td width="800" align="left" valign="top"><p>Print this page: </p><input type="button" class="button" onClick="printdiv('div_print');" value=" Print "/></td></tr></table>

<br>
<div id="div_print">

<?php

$conn = db_connect();
$Hiseq_Sample_ID=$_GET['ID'];
$result_sample=search("select * from hiseq_sample where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");

if(count($result_sample)<1){
	echo "Could not find the record.<br>";
}
else{
		echo "<h6>SAMPLE INFORMATION</h6><br>";
		echo "<table id=\"tb1\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<input type=\"hidden\" name=\"Hiseq_Sample_ID\" value=\"".$Hiseq_Sample_ID."\"/>";
		echo "<tr align=\"center\">";
		echo "<td colspan=\"4\">";
		echo "<table border=\"1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" >";
		echo "<tr align=\"center\"/>";
		echo "<td width=\"10%\">";
		echo "Submitter_Name:";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Submitter_Name'];
		if($result_sample[0]['Submitter_Name']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "Lab:&nbsp;";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['lab'];
		if($result_sample[0]['lab']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "Date:";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['date'];
		if($result_sample[0]['date']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "Run:";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Run'];
		if($result_sample[0]['Run']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "Lane:";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Lanes'];
		if($result_sample[0]['Lanes']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "Lane Count:";
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['lane_count'];
		if($result_sample[0]['lane_count']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		
		echo "</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\" >";
		echo "Sample Name:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\" >";
		echo $result_sample[0]['Sample_Name'];
		if($result_sample[0]['Sample_Name']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\" width=\"200\">";
		echo "Request Reads Count(M):";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['reads_count'];
		if($result_sample[0]['reads_count']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\">";
		echo "No. of multiplexed libraries&nbsp;";
		echo "</td>";
		echo "<td align=\"left\" >";
		echo $result_sample[0]['libraries'];
		if($result_sample[0]['libraries']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\" >";
		echo "Read Length(bp):&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['Read_Length'];
		if($result_sample[0]['Read_Length']==""){
			echo "-";	
		}
		echo "</td>";
		
		echo "</tr>";
	
		
		echo "<tr align=\"center\">";
		echo "<td  align=\"right\">";
		echo "Index Number:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['Index_Number'];
		if($result_sample[0]['Index_Number']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Index Position:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['Index_Position'];
		if($result_sample[0]['Index_Position']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\" >";
		echo "Category:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['Category'];
		if($result_sample[0]['Category']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Single/Paired end:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['end'];
		if($result_sample[0]['end']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Average Size of the Library Pool:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		echo $result_sample[0]['Avg_Pool'];
		if($result_sample[0]['Avg_Pool']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Hiseq/Miseq:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\" >";
	
		echo $result_sample[0]['Mode'];
		if($result_sample[0]['Mode']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td align=\"right\" >";
		echo "Concentration of the Library Pool:&nbsp;";
		echo "</td>";
		echo "<td  align=\"left\">";
		
		echo $result_sample[0]['Conc'];
		if($result_sample[0]['Conc']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"right\">";
		echo "Volume of Library the Pool:&nbsp;";
		echo "</td>";
		echo "<td align=\"left\">";
		
		echo $result_sample[0]['Volume'];
		if($result_sample[0]['Volume']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr align=\"center\">";
		echo "<td align=\"right\" >";
		echo "Remarks:&nbsp;";
		echo "</td>";
		echo "<td colspan=\"2\" align=\"left\">";
		echo html_entity_decode($result_sample[0]['Remark']);
		if($result_sample[0]['Remark']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td align=\"left\">";
		echo "<span style=\"font-size:12px;color:gray\">If you need the Core to analyze your data, please list the brief purpose of the library (What is the case/control? What do you want the Core to do?)</span>";
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
		echo "</tr>";*/
		
		/*echo "<tr align=\"center\">";
		echo "<td>";
		echo $result_sample[0]['Concentration'];
		if($result_sample[0]['Concentration']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Volume'];
		if($result_sample[0]['Volume']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Buffer'];
		if($result_sample[0]['Buffer']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_sample[0]['Average_GC'];
		if($result_sample[0]['Average_GC']==""){
			echo "-";	
		}
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
		
		// echo "$newphrase<br>";
		// echo "$phrase<br>";
		
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
			echo "I7 Index No.";
			echo "</td>";
			echo "<td>";
			echo "I7 Index Seq";
			echo "</td>";
			echo "<td>";
			echo "I5 Index No.";
			echo "</td>";
			echo "<td>";
			echo "I5 Index Seq";
			echo "</td>";
			echo "<td>";
			echo "Barcode No.";
			echo "</td>";
			echo "<td>";
			echo "Barcode Seq";
			echo "</td>";
			echo "<td>";
			echo "Buffer for the ibrary Pool";
			echo "</td>";
			echo "<td>";
			echo "Concentration of the Library Pool(nM)";
			echo "</td>";
			echo "<td>";
			echo "Volume of the Library Pool submitted(&micro;L)";
			echo "</td>";
			
			echo "</tr>";
			
			for($i=0;$i<count($result_Library);$i++){
				echo "<tr align=\"center\">";
				
				echo "<td>";
				echo $result_Library[$i]['Hiseq_Library_ID'];
				if($result_Library[$i]['Hiseq_Library_ID']==""){
					echo "-";	
				}
				echo "</td>";
				echo "<td>";
				echo $result_sample[0]['Sample_Name'];
				if($result_sample[0]['Sample_Name']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['Library_Name'];
				if($result_Library[$i]['Library_Name']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['Project_Type'];
				if($result_Library[$i]['Project_Type']==""){
					echo "-";	
				}
				echo "</td>";
				
				
				echo "<td>";
				echo $result_Library[$i]['Kit'];
				if($result_Library[$i]['Kit']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['I7_No'];
				if($result_Library[$i]['I7_No']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['I7_Seq'];
				if($result_Library[$i]['I7_Seq']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['I5_No'];
				if($result_Library[$i]['I5_No']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['I5_Seq'];
				if($result_Library[$i]['I5_Seq']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['Barcode_No'];
				if($result_Library[$i]['Barcode_No']==""){
					echo "-";	
				}

				echo "</td>";
				echo "<td>";
				echo $result_Library[$i]['Barcode_Seq'];
				if($result_Library[$i]['Barcode_Seq']==""){
					echo "-";	
				}

				echo "</td>";
				
				echo "<td>";
				echo $result_Library[$i]['Buffer'];
				if($result_Library[$i]['Buffer']==""){
					echo "-";	
				}

				echo "</td>";
				
				echo "<td>";
				echo $result_Library[$i]['Conc'];
				if($result_Library[$i]['Conc']==""){
					echo "-";	
				}
				echo "</td>";
				
				echo "<td>";
				echo $result_Library[$i]['Volume'];
				if($result_Library[$i]['Volume']==""){
					echo "-";	
				}
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</table>";
			echo "<br>";
			
			
		}
		echo "</div>";
		echo "<input type=\"button\" class=\"button\" onClick=\"printdiv('div_print');\" value=\" Print \"/>";
		if($result_user[0]['main']=="y"){	
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"hiseq_edit.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" value=\" Edit \" /></a>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"hiseq_back2unseq.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" value=\"Back To un-sequenced\" /></a>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"hiseq_copy2newsample.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" value=\"Copy To New Sample\" /></a>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"hiseq_reseq_sample.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" value=\"Re-Seq Sample\" /></a>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=\"hiseq_archive_record.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" value=\"Set to sequencing later\" /></a>";
			if($result_sample[0]['Run']=="Seq_later"){
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href=\"hiseq_un_archive_record.php?ID=".$Hiseq_Sample_ID."\"><input type=\"button\" name=\"button3\" id=\"button3\" class=\"button\" value=\"Back to waiting list\" /></a>";	
			}		
			echo "<br>";
		}
		
}
?>

</body>
</html>











