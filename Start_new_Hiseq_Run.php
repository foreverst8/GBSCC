<html>
<head>
<style>
body {
	margin-left:5%;
	margin-right:5%;
	background-color: #e6ecff;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
span {
	background-color: #e6ecff;
}
</style>
</head>
<body>
<br>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
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

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>START NEW HISEQ RUN</h6>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<?php
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		$permission=$result_user[0]['main'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
  	?>   
 
<?php

  date_default_timezone_set("PRC");
  $nowtime = time();
  $rq = date("Y-m-d",$nowtime);

$date=$_GET['date'];
$color=array("#FFFFFF","#FFFAFA","#FFF68F","#FFEFD5","#FFE4E1","#FFDEAD","#FFC1C1","#FFB90F","#FFA54F","#FF8C00","#FF7F50","#FF6EB4","#FF4500","#FF3030","#FDF5E6","#FAF0E6","#F7F7F7","#F5DEB3","#F0FFFF","#F0E68C","#EEEE00","#EEE8AA","#EEDFCC","#EED5B7","#EEC900","#EEAEEE","#EE9A49","#EE8262","#EE7621","#EE6363","#EE3A8C","#EE00EE","#EAEAEA","#E5E5E5","#E0EEE0","#DEB887","#DBDBDB","#D9D9D9","#D3D3D3","#D1D1D1","#CDCDC1","#CDC9A5","#CDC1C5","#CDB7B5","#CDAF95","#CD9B1D","#CD8C95","#CD7054","#CD661D","#CD5B45","#CD3333","#CD1076","#CAFF70","#C71585","#C4C4C4","#C1CDC1","#BFBFBF","#BDB76B","#BBFFFF","#B8B8B8","#B4EEB4","#B3B3B3","#B0E2FF","#B03060","#ADADAD","#A9A9A9","#A4D3EE","#A1A1A1","#9F79EE","#9B30FF","#9A32CD","#98F5FF","#949494","#912CEE","#8EE5EE","#8DEEEE","#8B8B7A","#8B8878","#8B8378","#8B7D6B","#8B7500","#8B668B","#8B5A2B","#8B4789","#8B4500","#8B3626","#8B1C62","#8B0000","#87CEFF","#858585","#838B83","#7FFF00","#7D7D7D","#7B68EE","#7A67EE","#778899","#737373","#707070","#6CA6CD","#6A5ACD","#6959CD","#66CD00","#63B8FF","#5F9EA0","#5C5C5C","#556B2F","#548B54","#525252","#4EEE94","#4A4A4A","#474747","#458B00","#424242","#3D3D3D","#388E8E","#333333","#2E8B57","#282828","#228B22","#1F1F1F","#1C1C1C","#171717","#0F0F0F","#050505","#00FF00","#00EE76","#00CDCD","#00BFFF","#008B45","#006400","#0000AA");

if(!$_GET['date']){
	echo "<form action=\"Start_new_Hiseq_Run.php\" method=\"get\">";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"350\" bgcolor=\"white\">";
	echo "<tr align=\"center\">";
	echo "<td rowspan=\"2\" align=\"center\" width=\"200\">";
	echo "Sequencing Date:";
	echo "</td>";
	echo "<td rowspan=\"2\" align=\"middle\" width=\"150\">";
	echo "<input type=\"text\" name=\"date\" id=\"date\" class=\"tcal\" onchange=\"gradeChange1()\"/>";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td>";
	echo "<br><br><br>";
	echo "</td></tr>";
	echo "<tr>";
	echo "<td align=\"center\">";
	echo "<input type=\"reset\" class=\"button\" value=\"Reset\"/></td>";
	echo "<td align=\"center\">";	
	echo "<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
}
else{
	$run="";
	$run_tmp=explode('/',$date);
	$run="HSR".$run_tmp[2].$run_tmp[1].$run_tmp[0];
	
	echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"600\">";
	echo "<tr align=\"center\">";
	echo "<td width=\"150\">";
	echo "Sequencing Date:";
	echo "</td>";
	echo "<td width=\"150\">";
	echo "$date";
	echo "</td>";
	echo "<td width=\"150\">";
	echo "Run:";
	echo "</td>";
	echo "<td width=\"150\">";
	echo "$run";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "<br><br>";

	#echo "</form>";
	
	$result_sample=search("select * from hiseq_sample where Run='-'");
	if(count($result_sample)==0){
		echo "There is no sample to be Sequenced. Have a good rest. ^_^<br>";
		exit;
	}
	#echo "$run--<br>";
	
	echo "<form action=\"Start_new_Hiseq_Run_mysql.php\" method=\"get\">";
	echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\" width=\"600\">";
	echo "<tr>";
	echo "<th>";
	echo  "Set Lane";
	echo "</th>";
	
	echo "<th>";
	echo  "Sample Name";
	echo "</th>";
	echo "<th>";
	echo  "Index Repeat with";
	echo "</th>";
	echo "<th>";
	echo  "Submitter Name";
	echo "</th>";
	echo "<th>";
	echo  "Lab";
	echo "</th>";
	echo "<th>";
	echo  "Libraries";
	echo "</th>";
	echo "<th>";
	echo  "Request Reads Count";
	echo "</th>";
	echo "<th>";
	echo  "Read Length";
	echo "</th>";
	echo "<th>";
	echo  "Single/paired end";
	echo "</th>";
	echo "<th>";
	echo  "Index Number";
	echo "</th>";
	echo "<th>";
	echo  "Index Position";
	echo "</th>";
	echo "<th>";
	echo  "Category";
	echo "</th>";
	echo "<th>";
	echo  "Remark";
	echo "</th>";
	echo "<th>";
	echo  "Date";
	echo "</th>";
	echo "</tr>";
	echo "<input type=\"hidden\" name=\"run\" value=\"".$run."\">";	
	
	$ord=array();
	$index=array();
	$index_color=array();
	$index_color_id=array();
	for($i=0;$i<count($result_sample);$i++){
		$result_tmp=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_sample[$i]['Hiseq_Sample_ID']."'");
		for($j=0;$j<count($result_tmp);$j++){
			$index[$i][$j]=$result_tmp[$j]['I7_No']."-".$result_tmp[$j]['I7_Seq']."-".$result_tmp[$j]['I5_No']."-".$result_tmp[$j]['I5_Seq']."-".$result_tmp[$j]['Barcode_No']."-".$result_tmp[$j]['Barcode_Seq'];
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
	foreach($index_color as $k=>$v){
		if($v>1){
			$index_color_id[$k]=$color_k;
			$color_k++;	
		}
		else{
			$index_color_id[$k]=0;
		}	
	}
	
	
	
	
	for($i=0;$i<count($result_sample);$i++){
		echo "<input type=\"hidden\" name=\"Hiseq_Sample_ID"."_".$i."\" value=\"".$result_sample[$i]['Hiseq_Sample_ID']."\">";	
		
		echo "<tr align=\"center\">";
		echo "<td rowspan=\"2\" valign=\"top\">";
		echo  "<select name=\"set_lane"."_".$i."\" id=\"set_lane"."_".$i."\">";
		echo "<option value=\"\" selected=\"selected\">Not Sequencing</option>";
		echo "<option value=\"1\">1</option>";
		echo "<option value=\"2\">2</option>";
		echo "<option value=\"3\">3</option>";
		echo "<option value=\"4\">4</option>";
		echo "<option value=\"5\">5</option>";
		echo "<option value=\"6\">6</option>";
		echo "<option value=\"7\">7</option>";
		echo "<option value=\"8\">8</option>";
		echo "</select>";
		echo "</td>";
		
		echo "<td  rowspan=\"2\" valign=\"top\">";
		echo  $result_sample[$i]['Sample_Name'];
		if($result_sample[$i]['Sample_Name']==""){
			echo "-";	
		}
		echo "</td>";
		
		echo "<td rowspan=\"2\" valign=\"top\">";
		$kk=0;
		for($ii=0;$ii<count($ord[$i]);$ii++){
			echo $result_sample[$ord[$i][$ii]]['Sample_Name'].", ";
			$kk=1;
		}
		if($kk==0){
			echo "&nbsp;";
		}
		
		echo "</td>";
		
		
		echo "<td>";
		echo  $result_sample[$i]['Submitter_Name'];
		if($result_sample[$i]['Submitter_Name']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['lab'];
		if($result_sample[$i]['lab']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['libraries'];
		if($result_sample[$i]['libraries']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['reads_count'];
		if($result_sample[$i]['reads_count']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['Read_Length'];
		if($result_sample[$i]['Read_Length']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['end'];
		if($result_sample[$i]['end']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['Index_Number'];
		if($result_sample[$i]['Index_Number']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['Index_Position'];
		if($result_sample[$i]['Index_Position']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['Category'];
		if($result_sample[$i]['Category']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['Remark'];
		if($result_sample[$i]['Remark']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo  $result_sample[$i]['date'];
		if($result_sample[$i]['date']==""){
			echo "-";	
		}
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr>";
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
		
		echo "<td colspan=\"12\">";
		$result_tmp=search("select * from hiseq_library where Hiseq_Sample_ID='".$result_sample[$i]['Hiseq_Sample_ID']."'");
		
		echo "<div style=\"margin:10px 10px 20px 10px\"><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
		echo "<tr>";
		echo "<td>";
		echo "Sample Name";
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
		echo "</tr>";
		
		for($j=0;$j<count($result_tmp);$j++){
			
			$str_tmp=$result_tmp[$j]['I7_No']."-".$result_tmp[$j]['I7_Seq']."-".$result_tmp[$j]['I5_No']."-".$result_tmp[$j]['I5_Seq']."-".$result_tmp[$j]['Barcode_No']."-".$result_tmp[$j]['Barcode_Seq'];
			if($index_color_id[$str_tmp]>0){
				echo "<tr bgcolor=\"".$color[$index_color_id[$str_tmp]*2]."\">";
			}
			else{
				echo "<tr>";
			}
			
			echo "<td>";
			echo $result_tmp[$j]['Library_Name'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['I7_No'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['I7_Seq'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['I5_No'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['I5_Seq'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['Barcode_No'];
			echo "</td>";
			echo "<td>";
			echo $result_tmp[$j]['Barcode_No'];
			echo "</td>";
			echo "</tr>";	
		}
		echo "</table></div>";

		echo "</td>";
		echo "</tr>";	
	}
	echo "</table><br>";
	echo "<input type=\"reset\" class=\"button\" value=\"Reset\"/><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><input type=\"submit\" class=\"button\" value=\"Submit\"/>";
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










