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
    font-size: 12px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
li.end {
	margin-left: 50px;
}
.button {
	font-family: sans-serif;
    font-size: 12px;
	font-weight: 100;
	display: inline;
    background-color: #ffffff;
    border: 2px solid #002A60;
    border-radius: 16px;
    color: #002A60;
    padding: 5px 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
</style>
</head>
<body>
<br>

<?php 
session_start();
require('login.php');
/*require('db_cancer.php');*/
?>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<script src="clienthint.js"></script> 
<script type="text/javascript"> 
       function gradeChange1(){ 
        var objS = document.getElementById("date"); 
        var val = document.getElementById("date").value; 
		document.getElementById('run').innerHTML=val;
       } 
</script>

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
function trans(){
	var rows = document.getElementById("tb1").rows.length;
	var cells = document.getElementById("tb1").rows.item(0).cells.length;
	var str="";
	for(i=0;i<rows;i++){
		var str2="";
		for(j=0;j<cells-1;j++){
			//str2=str2+"<td>"+document.getElementById("tb1").rows[i].cells[j].innerText+"</td>";
			//alert(document.getElementById("tb1").rows.item(i).cells.item(j).value)
			//alert(document.getElementById("tb1").rows[i].cells[j].innerText)
			str=str+document.getElementById("tb1").rows[i].cells[j].innerText+"\t";
		}
		//str=str+"<tr>"+str2+"</tr>";
		str=str+document.getElementById("tb1").rows[i].cells[cells-1].innerText+"\n";
		
	}
	//document.getElementById('div_print').innerHTML="<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">"+str+"</table>";
	document.getElementById('div_print').innerHTML="<pre>"+str+"</pre>";
	printdiv('div_print');
	
}
</script> 

<hr>
<br>
<h6>FHS ILLUMINA SEQUENCING SERVICE<h6>
<br>
   
<table>
  <tr>
    <td align="left" valign="top">
	<?php
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br>';	
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
<h6>SEARCH RESULTS<h6>
<br>
	
<?php

$conn = db_connect();
$date=$_GET['date'];
$email_user=$_GET['email_user'];

if($_GET['Hiseq_Sample_ID_0']!=""){
	
	
	if($date==""){
		echo 'Please select date.<br />';			
		exit;	
	}
	
	$added_count=0;
	$run_tmp=explode('/',$date);
	$run="HSR".$run_tmp[2].$run_tmp[0].$run_tmp[1];
	$run_miseq="MSR".$run_tmp[2].$run_tmp[0].$run_tmp[1];
	$run_id="";
	
	$inform_email="";
	
	for($i=0;$i<10000;$i++){
		$str="Hiseq_Sample_ID_".$i;
		$id="Hiseq_Sample_ID_".$i;
		if($_GET[$str]==""){
			break;
		}
		
		$Hiseq_Sample_ID=$_GET[$str];
		$str="lane_".$i;
		$lanes=$_GET[$str];
		$str="Mode_".$i;
		#echo "$str--".$_GET['Mode_0']."<br>";
		$Mode=$_GET[$str];
		$str="Read_Length_".$i;
		$Read_Length=$_GET[$str];
		$str="lane_count_".$i;
		$lane_count=$_GET[$str];
		if($lanes==="0" or $lanes=="" or $lane==="-"){
			continue;
		}
		
		#echo "lanes--$lanes<br>";
		#echo "mode--$Mode<br>";
		#echo "Read_Length--$Read_Length<br>";
		#echo "lane_count--$lane_count<br>";
		
		#$value="Run='$run',Lanes='$lanes',Mode='$Mode'";
		if($Mode=="Miseq"){
			$value="Run='$run_miseq',Lanes='$lanes',lane_count='$lane_count',Mode='$Mode',Read_Length='$Read_Length'";
			$run_id=$run_miseq;	
		}
		if($Mode=="Hiseq"){
			$value="Run='$run',Lanes='$lanes',lane_count='$lane_count',Mode='$Mode',Read_Length='$Read_Length'";
			$run_id=$run;	
		}
		
		$res=$conn->query("UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
		#echo "UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'<br>";
		if (!$res){
			$err_count++;
			echo "<br>Sample ".$_GET[$id]." : Start New Run failed.<br>";
		}
		else{
			
			$res_tmp=$conn->query("UPDATE genomics_core.hiseq_sample SET state='processing' where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'");
			$added_count++;	
			$result_email=search("select email,director_email from genomics_core.hiseq_sample,genomics_core.user,genomics_core.lab where genomics_core.hiseq_sample.Submitter_Name=genomics_core.user.user_name and Hiseq_Sample_ID='".$Hiseq_Sample_ID."' and genomics_core.user.lab=genomics_core.lab.lab_name");
			
			#echo "select email,director_email from genomics_core.hiseq_sample,genomics_core.user,genomics_core.lab where genomics_core.hiseq_sample.Submitter_Name=genomics_core.user.user_name and Hiseq_Sample_ID='".$Hiseq_Sample_ID."' and genomics_core.user.lab=genomics_core.lab.lab_name<br>";
			
			$inform_email.=$result_email[0]['email'].",".$result_email[0]['director_email'].",";
			echo "<br>Sample ".$_GET[$id]." : New run started successfully.<br>";
		}
		
	}

	echo "<br>";
}


/*$query="";


if($result_user[0]['main']=="y"){
	$query="select distinct(Run) from genomics_core.hiseq_sample ORDER BY Run DESC";
}
else{
	$query=" select distinct(Run) from genomics_core.hiseq_sample where Submitter_Name='".$_SESSION['username']."' ORDER BY Run DESC";
}

$result_search=search($query);
*/

$run=$_GET['run'];
$keywords=$_GET['Keywords'];


#<form> 
echo "<p>SELECT RUN: <br><br>Year:<select name=\"run\" onFocus=\"showHint(this.value)\" onChange=\"showHint(this.value)\"></p>";

$thisyear=date("Y");
echo "<option value=\"-\">Select Year</option>";
echo "<option value=\"$thisyear\">$thisyear</option>";
for($y=$thisyear-1;$y>=2016;$y=$y-1){
	echo "<option value=\"$y\">$y</option>";
}
echo "<option value=\"-\">Un-seq</option>";
echo "<option value=\"Seq_later\">Seq_later</option>";
echo "</select>";

echo "<span id=\"txtHint\"></span>";
echo "<br><br>";
#<input type="text" id="txt1"
#onkeyup="showHint(this.value)">
#</form>

/*echo "<form action=\"hiseq_search_result.php\" method=\"get\">";
echo "Select Run: <select name=\"run\">";
echo "<option value=\"-\">Un-seq</option>";
echo "<option value=\"Seq_later\">Seq_later</option>";
for($i=0;$i<count($result_search);$i++){
	if($result_search[$i]['Run']=="-" or $result_search[$i]['Run']=="Seq_later"){
		continue;	
	}
	else{
		echo "<option value=\"".$result_search[$i]['Run']."\" ";
		if($run==$result_search[$i]['Run']){
			echo "selected=\"selected\"";	
		}
		echo ">".$result_search[$i]['Run']."</option>";
	}
	
}
echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"submit\" value=\"Select\" >";
echo "</form>";
echo "<br><br>";*/

#echo "run=$run<br>";

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
		$query.=" ORDER BY Lanes";
	}
	else{
		
		if($result_user[0]['main']!="y"){
			$query="select * from hiseq_sample where (Run like '%".$keywords."%' or Hiseq_Sample_ID like '%".$keywords."%' or Sample_Name like '%".$keywords."%' or Category like '%".$keywords."%' or Remark like '%".$keywords."%' or date like '%".$keywords."%')";
			$query.=" and Submitter_Name='".$_SESSION['username']."'";
		}
		else{
			$query="select * from hiseq_sample where Run like '%".$keywords."%' or Hiseq_Sample_ID like '%".$keywords."%' or Sample_Name like '%".$keywords."%' or Category like '%".$keywords."%' or Remark like '%".$keywords."%' or date like '%".$keywords."%' or Submitter_Name like '%".$keywords."%' or lab like '%".$keywords."%'";	
		}
		
		#echo "$query<br>";
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
	echo "There is no record of your search.<br>";
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
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	#echo "<input type=\"button\" class=\"ipt\" onClick=\"trans();\" value=\" Print \"/><br><br>";
	
	#echo "<div id=\"div_print\">ssss</div>";
	$inform_email_finish="";
	echo "<table id=\"tb1\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
	echo "<tr align=\"center\">";
	
	echo "<th>";
	echo "Hiseq Sample ID";
	echo "</th>";
	
	if(!(($run=="-"  or $run=="") and $keywords=="")){
		echo "<th>";
		echo "Run";
		echo "</th>";
		echo "<th>";
		echo "Lane";
		echo "</th>";
		echo "<th>";
		echo "Lane Count";
		echo "</th>";
	}
	
	echo "<th>";
	echo "Submitter Name";
	echo "</th>";
	echo "<th>";
	echo "Lab";
	echo "</th>";
	echo "<th>";
	echo "Sample Name";
	echo "</th>";
	echo "<th>";
	echo "Request Reads Count(M)";
	echo "</th>";
	echo "<th>";
	echo "Read Length";
	echo "</th>";
	echo "<th>";
	echo "Conc";
	echo "</th>";
	echo "<th>";
	echo "Volume";
	echo "</th>";
	echo "<th>";
	echo "Hiseq / Miseq";
	echo "</th>";
	echo "<th>";
	echo "Single / paired End";
	echo "</th>";
	echo "<th>";
	echo "Index Number";
	echo "</th>";
	echo "<th>";
	echo "Index Position";
	echo "</th>";
	echo "<th>";
	echo "Category";
	echo "</th>";
	
	echo "<th>";
	echo "No. of Mixed Libraries";
	echo "</th>";
	
	echo "<th>";
	echo "Average Size of Library Pool";
	echo "</th>";
	echo "<th>";
	echo "Remark";
	echo "</th>";
	echo "<th>";
	echo "Date";
	echo "</th>";
	if($run=="-" and $result_user[0]['main']=="y"){
		echo "<th>";
		echo "Lane";
		echo "</th>";
		echo "<th>";
		echo "Lane Count";
		echo "</th>";
		echo "<th>";
		echo "Samples With Repeat Index";
		echo "</th>";
		echo "<th>";
		echo "Index Code";
		echo "</th>";
	}
	echo "<th>State</th>";
	echo "</tr>";
	
	for($i=0;$i<count($result_search);$i++){
		
		$result_email_finish=search("select email,director_email from genomics_core.hiseq_sample,genomics_core.user,genomics_core.lab where genomics_core.hiseq_sample.Submitter_Name=genomics_core.user.user_name and Hiseq_Sample_ID='".$result_search[$i]['Hiseq_Sample_ID']."' and genomics_core.user.lab=genomics_core.lab.lab_name");
			$inform_email_finish.=$result_email_finish[0]['email'].",".$result_email_finish[0]['director_email'].",";
		
		echo "<tr  align=\"center\" valign=\"top\">";
		echo "<td>";
		echo "<a class=\"button\" href=\"hiseq_search_result_detial.php?ID=".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo "<input type=\"hidden\" name=\"Hiseq_Sample_ID"."_".$i."\" value=\"".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo $result_search[$i]['Hiseq_Sample_ID'];
		if($result_search[$i]['Hiseq_Sample_ID']==""){
			echo "-";	
		}
		echo "</a>";
		echo "</td>";
		
		
		if(!(($run=="-"  or $run=="") and $keywords=="")){
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
			echo "<td>";
			echo $result_search[$i]['lane_count'];
			if($result_search[$i]['lane_count']==""){
				echo "-";	
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
		echo "<a class=\"button\" href=\"hiseq_search_result_detial.php?ID=".$result_search[$i]['Hiseq_Sample_ID']."\">";
		echo $result_search[$i]['Sample_Name'];
		if($result_search[$i]['Sample_Name']==""){
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
		if($run=="-" and $result_user[0]['main']=="y"){
			echo "<input type=\"text\" name=\"Read_Length_".$i."\" id=\"Read_Length_".$i."\" value=\"".$result_search[$i]['Read_Length']."\">";
		}
		else{
			echo $result_search[$i]['Read_Length']."&nbsp;";	
		}
		
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Conc'];
		if($result_search[$i]['Conc']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Volume'];
		if($result_search[$i]['Volume']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		if($run=="-" and $result_user[0]['main']=="y"){
			/*echo "<select name=\"Mode_".$i."\" id=\"Mode_".$i."\">";
			echo "<option value=\"Hiseq\"";
			if($result_search[$i]['Mode']=="Hiseq"){
				echo " selected=\"selected\" ";	
			}
			
			echo ">Hiseq</option>";
			
			echo "<option value=\"Miseq\"";
			if($result_search[$i]['Mode']=="Miseq"){
				echo " selected=\"selected\" ";	
			}
			echo ">Miseq</option>";
			echo "</select>";*/
			
			echo "<input name=\"Mode_".$i."\" id=\"Mode_".$i."\" value=\"".$result_search[$i]['Mode']."\">";
		}
		else{
			echo $result_search[$i]['Mode'];
			if($result_search[$i]['Mode']==""){
				echo "-";	
			}
		}
		echo "</td>";
		
		echo "<td>";
		echo $result_search[$i]['end'];
		if($result_search[$i]['end']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo $result_search[$i]['Index_Number'];
		if($result_search[$i]['Index_Number']===""){
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
		echo $result_search[$i]['Category'];
		if($result_search[$i]['Category']==""){
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
		echo $result_search[$i]['Avg_Pool'];
		if($result_search[$i]['Avg_Pool']==""){
			echo "-";	
		}
		echo "</td>";
		echo "<td>";
		echo html_entity_decode($result_search[$i]['Remark']);
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
		
		if($run=="-" and $result_user[0]['main']=="y"){
			//$index_ord
			
			echo "<td valign=\"top\">";
			if($result_search[$i]['Lanes']==""){
				
				echo "<input name=\"lane_".$i."\" size=\"10\">";
			}
			else{
				echo $result_search[$i]['Lanes'];
			}
			echo "</td>";
			
			echo "<td valign=\"top\">";
			if($result_search[$i]['Lanes']==""){
				
				echo "<input name=\"lane_count_".$i."\" size=\"10\">";
			}
			else{
				echo $result_search[$i]['lane_count'];
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

		echo $result_search[$i]['state'];
		
		echo "</td>";
	
		echo "</tr>";
	}
	echo "</table><br>";

	#echo "<input type=\"button\" class=\"ipt\" onClick=\"trans();\" value=\" Print \"/>";
	if($result_user[0]['main']=="y"){
		echo "<input type=\"reset\" class=\"button\" value=\"Reset\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" class=\"button\" value=\"Submit\"/>";
		if($run!="" and $run!="-"){
			echo "<a href=\"hiseq_search_result.php?run=$run&email_user=finish\"><input type=\"button\" class=\"button\" value=\"Inform Sequencing Done\"/></a>";
		}
		
		
	}
	
	if($email_user=="finish" and $run!="" and $run!="-"){
		  
		 $res=$conn->query("UPDATE genomics_core.hiseq_sample SET state='done' where Run='".$run."'");
		#echo "UPDATE genomics_core.hiseq_sample SET $value where Hiseq_Sample_ID='".$Hiseq_Sample_ID."'<br>";
		if (!$res){
			$err_count++;
			echo "<br>Run: ".$run." State updated failed.<br>";
		}
		else{
			
			 /* $tomail=$inform_email;
			  #$tomail="miziq@qq.com";
			  if($run_id==""){
				  $tomail="miziq@qq.com";
			  }
			  $CC="KoonHoWong@umac.mo,KaelingTan@umac.mo,viviennefong@umac.mo,miziq@qq.com";
			  $tomail_arr=explode(',',$tomail);
			  $main_mesg="Dear Genomics core user,<br><br>You have some NGS samples finished the sequencing. Sequence Run ID is <a href=\"http://161.64.198.12/genomics_core/hiseq_search_result.php?run=$run_id\">$run_id</a>. You can ask Lakhan or Zhengqiang to get your data. More information can be found on the <a href=\"http://161.64.198.12/genomics_core/hiseq.php\">Genomics Core NGS Sequencing Database</a>.<br><br>Thank you for your patience and cooperation.";
			  $main_mesg.="<br><br>This is an auto-email from the Genomics Core database. Please don't reply directly. If you have any question, please contact Core Tech Support: Vivienne (viviennefong@umac.mo), Kaeling (kaelingtan@umac.mo), Zhengqiang (miziq@qq.com) or Chris (koonhowong@umac.mo).";
		
			  $Subject="FYI: Your NGS sample has been sequencing ($run_id).";
			  $CC_arr=explode(',',$CC);
		
			  if($tomail!=""){
				  
				  
				  $main_mesg.="<br><br><br><br><br>Genomics Core<br>Tech Support:<br>Vivienne: viviennefong@umac.mo<br>Kealing: kaelingtan@umac.mo<br>Vivienne: viviennefong@umac.mo<br>Lakhan: LakhanP@umac.mo<br>Miao: miziq@qq.com<br>";
				  
				  require './PHPMailer-master/PHPMailerAutoload.php';
				  $mail = new PHPMailer;
				  $mail->CharSet    ="UTF-8";                
				  $mail->IsSMTP();                       
				  $mail->SMTPAuth   = true;            
				  $mail->SMTPSecure = "ssl";                
				  $mail->Host       = "smtp.gmail.com";      
				  $mail->Port       = 465;                
				  $mail->Username   = "fhs.genomics.core@gmail.com"; 
				  $mail->Password   = "genomicscore";       
				  $mail->SetFrom('fhs.genomics.core@gmail.com', 'fhs.genomics.core');   
				  #$mail->AddReplyTo("miaozhengqiang1987@gmail.com"," ");                                      
				  $mail->Subject    = $Subject;                  
				  #$mail->AltBody    = ""; 
				  $mail->MsgHTML($main_mesg); #                       
				  
				  for($i=0;$i<count($tomail_arr);$i++){
					  $mail->AddAddress($tomail_arr[$i]);
				  }
				  for($i=0;$i<count($CC_arr);$i++){
					  $mail->AddCC($CC_arr[$i]);
				  }
				  
				  //$mail->AddAttachment("images/phpmailer.gif"); // attachment 
				  if(!$mail->Send()) {
					  echo "Email Faild<br>" . $mail->ErrorInfo;
				  } else {
					  echo "<script>alert('Users informed');document.location = 'hiseq_search_result.php?run=$run'</script>";
				  }
			  }	*/
			
		}
	}
}
echo "</form>";
?>

</body>
</html>