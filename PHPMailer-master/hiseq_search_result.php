<?php 
session_start(); 
require('header.php');?>
<script type="text/javascript" src="http://libs.useso.com/js/jquery/1.9.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

<script type="text/javascript"> 
       function gradeChange1(){ 
        var objS = document.getElementById("date"); 
        var val = document.getElementById("date").value; 
		document.getElementById('run').innerHTML=val;
       } 
	  
</script>



   
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<table width="100%" border="0"  cellspacing="0" bgcolor="#FFFFCC">
  <tr>
    <td width="200" rowspan="3" valign="top" bgcolor="#669999">
    <?php  require('side.php') ?>
    <?php require('db_cancer.php')?>
    
    </td>
    <td  valign="top"  width="4"> </td>
    <td  valign="top" ></td>
    
   
  </tr>
  <tr>
  	<td  valign="top"  width="4"> </td>
    <td align="left" valign="top">
   <?php require('login.php');?> 
    
    <table border="0" cellspacing="0">
      <tr><td width="650">
    <p><br>
    >>Hiseq Sequencing<br></p>
     <?PHP
	  	
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'Problem: You have no permission to access the page.<br />';			
			require('tail.php');
			require('footer.php');
			exit;
		}
		


   	?>  
      
       <span style="font-size:13px"><b>Submission Details</b><br>	
      All samples should meet the following criteria:<br>					
        &nbsp;&nbsp;&nbsp;&nbsp;1. Submit at least 15&micro;l of 20nM samples (preferably in lo-bind eppendorf tubes).<br>		
        &nbsp;&nbsp;&nbsp;&nbsp;2. Deliver samples to Kaeling Tan/ Tong along and Apply from this webpage. Incomplete application will delay sample processing.<br>	
        &nbsp;&nbsp;&nbsp;&nbsp;3. Please submit one application for each pool library sample.<br>	
        &nbsp;&nbsp;&nbsp;&nbsp;4. Provide any <span style="color:red">Bioanalyzer</span> profiles for your sample.<br>					
        &nbsp;&nbsp;&nbsp;&nbsp;5.  For sample preparation, please refer to the <a href="Sample_Preparation.php">"Sample Preparation"</a>.<br>	
        &nbsp;&nbsp;&nbsp;&nbsp;6.  For submittion of samples, please <span style="color:red">do not use special characters</span><br>in your application or,like space(" "),"/", "#" or "*"; Database only allow "a-z,A-Z,0-9,-,_"<br></span>							
      </td>
      <td valign="top">
      <?php require("search_hiseq.php");?>
      </td>
      <td>&nbsp;
      
      </td>
      </tr>
      </table>
      <p>&nbsp;</p>
      <span style="font-size:15px"><b>Search Result</b></span><br><br>
<?php

$conn = db_connect();
$date=$_GET['date'];

if($_GET['Hiseq_Sample_ID_0']!=""){
	
	if($date==""){
		echo 'Please select date.<br />';			
		require('tail.php');
		require('footer.php');
		exit;	
	}
	
	$added_count=0;
	$run_tmp=explode('/',$date);
	$run="HSR".$run_tmp[2].$run_tmp[1].$run_tmp[0];
	
	for($i=0;$i<10000;$i++){
		$str="Hiseq_Sample_ID_".$i;
		$id="Hiseq_Sample_ID_".$i;
		if($_GET[$str]==""){
			break;
		}
		
		
		$Hiseq_Sample_ID=$_GET[$str];
		$str="lane_".$i;
		$lanes=$_GET[$str];
		
		if($lanes=="0"){
			continue;
		}
		
		$value="Run='$run',Lanes='$lanes'";
		$res=$conn->query("UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
		#echo "UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'<br>";
		if (!$res){
			$err_count++;
			echo "<br>Sample: ".$_GET[$id]." Start New Run faild.<br>";
		}
		else{
			$added_count++;	
			echo "<br>Sample: ".$_GET[$id]." Start New Run successfully<br>";
		}
		
	}
	
	echo "<br>";
}


$query="";

if($result_user[0]['main']=="y"){
	$query="select distinct(Run) from hiseq_sample";
}
else{
	$query=" select distinct(Run) from hiseq_sample where Submitter_Name='".$_SESSION['username']."'";
}

$result_search=search($query);

echo "<form action=\"hiseq_search_result.php\" method=\"get\">";
echo "Select Run: <select name=\"run\">";
echo "<option value=\"unseq\">Un-seq</option>";
for($i=0;$i<count($result_search);$i++){
	if($result_search[$i]['Run']=="-"){
		continue;	
	}
	else{
		echo "<option value=\"".$result_search[$i]['Run']."\">".$result_search[$i]['Run']."</option>";
	}
	
}
echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"submit\" value=\"Select\" >";
echo "</form>";
echo "<br><br>";

$run=$_GET['run'];
$keywords=$_GET['Keywords'];

$query="";

if($run=="" and $keywords==""){
	$query="select * from hiseq_sample where Run='-' ";
	if($result_user[0]['main']!="y"){
		$query.=" and Submitter_Name='".$_SESSION['username']."'";
	}
	
}
else{
	if($run!=""){
		$query="select * from hiseq_sample where Run='".$run."'";
		if($result_user[0]['main']!="y"){
			$query.=" and Submitter_Name='".$_SESSION['username']."'";
		}
	}
	else{
		$query="select * from hiseq_sample where (Run like '%".$keywords."%' or Hiseq_Sample_ID like '%".$keywords."%' or Sample_Name like '%".$keywords."%' or Category like '%".$keywords."%' or Remark like '%".$keywords."%' or date like '%".$keywords."%')";
		if($result_user[0]['main']!="y"){
			$query.=" and Submitter_Name='".$_SESSION['username']."'";
		}
	}

}

$color=array("#FFFAFA","#FFF68F","#FFEFD5","#FFE4E1","#FFDEAD","#FFC1C1","#FFB90F","#FFA54F","#FF8C00","#FF7F50","#FF6EB4","#FF4500","#FF3030","#FDF5E6","#FAF0E6","#F7F7F7","#F5DEB3","#F0FFFF","#F0E68C","#EEEE00","#EEE8AA","#EEDFCC","#EED5B7","#EEC900","#EEAEEE","#EE9A49","#EE8262","#EE7621","#EE6363","#EE3A8C","#EE00EE","#EAEAEA","#E5E5E5","#E0EEE0","#DEB887","#DBDBDB","#D9D9D9","#D3D3D3","#D1D1D1","#CDCDC1","#CDC9A5","#CDC1C5","#CDB7B5","#CDAF95","#CD9B1D","#CD8C95","#CD7054","#CD661D","#CD5B45","#CD3333","#CD1076","#CAFF70","#C71585","#C4C4C4","#C1CDC1","#BFBFBF","#BDB76B","#BBFFFF","#B8B8B8","#B4EEB4","#B3B3B3","#B0E2FF","#B03060","#ADADAD","#A9A9A9","#A4D3EE","#A1A1A1","#9F79EE","#9B30FF","#9A32CD","#98F5FF","#949494","#912CEE","#8EE5EE","#8DEEEE","#8B8B7A","#8B8878","#8B8378","#8B7D6B","#8B7500","#8B668B","#8B5A2B","#8B4789","#8B4500","#8B3626","#8B1C62","#8B0000","#87CEFF","#858585","#838B83","#7FFF00","#7D7D7D","#7B68EE","#7A67EE","#778899","#737373","#707070","#6CA6CD","#6A5ACD","#6959CD","#66CD00","#63B8FF","#5F9EA0","#5C5C5C","#556B2F","#548B54","#525252","#4EEE94","#4A4A4A","#474747","#458B00","#424242","#3D3D3D","#388E8E","#333333","#2E8B57","#282828","#228B22","#1F1F1F","#1C1C1C","#171717","#0F0F0F","#050505","#00FF00","#00EE76","#00CDCD","#00BFFF","#008B45","#006400","#0000AA");


echo "<form action=\"hiseq_search_result.php\" method=\"get\">";
if($result_user[0]['main']=="y"){
	if($run=="-" or $run==""){
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"300\">";
		echo "<tr align=\"center\">";
		echo "<td width=\"150\">";
		echo "Sequencing Date:";
		echo "</td>";
		echo "<td width=\"150\">";
		echo "<input type=\"text\" name=\"date\" id=\"date\" class=\"tcal\" onchange=\"gradeChange1()\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
	}
}


$result_search=search($query);
if(count($result_search)==0){
	echo "There is no recode of your search.<br>";
}
else{
	
	$ord=array();
	$index=array();
	
	$index_color=array();
	$index_color_id=array();
	$index_ord=array();
	for($i=0;$i<count($result_search);$i++){
		$result_tmp=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_search[$i]['Hiseq_Sample_ID']."'");
		for($j=0;$j<count($result_tmp);$j++){
			$index[$i][$j]=$result_tmp[$j]['I7_Seq']."-".$result_tmp[$j]['I5_Seq']."-".$result_tmp[$j]['Barcode_Seq'];
			#echo $index[$i][$j]."<br>";
			$index_color[$index[$i][$j]]++;
		}
		#echo "<br>";
	}
	
	for($i=0;$i<count($index);$i++){
		$arr_tmp=array();
		for($ii=0;$ii<count($index);$ii++){
			if($i==$ii){
				continue;	
			}
			
			$repeat_index=array_intersect($index[$i], $index[$ii]);
			#print_r($repeat_index);echo "--$i--$ii--<br>";
			#echo count($repeat_index)."<br>";
			if(count($repeat_index)>0){
				array_push($arr_tmp,$ii);
				#echo "$i--$ii<br>";
			}
		}
		$ord[$i]=$arr_tmp;
	}
	
	
	$color_k=1;
	$index_ord_tmp=0;
	foreach($index_color as $k=>$v){
		if($v>1){
			$index_color_id[$k]=$color_k;
			$color_k=$color_k+2;	
		}
		else{
			$index_color_id[$k]=0;
		}
		$index_ord_tmp++;
		$index_ord[$k]=$index_ord_tmp;
	}
	
	if($run==""){
		$run="-";
		
	}
	
	
	
	
	echo "<input type=\"hidden\" name=\"run\" value=\"".$run."\">";
	echo "<input type=\"hidden\" name=\"keywords\" value=\"".$keywords."\">";
	
	
	
	echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
	echo "<tr align=\"center\">";
	
	echo "<th>";
	echo "Hiseq Sample ID";
	echo "</th>";
	echo "<th>";
	echo "Sample Name";
	echo "</th>";
	if($run!="-"){
		echo "<th>";
		echo "Run";
		echo "</th>";
		echo "<th>";
		echo "Lane";
		echo "</th>";
	}
	if($run=="-" and $result_user[0]['main']=="y"){
		echo "<th>";
		echo "Lane";
		echo "</th>";
		echo "<th>";
		echo "Samples With Repeat Index";
		echo "</th>";
		echo "<th>";
		echo "Index Code";
		echo "</th>";
	}
	echo "<th>";
	echo "Submitter Name";
	echo "</th>";
	echo "<th>";
	echo "Lab";
	echo "</th>";
	echo "<th>";
	echo "No. of Mixed Libraries";
	echo "</th>";
	echo "<th>";
	echo "Request Reads Count";
	echo "</th>";
	echo "<th>";
	echo "Read Length";
	echo "</th>";
	echo "<th>";
	echo "Index Number";
	echo "</th>";
	echo "<th>";
	echo "Index Position";
	echo "</th>";
	echo "<th>";
	echo "Single/paired End";
	echo "</th>";
	echo "<th>";
	echo "Category";
	echo "</th>";
	echo "<th>";
	echo "Average Size of Library Pool";
	echo "</th>";
	echo "<th>";
	echo "Remark";
	echo "</th>";
	echo "<th>";
	echo "date";
	echo "</th>";
	#echo "<th>";
	#echo "Concentration of Library Pool (nM)";
	#echo "</th>";
	#echo "<th>";
	#echo "Volume of Library Pool submitted (&micro;L)";
	#echo "</th>";
	#echo "<th>";
	#echo "Buffer for Library Pool";
	#echo "</th>";
	#echo "<th>";
	#echo "Average GC content";
	#echo "</th>";
	
	
	echo "</tr>";
	
	for($i=0;$i<count($result_search);$i++){
		echo "<tr  align=\"center\" valign=\"top\">";
		echo "<td>";
		echo "<a href=\"hiseq_search_result_detial.php?ID=".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo "<input type=\"hidden\" name=\"Hiseq_Sample_ID"."_".$i."\" value=\"".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo $result_search[$i]['Hiseq_Sample_ID'];
		if($result_search[$i]['Hiseq_Sample_ID']==""){
			echo "-";	
		}
		echo "</a>";
		echo "</td>";
		echo "<td>";
		echo "<a href=\"hiseq_search_result_detial.php?ID=".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo $result_search[$i]['Sample_Name'];
		if($result_search[$i]['Sample_Name']==""){
			echo "-";	
		}
		echo "</a>";
		echo "</td>";
		
		if($run!="-"){
			echo "<td>";
			echo $result_search[$i]['Run'];
			if($result_search[$i]['Run']==""){
				echo "-";	
			}
			echo "</td>";
			echo "<td>";
			echo $result_search[$i]['Lanes'];
			if($result_search[$i]['Lanes']==""){
				echo "-";	
			}
			echo "</td>";
		}
		
		if($run=="-" and $result_user[0]['main']=="y"){
			//$index_ord
			
			echo "<td valign=\"top\">";
			if($result_search[$i]['Lanes']==""){
				/*echo "<select name=\"lane_".$i."\">";
				echo "<option value=\"0\" selected=\"selected\">unset</option>";
				echo "<option value=\"1\">&nbsp;&nbsp;1&nbsp;&nbsp;</option>";
				echo "<option value=\"2\">&nbsp;&nbsp;2&nbsp;&nbsp;</option>";
				echo "<option value=\"3\">&nbsp;&nbsp;3&nbsp;&nbsp;</option>";
				echo "<option value=\"4\">&nbsp;&nbsp;4&nbsp;&nbsp;</option>";
				echo "<option value=\"5\">&nbsp;&nbsp;5&nbsp;&nbsp;</option>";
				echo "<option value=\"6\">&nbsp;&nbsp;6&nbsp;&nbsp;</option>";
				echo "<option value=\"7\">&nbsp;&nbsp;7&nbsp;&nbsp;</option>";
				echo "<option value=\"8\">&nbsp;&nbsp;8&nbsp;&nbsp;</option>";
				echo "</select>";*/
				echo "<input name=\"lane_".$i."\" size=\"10\">";
			}
			else{
				echo $result_search[$i]['Lanes'];
			}
			echo "</td>";
			
			echo "<td>";
			$kk=0;
			for($ii=0;$ii<count($ord[$i]);$ii++){
				echo $result_search[$ord[$i][$ii]]['Hiseq_Sample_ID']."&nbsp; ";
				$kk=1;
			}
			if($kk==0){
				echo "&nbsp;";
			}
			echo "</td>";
			echo "<td>";
			$result_tmp=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_search[$i]['Hiseq_Sample_ID']."'");
			for($j=0;$j<count($result_tmp);$j++){
				$ss=$result_tmp[$j]['I7_Seq']."-".$result_tmp[$j]['I5_Seq']."-".$result_tmp[$j]['Barcode_Seq'];
				echo "<span ";
				if($index_color_id[$ss]>0){
					echo "style=\"background:".$color[$index_color_id[$ss]]."\"";
					
				}
				echo " >$index_ord[$ss]</span>&nbsp; ";
			}
			echo "</td>";
			
		}
		
		
		echo "<td>";
		echo $result_search[$i]['Submitter_Name'];
		if($result_search[$i]['Submitter_Name']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['lab'];
		if($result_search[$i]['lab']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo "<a href=\"hiseq_search_result_detial.php?ID=".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo $result_search[$i]['libraries'];
		if($result_search[$i]['libraries']==""){
			echo "-";	
		}
		echo "</a>";
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['reads_count'];
		if($result_search[$i]['reads_count']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Read_Length'];
		if($result_search[$i]['Read_Length']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Index_Number'];
		if($result_search[$i]['Index_Number']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Index_Position'];
		if($result_search[$i]['Index_Position']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['end'];
		if($result_search[$i]['end']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Category'];
		if($result_search[$i]['Category']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Avg_Pool'];
		if($result_search[$i]['Avg_Pool']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Remark'];
		if($result_search[$i]['Remark']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['date'];
		if($result_search[$i]['date']==""){
			echo "-";	
		}
		echo "</td>";
		/*echo "<td>";
		if($result_user[0]['main']=="y"){
			echo "<input name=\"Concentration"."_".$i."\" value=\"".$result_search[$i]['Concentration']."\">";
		}
		else{
			echo $result_search[$i]['Concentration'];
			if($result_search[$i]['Concentration']==""){
				echo "-";	
			}
		}
		echo "</td>";
		echo "<td>";
		if($result_user[0]['main']=="y"){
			echo "<input name=\"Volume"."_".$i."\" value=\"".$result_search[$i]['Volume']."\">";
		}
		else{
			echo $result_search[$i]['Volume'];
			if($result_search[$i]['Volume']==""){
				echo "-";	
			}
		}
		echo "</td>";
		echo "<td>";
		if($result_user[0]['main']=="y"){
			echo "<input name=\"Buffer"."_".$i."\" value=\"".$result_search[$i]['Buffer']."\">";
		}
		else{
			echo $result_search[$i]['Buffer'];
			if($result_search[$i]['Buffer']==""){
				echo "-";	
			}
		}
		echo "</td>";
		echo "<td>";
		if($result_user[0]['main']=="y"){
			echo "<input name=\"Average_GC"."_".$i."\" value=\"".$result_search[$i]['Average_GC']."\">";
		}
		else{
			echo $result_search[$i]['Average_GC'];
			if($result_search[$i]['Average_GC']==""){
				echo "-";	
			}
		}
		echo "</td>";*/
		
		echo "</tr>";
	}
	echo "</table><br>";
	
	if($result_user[0]['main']=="y"){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" value=\"Reset\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Submit\"/>";
		
	}
	
	
	
	
}
echo "</form>";



?>


<p>&nbsp;</p>
<p>&nbsp;</p>





    
<?php require('tail.php')?>

<?php require('footer.php')?>













