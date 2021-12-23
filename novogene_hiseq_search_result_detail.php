<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
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
        th {
            font-weight: bold;
        }
        td {
            border-width:3px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>

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
<h6>REVIEW REQUEST</h6>
<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }
            ?>
        </td>
    </tr>
</table>
<br>

<?php

$run=$_GET['run'];

$search_result=search("select * from genomics_core.novo_hiseq where run='$run'");
$count_search_result=count($search_result);


    if ($count_search_result > 0) {
        for ($i = 0; $i < $count_search_result; $i++) {

            echo "<form name=\"review\" action=\"novogene_hiseq_search_result_detail_action.php#top\" method=\"post\" enctype=\"multipart/form-data\">";

            echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
            echo "<tr align=\"left\" height=\"130px\">";
            echo "<td width=\"600px\">";
            echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspRequest ID: </p>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['run'] . "\" name=\"run\" id=\"run\">" . $search_result[$i]['run'];
            echo "<br>";
            echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspSubmitter: </p>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['Submitter_Name'] . "\" name=\"person\" id=\"person\">" . $search_result[$i]['Submitter_Name'];
            echo "<br>";
            echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspEmail: </p>";
            echo $search_result[$i]['email'];
            echo "<br>";
            echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspLab: </p>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['lab'] . "\" name=\"lab\" id=\"lab\">" . $search_result[$i]['lab'];
            echo "<br>";
            echo "<p style=\"font-size:15px;color:#002A60\">&nbsp&nbspDate: </p>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['date'] . "\" name=\"date\" id=\"date\">" . $search_result[$i]['date'];
            echo "</td>";

            echo "<td align=\"center\" width=\"300px\">";
            echo "Sample Information Form";
            echo "<br><br>";
            $x1 = explode(",",$search_result[$i]['Form_file']);
            $y1 = count($x1);
            $z1 = $y1 - 1;
            for($ii=0;$ii<$z1;$ii++){
                $a1 = "../genomics_core/res/";
                $b1 = "http://161.64.198.12/genomics_core/res/";
                $c1 = $x1[$ii];
                $new1 = str_replace($a1, $b1, $c1);
                echo "<a class=\"button\" href=\"".$new1."\">>></a>";
                echo "&nbsp;";
            }
            echo "</td>";

            echo "<td align=\"center\" width=\"300px\">";
            echo "Quotation File";
            echo "<br><br>";
            $h2 = "../genomics_core/res/";
            $y2 = "http://161.64.198.12/genomics_core/res/";
            $p2 = $search_result[$i]['Contract_file'];
            $n2 = str_replace($h2, $y2, $p2);
            echo "<a class=\"button\" target=\"blank\" href=\"".$n2."\">>></a>";
            echo "</td>";
            echo "</tr>";
            echo "</table><br><br>";



            echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
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
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['total_cost_usd'] . "\" name=\"cost\" id=\"cost\">" . $search_result[$i]['total_cost_usd'];
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo $search_result[$i]['total_cost'];
            echo "</td>";
            echo "</tr>";

            echo "</table><br><br><hr><br><br>";



            echo "<p><span style=\"color:red\">Please Confirm Request Approval Status: </span></p>";
            echo "<select name=\"Approval\" id=\"Approval\">";
            if ($search_result[$i]['Approval'] == "Rejected") {
                echo "<option value=\"NA\">NA</option>";
                echo "<option value=\"Rejected\" selected=\"selected\">Rejected</option>";
                echo "<option value=\"Confirmed\">Confirmed</option>";
            } elseif ($search_result[$i]['Approval'] == "Confirmed") {
                echo "<option value=\"NA\">NA</option>";
                echo "<option value=\"Rejected\">Rejected</option>";
                echo "<option value=\"Confirmed\" selected=\"selected\">Confirmed</option>";
            } else {
                echo "<option value=\"NA\" selected=\"selected\">NA</option>";
                echo "<option value=\"Rejected\">Rejected</option>";
                echo "<option value=\"Confirmed\">Confirmed</option>";
            }
            echo "</select><br><br>";

            echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\">";
            echo "<tr align=\"left\" width=\"600 px\" height=\"40 px\">";
            echo "<td width=\"250px\">";
            echo "&nbsp;&nbsp;Remarks<br>";
            echo "<p style=\"color:#002A60;font-size:12px\">&nbsp;&nbsp;*if the request is rejected</p>";
            echo "<td>";
            echo "<textarea name=\"remark\" id=\"remark\" rows=\"4\" style=\"width:500px\"></textarea>";
            echo "</td>";
            echo "</tr>";
            echo "</table><br><br><br>";



            echo "<p><font size=2>*<span style=\"color:red\">WARNING!</span> Clicking Submit when the Request Approval is 'Confirmed' will automatically sends an email to Novogene. Ideally no changes should be done after confirming the request.<br></p>";
            echo "<br><input type=\"submit\" class=\"button\" onclick=\"javascript:{this.disabled=true;document.review.submit()}\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a href=\"del_info_mysql.php?database=novo_hiseq&id=" . $search_result[0]['run'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure you want to delete record " . $search_result[0]['run'] . "?');\" value=\"Delete \" /></a>";



            echo "</form>";

        }

    }

    else {
        echo "<p>There is no record of request $run.<br></p>";
    }



?>
</body>
</html>
