<html>
<head>
<style>
a, a:visited { 
    color:#002A60; text-decoration:none; 
}
body {
	margin-left:5%;
	margin-right:5%;
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

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>
<body>
<br>

<?php session_start();?>

<?php require('login.php');?>
<hr>
<br>
<h6>SEASON REPORT</h6>
<br>

<?php 
$result_price=search("select * from price_table");
$result_price_array="";

for($i=0;$i<count($result_price);$i++){
	$result_price_array[$result_price[$i]['name']]=$result_price[$i]['price'];
	$item[$i]=$result_price[$i]['name'];
}
?>

<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<script type="text/javascript"> 
       function check_date(){ 
         var v1=document.getElementById("date_ss").value;
		 var v2=document.getElementById("date_ee").value;
		 
		 var str1= new Array(); 
		 var str1= new Array(); 
		 str1=v1.split("/");
		 str2=v2.split("/");
		 str1=str1.reverse();
		 str2=str2.reverse();
		 var v11=str1.join("");
		 var v22=str2.join("");
		 if(v22<v11){
				alert("Please select correct search date.");
				return false;
			}
       } 
</script>
   
<table width="100%" border="0"  cellspacing="0">
  <tr>
    <td align="left" valign="top">
		<table border="0" cellspacing="0">
		<tr><td width="650">

		<?PHP
	 	$result_user=search("select * from user where user_name='".$_SESSION['username']."'");

		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		if(!($result_user[0]["lab"]=="General Office" or $result_user[0]["main"]=="y")){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';			
			exit;
		}
		?>  
		</td></tr>
		</table>
      
		<table cellpadding="0" cellspacing="0" border="1" bgcolor="#f7f7fc">
			<tr>
			<td>
			
			<?php
    		echo "<form action=\"GenerateSeasonReport.php\" method=\"get\">";
			echo "&nbsp;&nbsp;Year:&nbsp;&nbsp;<select name=\"year\">";
			$thisyear=date("Y");
			echo "<option value=\"$thisyear\" selected=\"selected\">$thisyear</option>";
			
			for($y=$thisyear-1;$y>=2017;$y=$y-1){
			echo "<option value=\"$y\">$y</option>";
			}
			echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
	
			echo "Season:&nbsp;&nbsp;<select name=\"season\">";
			echo "<option value=\"5\" selected=\"selected\">Select Season</option>";
			echo "<option value=\"1\" >Season1 (Jan-Mar)</option>";
			echo "<option value=\"2\" >Season2 (Apr-Jun)</option>";
			echo "<option value=\"3\" >Season3 (Jul-Sep)</option>";
			echo "<option value=\"4\" >Season4 (Oct-Dec)</option>";
			echo "</select><br>";
			echo "&nbsp;&nbsp;Or by Date:&nbsp;&nbsp;";
			echo "<input type=\"text\" name=\"date_ss\" id=\"date_ss\" class=\"tcal\"/>&nbsp;to&nbsp;";
			echo "<input type=\"text\" name=\"date_ee\" id=\"date_ee\" class=\"tcal\"/>";
		
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<input type=\"submit\" value=\"Submit\" class=\"button\" onclick=\"check_date()\">";
			
			echo "</form>";
			?>
			</td>
			</tr>
		</table><br />
    
		<hr>
		
    	<table cellpadding="0" cellspacing="0" border="0">    
		<tr>
		<td>
		<?php
	
		echo "<br>";
		$year=$_GET['year'];
		$season=$_GET['season'];
		$date_ss=$_GET['date_ss'];
		$date_ee=$_GET['date_ee'];
		$date_s="";
		$date_e="";
		if($season==1){
			$date_s=$year."0101";	
			$date_e=$year."0331";
		}
		elseif($season==2){
			$date_s=$year."0401";	
			$date_e=$year."0631";
		}
		elseif($season==3){
			$date_s=$year."0701";	
			$date_e=$year."0931";
		}
		elseif($season==4){
			$date_s=$year."1001";	
			$date_e=$year."1231";
		}
		elseif($season==5){
				#$year="";```````````````````````````````
				$tmp=explode("/",$date_ss);
				$date_s=$tmp[2].$tmp[0].$tmp[1];
				$tmp=explode("/",$date_ee);
				$date_e=$tmp[2].$tmp[0].$tmp[1];
		}
	
	#echo "<br>$date_s--$date_e<br>";
	
	if($year!=""){
		#echo "$year--$season--$date_s--$date_e<br>";
		$nowseason=ceil(date(m)/3);
		$nowyear=date("Y");
		#echo ($year*10+$season)."<br>";
		#echo ($nowyear*10+$nowseason)."<br>";
		#echo (20172)."<br>";
		
		if($season==5 and $date_ee>date(Ymd)){
			echo "<br>There is no report for your selection<br><br>";
		}
		//elseif(($year*10+$season>=$nowyear*10+$nowseason or $year*10+$season<=20172) and $season!=5){
				//echo "<br>There is no report for your selection<br><br>";
		//}
		else{
			
			$result_sangerseq=search("select * from sangerseq_record where replace(replace(left(run,9),'SSR','20'),'R','20') BETWEEN $date_s and $date_e");
			
			#echo "select * from sangerseq_record where replace(replace(run,'SSR','20'),'R','20') BETWEEN $date_s and $date_e<br>";
			#echo "sanger<br>";
			$result_summary=array();
			
			#print_r($result_sangerseq);
			for($i=0;$i<count($result_sangerseq);$i++){
				#$ttt=$result_sangerseq[$i]['Lab'];
				#$result_summary[$ttt]['Sanger']++;	
				$result_summary[$result_sangerseq[$i]['Lab']]["Sanger"]++;
				#echo $result_sangerseq[$i]['Lab'];
				#echo $result_summary;	
				#echo $i."<br>";
			}
			#print_r($result_summary);
			
			echo "Status: Sanger $date_s to $date_e done.<br>";

			
			$result_NGS=search("select * from hiseq_sample where Hiseq_Sample_ID not like 'RE_%' and run <> '-' and replace(replace(run,'HSR',''),'MSR','') BETWEEN $date_s and $date_e");
			#echo "select * from hiseq_sample where run <> '-' and replace(replace(run,'HSR',''),'MSR','') BETWEEN $date_s and $date_e<br>";
			
			for($i=0;$i<count($result_NGS);$i++){
				if($result_NGS[$i]['Mode']=="Miseq"){
					$result_summary[$result_NGS[$i]['lab']]["Miseq"]++;			
				}
				else{
					if($result_NGS[$i]['Read_Length']=="60" and $result_NGS[$i]['end']=="single_end" ){
						if(preg_match("/,/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(',',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["SE60"]=$result_summary[$result_NGS[$i]['lab']]["SE60"]+$tmp_arr[$jj];
							}
						}
						elseif(preg_match("/;/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(';',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["SE60"]=$result_summary[$result_NGS[$i]['lab']]["SE60"]+$tmp_arr[$jj];
							}
						}
						else{
							$result_summary[$result_NGS[$i]['lab']]["SE60"]=$result_summary[$result_NGS[$i]['lab']]["SE60"]+$result_NGS[$i]['lane_count'];	
						}
	
					}
					elseif($result_NGS[$i]['Read_Length']=="60" and $result_NGS[$i]['end']=="paired_end" ){
						
						if(preg_match("/,/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(',',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["PE60"]=$result_summary[$result_NGS[$i]['lab']]["PE60"]+$tmp_arr[$jj];
							}
						}
						elseif(preg_match("/;/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(';',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["PE60"]=$result_summary[$result_NGS[$i]['lab']]["PE60"]+$tmp_arr[$jj];
							}
						}
						else{
							$result_summary[$result_NGS[$i]['lab']]["PE60"]=$result_summary[$result_NGS[$i]['lab']]["PE60"]+$result_NGS[$i]['lane_count'];	
						}
							
					}
					elseif($result_NGS[$i]['Read_Length']=="100" and $result_NGS[$i]['end']=="paired_end" ){

						if(preg_match("/,/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(',',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["PE100"]=$result_summary[$result_NGS[$i]['lab']]["PE100"]+$tmp_arr[$jj];
							}
						}
						elseif(preg_match("/;/",$result_NGS[$i]['lane_count'])){
							$tmp_arr=explode(';',$result_NGS[$i]['lane_count']);
							for($jj=0;$jj<count($tmp_arr);$jj++){
								$result_summary[$result_NGS[$i]['lab']]["PE100"]=$result_summary[$result_NGS[$i]['lab']]["PE100"]+$tmp_arr[$jj];
							}
						}
						else{
							$result_summary[$result_NGS[$i]['lab']]["PE100"]=$result_summary[$result_NGS[$i]['lab']]["PE100"]+$result_NGS[$i]['lane_count'];	
						}		
					}
					else{
						echo "There is something wrong with end and read length. ".$result_NGS[$i]['Read_Length']." --". $result_NGS[$i]['end']."<br>"."select * from hiseq_sample where run <> '-' replace(replace(run,'HSR',''),'MSR','') BETWEEN $date_s and $date_e<br>";	
					}
					
				}
			}
			
			echo "Status: NGS $date_s to $date_e done.<br>";
			$result_reagent=search("select * from reagent where distributed = 'Yes' and CONCAT('20',right(replace(replace(date,'_',''),'/',''),6)) BETWEEN $date_s and $date_e");
			
			for($i=0;$i<count($result_reagent);$i++){
				if(preg_match("/^Combination Request detail/",$result_reagent[$i]['remark']) and $result_reagent[$i]['DNA_High_sensitivty_chip']==1){
						$tmp=explode("<br>",$result_reagent[$i]['remark']);
						
						for($jj=1;$jj<count($tmp);$jj++){
							if(preg_match("/from (.*?) : (\d+)/",$tmp[$jj],$match)){
								
								$result_summary[$match[1]]['DNA_High_sensitivty_chip']=$result_summary[$match[1]]['DNA_High_sensitivty_chip']+round($match[2]/11,2);
							}	
						}
						
				}
				elseif(preg_match("/^Combination Request detail/",$result_reagent[$i]['remark']) and $result_reagent[$i]['RNA_Nano']==1){
					
					$tmp=explode("<br>",$result_reagent[$i]['remark']);
						
						for($jj=1;$jj<count($tmp);$jj++){
							if(preg_match("/from (.*?) : (\d+)/",$tmp[$jj],$match)){
								
								$result_summary[$match[1]]['RNA_Nano']=$result_summary[$match[1]]['RNA_Nano']+round($match[2]/12,2);
							}	
						}
							
				}
				else{
					for($j=5;$j<count($item);$j++){
						if($result_reagent[$i][$item[$j]]!=""){
							$result_summary[$result_reagent[$i]['lab']][$item[$j]]=$result_summary[$result_reagent[$i]['lab']][$item[$j]]+$result_reagent[$i][$item[$j]];
						}	
					}
					
				}
			}
			
			echo "Status: Reagent $date_s to $date_e done.<br>";
			
			echo "<br>";
			
			$r_tmp1=rand(11,99);
			$r_tmp2=rand(11,99);
			$myfile = fopen("../genomics_core/Season_report/season_report_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls", "w") or die("Unable to open file!");
			$myfile2 = fopen("../genomics_core/Season_report/season_report_count_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls", "w") or die("Unable to open file!");
			
			
			echo "<table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">";
			echo "<tr align=\"center\" bgcolor=\"#9999CC\">";
			echo "<td>Lab</td>";
			fwrite($myfile, "Lab");
			fwrite($myfile2, "Lab");
			for($j=0;$j<count($item);$j++){
				$tmp=preg_replace('/_/',' ',$item[$j]);
				echo "<td>$tmp</td>";
				fwrite($myfile, "\t$tmp");
				fwrite($myfile2, "\t$tmp");
			}
			echo "<td>Total</td>";
			fwrite($myfile, "\tTotal\n");
			fwrite($myfile2, "\tTotal\n");
			echo "</tr>";
			echo "<tr align=\"center\" bgcolor=\"#9999CC\">";
			echo "<td>Price</td>";
			fwrite($myfile, "Price");
			fwrite($myfile2, "Price");
			for($j=0;$j<count($item);$j++){
				echo "<td>".$result_price_array[$item[$j]]."</td>";
				fwrite($myfile, "\t".$result_price_array[$item[$j]]);
				fwrite($myfile2, "\t".$result_price_array[$item[$j]]);
			}
			echo "<td>-</td>";
			fwrite($myfile, "\t-\n");
			fwrite($myfile2, "\t-\n");
			echo "</tr>";
			
			$aa=0;
			
			foreach ( $result_summary as $k_lab => $v){
				
				if($aa%2==0){
					echo "<tr align=\"center\">";
				}
				else{
					echo "<tr align=\"center\" bgcolor=\"#F3F3FA\">";	
				}
				$aa++;
				
				
				#echo "<tr align=\"center\">";
				echo "<td>$k_lab</td>";
				fwrite($myfile, "$k_lab");
				fwrite($myfile2, "$k_lab");
				$total_tmp=0;
				for($j=0;$j<count($item);$j++){
					if($result_summary[$k_lab][$item[$j]]==""){
						echo "<td>0</td>";
						fwrite($myfile, "\t0");
						fwrite($myfile2, "\t0");
					}
					else{
						echo "<td>".$result_summary[$k_lab][$item[$j]]."(".($result_summary[$k_lab][$item[$j]]*$result_price_array[$item[$j]]).")</td>";
						$total_tmp=	$total_tmp+($result_summary[$k_lab][$item[$j]]*$result_price_array[$item[$j]]);
						fwrite($myfile, "\t".($result_summary[$k_lab][$item[$j]]*$result_price_array[$item[$j]]));
						fwrite($myfile2, "\t".($result_summary[$k_lab][$item[$j]]));
					}	
				}
				echo "<td>$total_tmp</td>";
				fwrite($myfile, "\t$total_tmp\n");
				fwrite($myfile2, "\t$total_tmp\n");
				echo "</tr>";	
			}
			
			echo "</table><br>";
			echo "<hr>";
			
			fclose($myfile);
			fclose($myfile2);
			
			$NGS_desc=search("desc hiseq_sample");
			$sanger_desc=search("desc sangerseq_record");
			$reagent_desc=search("desc reagent");
			
			$myfile_NGS = fopen("../genomics_core/Season_report/season_report_NGS_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls", "w") or die("Unable to open file!");
			$myfile_sanger = fopen("../genomics_core/Season_report/season_report_sanger_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls", "w") or die("Unable to open file!");
			$myfile_reagent = fopen("../genomics_core/Season_report/season_report_reagent_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls", "w") or die("Unable to open file!");
			
			for($i=0;$i<count($NGS_desc)-1;$i++){
				fwrite($myfile_NGS,$NGS_desc[$i]['Field']."\t");
			}
			fwrite($myfile_NGS, $NGS_desc[$i]['Field']."\n");
			for($i=0;$i<count($result_NGS);$i++){
				$tmpp=join("\t",$result_NGS[$i]);
				if(preg_match('/\r/',$tmpp)){
					$tmpp=preg_replace('/\r/','',$tmpp);	
					#echo "$tmpp<br>";
				}
				if(preg_match('/\n/',$tmpp)){
					$tmpp=preg_replace('/\n/',' ',$tmpp);	
					#echo "$tmpp<br>";
				}
				
				fwrite($myfile_NGS, $tmpp."\n");
			}
			
			for($i=0;$i<count($sanger_desc)-1;$i++){
				fwrite($myfile_sanger,$sanger_desc[$i]['Field']."\t");
			}
			fwrite($myfile_sanger, $sanger_desc[$i]['Field']."\n");
			for($i=0;$i<count($result_sangerseq);$i++){
				fwrite($myfile_sanger, join("\t",$result_sangerseq[$i])."\n");
			}
			
			for($i=0;$i<count($reagent_desc)-1;$i++){
				fwrite($myfile_reagent,$reagent_desc[$i]['Field']."\t");
			}
			fwrite($myfile_reagent, $sanger_desc[$i]['Field']."\n");
			for($i=0;$i<count($result_reagent);$i++){
				fwrite($myfile_reagent, join("\t",$result_reagent[$i])."\n");
			}
			
			fclose($myfile_NGS);
			fclose($myfile_sanger);
			fclose($myfile_reagent);
			
			
			
			
			echo "<br><h6>DOWNLOADS<h6><br><a href=\"../genomics_core/Season_report/season_report_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls\"><p>Download Report</a><br>";
			echo "<a href=\"../genomics_core/Season_report/season_report_count_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls\">Download Report by Item Count</a></p><br>";
			echo "<p><a href=\"../genomics_core/Season_report/season_report_NGS_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls\">NGS Details</a><br>";
			echo "<a href=\"../genomics_core/Season_report/season_report_sanger_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls\">Sanger Sequencing Details</a><br>";
			echo "<a href=\"../genomics_core/Season_report/season_report_reagent_detail_".$date_s."_".$date_e.".$r_tmp1$r_tmp2.xls\">Reagent Details</a></p><br><br><hr>";
			
		}
		
	}
	?>
	</td>
    </tr>
    </table>
	
</body>
</html>