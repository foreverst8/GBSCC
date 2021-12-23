<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table {
    color: #002A60;
	font-family: sans-serif;
    font-size: 15px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
    border-collapse:collapse;
}
td {
    border-width:3px;
}

</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<script language="javascript" type="text/javascript">
new TableSorter("tb1");
</script>

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<?php
$result_price=search("select * from price_table");
$result_price_array=array();

for($i=0;$i<count($result_price);$i++){
    $result_price_array[$result_price[$i]['name']]=$result_price[$i]['price'];
}


$result_price_usd=search("select * from price_table");
$result_price_array_usd=array();

for($i=0;$i<count($result_price_usd);$i++){
    $result_price_array_usd[$result_price_usd[$i]['name']]=$result_price_usd[$i]['price_usd'];
}
?>

<hr>
<br>
<h6>NOVOGENE SEARCH RESULTS</h6>
<table>
    <tr>
        <td align="left" valign="top">
            <?php
		    $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");
		
            if(count($result_user)==0){
                echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
  	        ?>
        </td>
    </tr>
</table>
<br>

<?php
$keywords=$_GET['Keywords'];
$kk=0;
$column=array("run","RNA_extraction","library_QC","sequencing","total_cost_usd","total_cost","Submitter_Name","email","lab","date","remark","Form_file","Contract_file","Approval");

if($_GET['run']){
    if($_GET['Keywords']!=""){
        if($result_user[0]['main']==y){
            $search_result=search("select * from novo_hiseq where run='".$_GET['run']."' and (Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");

            $search_run_result=search("select distinct(run) from novo_hiseq where Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%'");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from novo_hiseq where lab='".$result_user[0]['lab']."' and run='".$_GET['run']."' and (Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
                $search_run_result=search("select distinct(run) from novo_hiseq where lab='".$result_user[0]['lab']."' ORDER BY run ASC");
            }
            else{
                $search_result=search("select * from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' and run='".$_GET['run']."' and (Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
                $search_run_result=search("select distinct(run) from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' and (Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
            }
        }
    }
    else{
        if($result_user[0]['main']==y){
            $search_result=search("select * from novo_hiseq where run='".$_GET['run']."'");
            $search_run_result=search("select distinct(run) from novo_hiseq");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from novo_hiseq where lab='".$result_user[0]['lab']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from novo_hiseq where lab='".$result_user[0]['lab']."' ORDER BY run ASC");
            }
            else{
                $search_result=search("select * from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' and run='".$_GET['run']."'");
                $search_run_result=search("select distinct(run) from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."'");
            }
        }
    }
}
else{
    if($_GET['Keywords']!=""){
        if($result_user[0]['main']==y){
            $search_result=search("select * from novo_hiseq where run like '%$keywords%' or Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%'");
            $search_run_result=search("select distinct(run) from novo_hiseq where run like '%$keywords%' or Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%' ORDER BY run ASC");
        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from novo_hiseq where lab='".$result_user[0]['lab']."' and (run like '%$keywords%' or Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
                $search_run_result=search("select distinct(run) from novo_hiseq where lab='".$result_user[0]['lab']."' ORDER BY run ASC");
            }
            else{
                $search_result=search("select * from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' and (run like '%$keywords%' or Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
                $search_run_result=search("select distinct(run) from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' and (Approval like '%$keywords%' or Submitter_Name like '%$keywords%' or date like '%$keywords%' or lab like '%$keywords%' or email like '%$keywords%')");
            }
        }
    }
    else{
        $kk=1;
        if($result_user[0]['main']==y){
            $search_result=search("select * from novo_hiseq ORDER BY seq_id");
            $search_run_result=search("select distinct(run) from novo_hiseq ORDER BY seq_id");

        }
        else{
            if($result_user[0]['lab_admin']==y){
                $search_result=search("select * from novo_hiseq where lab='".$result_user[0]['lab']."' ORDER BY seq_id");
                $search_run_result=search("select distinct(run) from novo_hiseq where lab='".$result_user[0]['lab']."' ORDER BY seq_id");
            }
            else{
                $search_result=search("select * from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' ORDER BY seq_id");
                $search_run_result=search("select distinct(run) from novo_hiseq where Submitter_Name='".$result_user[0]['user_name']."' ORDER BY seq_id");
            }
        }
    }
}
			
			$last_run_order=count($search_run_result)-1;
			$count_search_result=count($search_result); 

			if($count_search_result>0){
				
				echo "<table border=\"3\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
				echo "<tr align=\"center\" height=\"50px\">";
				echo "<td width=\"100px\">Total Run</td>";
				echo "<td width=\"230px\">";
					
				echo "<form action=\"novogene_hiseq_search_result.php\" method=\"get\">";
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
				
				echo "</td></tr></table><br><hr><br>";
				
				echo "<p>Selected Run : </p>";
				echo $_GET['Keywords'].$_GET['run']."<br><br>";



				for($i=0;$i<$count_search_result;$i++) {
                    if ($search_result[$i]['run'] != $search_run_result[$last_run_order]['run'] and ($_GET['run'] == "")) {
                        continue;
                    }

                    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";

                    echo "<tr align=\"left\" height=\"130px\">";
                    echo "<td width=\"600px\" colspan=\"2\">";
                    echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspRequest ID: </p>";
                    echo $search_result[$i]['run'];
                    echo "<br>";
                    echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspSubmitter: </p>";
                    echo $search_result[$i]['Submitter_Name'];
                    echo "<br>";
                    echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspEmail: </p>";
                    echo $search_result[$i]['email'];
                    echo "<br>";
                    echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspLab: </p>";
                    echo $search_result[$i]['lab'];
                    echo "<br>";
                    echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspDate: </p>";
                    echo $search_result[$i]['date'];
                    echo "</td>";
                    echo "<td align=\"center\" width=\"600px\" colspan=\"2\">";

                    if($result_user[0]['main']==y) {
                        echo "<a class=\"button\" href=\"novogene_hiseq_search_result_detail.php?run=" . $search_result[$i]['run'] . "&run=" . $search_result[$i]['run'] . "\">>></a>";
                    }

                    echo "<p style='color:red'>&nbsp&nbspApproval Status: </p>";
                    echo $search_result[$i]['Approval'];
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td width=\"300px\"><p style=\"font-size:15px;color:#002A60\">&nbsp&nbspSample Information Form</p></td>";
                    echo "<td align=\"center\" width=\"300px\">";
                    if($search_result[$i]['Form_file']==""){
                        echo "&nbsp;";
                    }
                    else{
                        $x = explode(",",$search_result[$i][$column[11]]);
                        $y = count($x);
                        $z = $y - 1;
                        for($ii=0;$ii<$z;$ii++){
                            $a = "../genomics_core/res/";
                            $b = "http://161.64.198.12/genomics_core/res/";
                            $c = $x[$ii];
                            $new = str_replace($a, $b, $c);
                            echo "<a class=\"button\" href=\"".$new."\">>></a>";
                            echo "&nbsp;";
                        }
                    }
                    echo "</td>";

                    echo "<td width=\"300px\"><p style=\"font-size:15px;color:#002A60\">&nbsp&nbspQuotation File</p></td>";
                    echo "<td align=\"center\" width=\"300px\">";
                    if($search_result[$i]['Contract_file']==""){
                        echo "&nbsp;";
                    }
                    else{
                        $healthy = "../genomics_core/res/";
                        $yummy = "http://161.64.198.12/genomics_core/res/";
                        $phrase = $search_result[$i][$column[12]];
                        $newphrase = str_replace($healthy, $yummy, $phrase);                                                                                                
                        echo "<a class=\"button\" target=\"blank\" href=\"".$newphrase."\">>></a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                                        
                    
                    if ($search_result[$i]['Approval'] == "Rejected") {
                    	echo "<tr align=\"left\" height=\"60px\">";
	                    echo "<td width=\"600px\" colspan=\"4\">";
	                    echo "<p style='color:#002A60'>&nbsp&nbspRemark: </p>";
                    	echo $search_result[$i]['remark'];	                
	                 	echo "</td>";
	                    echo "</tr>";
                    
                    }
                    
                                       
                    echo "</table><br><br>";


                    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\" width=\"500px\"><b>&nbsp&nbspService Offered by GBSC Core</b></td>";
                    echo "<td align=\"center\" width=\"125px\">Price (USD)</td>";
                    echo "<td align=\"center\" width=\"125px\">Price (MOP)</td>";
                    echo "<td align=\"center\" width=\"100px\">Unit</td>";
                    echo "<td align=\"center\" width=\"100px\">Quantity</td>";
                    echo "<td align=\"center\" width=\"125px\">Total (USD)</td>";
                    echo "<td align=\"center\" width=\"125px\">Total (MOP)</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspSequencing (Novaseq)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['sequencing'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['sequencing'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "G";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['sequencing'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['sequencing']*$search_result[$i]['sequencing'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['sequencing']*$search_result[$i]['sequencing'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspLibrary QC (for user-prepared library)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['library_QC'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['library_QC'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "library";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['library_QC'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['library_QC']*$search_result[$i]['library_QC'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['library_QC']*$search_result[$i]['library_QC'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspRNA Extraction (from TRIzol sample)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['RNA_extraction'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['RNA_extraction'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "sample";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['RNA_extraction'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['RNA_extraction']*$search_result[$i]['RNA_extraction'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['RNA_extraction']*$search_result[$i]['RNA_extraction'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspRNA-Seq, 6G Raw Data (includes library preparation)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['RNA6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['RNA6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "sample";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['RNA6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['RNA6G']*$search_result[$i]['RNA6G'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['RNA6G']*$search_result[$i]['RNA6G'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspRNA-Seq, 12G Raw Data (includes library preparation)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['RNA12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['RNA12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "sample";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['RNA12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['RNA12G']*$search_result[$i]['RNA12G'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['RNA12G']*$search_result[$i]['RNA12G'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspChIP-Seq, 6G Raw Data (includes library preparation)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['ChIP6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['ChIP6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "sample";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['ChIP6G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['ChIP6G']*$search_result[$i]['ChIP6G'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['ChIP6G']*$search_result[$i]['ChIP6G'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\">";
                    echo "&nbsp&nbspChIP-Seq, 12G Raw Data (includes library preparation)";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array_usd['ChIP12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $result_price_array['ChIP12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo "sample";
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo $search_result[$i]['ChIP12G'];
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array_usd['ChIP12G']*$search_result[$i]['ChIP12G'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\">";
                    echo number_format($result_price_array['ChIP12G']*$search_result[$i]['ChIP12G'],2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td align=\"left\" colspan=\"5\"><b>&nbsp&nbspOther services</b></td>";
                    echo "<td align=\"center\" colspan=\"1\">Total (USD)</td>";
                    echo "<td align=\"center\" colspan=\"1\">Total (MOP)</td>";
                    echo "</tr>";

                    echo "<tr height=\"40px\">";
                    echo "<td style=\"padding-left:5px\" align=\"left\" colspan=\"5\">";
                    if($search_result[$i]['othername']==""){
                        echo "&nbsp&nbsp";
                        echo "None";
                    }
                    else{
                        $test1=$search_result[$i]['othername'];
                        $test2=explode("\n",$test1);
                        for($t=0;$t<count($test2);$t++){
                            echo $test2[$t];
                            echo "<br>";
                        }
                    }
                    echo "</td>";
                    echo "<td align=\"center\" colspan=\"1\">";
                    echo number_format($search_result[$i]['otherusd'],2,".","");
                    echo "</td>";
                    echo "<td align=\"center\" colspan=\"1\">";
                    echo number_format($search_result[$i]['otherusd']*8.1,2,".","");
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"60px\">";
                    echo "<td align=\"left\" colspan=\"5\" style=\"border-left-style:hidden;border-bottom-style:hidden;\">";
                    echo "&nbsp;";
                    echo "</td>";
                    echo "<td width=\"125px\" align=\"center\" colspan=\"1\">";
                    echo "<b>Grand Total (USD)</b>";
                    echo "</td>";
                    echo "<td width=\"125px\" align=\"center\" colspan=\"1\">";
                    echo "<b>Grand Total (MOP)</b>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr height=\"60px\">";
                    echo "<td align=\"left\" colspan=\"5\" style=\"border-left-style:hidden;border-bottom-style:hidden;\">";
                    echo "&nbsp;";
                    echo "</td>";
                    echo "<td align=\"center\" colspan=\"1\">";
                    echo $search_result[$i]['total_cost_usd'];
                    echo "</td>";
                    echo "<td align=\"center\" colspan=\"1\">";
                    echo $search_result[$i]['total_cost'];
                    echo "</td>";
                    echo "</tr>";


                    echo "</table><br><br>";
                }


            }

            else{
				echo "<p>No record found.</p><br>";	
			}
	 
	
?>
</body>
</html>