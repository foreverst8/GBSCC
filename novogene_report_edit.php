<html>
<head>
    <style>
        a, a:visited {
            color:#002A60; text-decoration:none;
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
<h6>Novogene Service Edit Record</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top" >
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
        </td>
    </tr>
</table>



<?php
$run=$_GET['run'];
$search_result=search("select * from genomics_core.novo_hiseq where run='$run'");
$count_search_result=count($search_result);

    if ($count_search_result > 0) {
        for ($i = 0; $i < $count_search_result; $i++) {

            echo "<form action=\"novogene_report_edit_action.php#top\" method=\"post\" enctype=\"multipart/form-data\">";

            echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
            echo "<tr align=\"left\" height=\"130px\">";
            echo "<td width=\"500px\">";
            echo "<p style=\"font-family:sans-serif;font-size:15px;color:#002A60\">&nbsp&nbspRequest ID: </p>";
            echo "<input type=\"hidden\" value=\"" . $search_result[$i]['run'] . "\" name=\"run\" id=\"run\">" . $search_result[$i]['run'];
            echo "<br>";
            echo "<p style=\"font-family:sans-serif;font-size:15px;color:#002A60\">&nbsp&nbspSubmitter: </p>";
            echo $search_result[$i]['Submitter_Name'];
            echo "<br>";
            echo "<p style=\"font-family:sans-serif;font-size:15px;color:#002A60\">&nbsp&nbspEmail: </p>";
            echo $search_result[$i]['email'];
            echo "<br>";
            echo "<p style=\"font-family:sans-serif;font-size:15px;color:#002A60\">&nbsp&nbspLab: </p>";
            echo $search_result[$i]['lab'];
            echo "<br>";
            echo "<p style=\"font-family:sans-serif;font-size:15px;color:#002A60\">&nbsp&nbspDate: </p>";
            echo $search_result[$i]['date'];
            echo "</td>";
            echo "</table><br><br>";


            echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
            echo "<tr height=\"40px\">";
            echo "<td align=\"left\" width=\"500px\"><b>&nbsp&nbspService Offered by GBSC Core</b></td>";
            echo "<td align=\"center\" width=\"125px\">Price (USD)</td>";
            echo "<td align=\"center\" width=\"125px\">Price (MOP)</td>";
            echo "<td align=\"center\" width=\"125px\">Unit</td>";
            echo "<td align=\"center\" width=\"125px\">Quantity</td>";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['sequencing']."\" name=\"sequencing\" id=\"sequencing\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['library_QC']."\" name=\"library_QC\" id=\"library_QC\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['RNA_extraction']."\" name=\"RNA_extraction\" id=\"RNA_extraction\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['RNA6G']."\" name=\"RNA6G\" id=\"RNA6G\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['RNA12G']."\" name=\"RNA12G\" id=\"RNA12G\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['ChIP6G']."\" name=\"ChIP6G\" id=\"ChIP6G\">";
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
            echo "<input type=\"text\" size=\"16\" value=\"".$search_result[$i]['ChIP12G']."\" name=\"ChIP12G\" id=\"ChIP12G\">";
            echo "</td>";
            echo "</tr>";

            echo "<tr height=\"40px\">";
            echo "<td align=\"left\" colspan=\"4\"><b>&nbsp&nbspOther services</b></td>";
            echo "<td align=\"center\" colspan=\"1\">Total (USD)</td>";
            echo "</tr>";

            echo "<tr height=\"40px\">";
            echo "<td align=\"left\" colspan=\"4\">";
            if($search_result[$i]['othername']==""){
                echo "&nbsp&nbsp";
                echo "None";
            }
            else{
                echo "<textarea name=\"othername\" id=\"othername\" rows=\"4\" style=\"width:890px\">".$search_result[$i]['othername']."</textarea>";

            }
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo "<input type=\"text\" size=\"16\" value=\"" . number_format($search_result[$i]['otherusd'],2,".","") . "\" name=\"otherusd\" id=\"otherusd\">";
            echo "</td>";
            echo "</tr>";

            echo "<tr height=\"60px\">";
            echo "<td align=\"left\" colspan=\"3\" style=\"border-left-style:hidden;border-bottom-style:hidden;\">";
            echo "&nbsp;";
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo "<b>Grand Total (MOP)</b>";
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo "<b>Grand Total (USD)</b>";
            echo "</td>";
            echo "</tr>";

            echo "<tr height=\"60px\">";
            echo "<td align=\"left\" colspan=\"3\" style=\"border-left-style:hidden;border-bottom-style:hidden;\">";
            echo "&nbsp;";
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo "<input type=\"text\" size=\"16\" value=\"" . $search_result[$i]['total_cost'] . "\" name=\"total_cost\" id=\"total_cost\">";
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo "<input type=\"text\" size=\"16\" value=\"" . $search_result[$i]['total_cost_usd'] . "\" name=\"total_cost_usd\" id=\"total_cost_usd\">";
            echo "</td>";
            echo "</tr>";

            echo "</table><br><br><hr><br>";

        }

        echo "<br><input type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<a href=\"del_info_mysql.php?database=novo_hiseq&id=" . $search_result[0]['run'] . " \"><input type=\"button\" class=\"button\" name=\"button3\" id=\"button3\" onclick=\"javascript:return window.confirm('Are you sure you want to delete record " . $search_result[0]['run'] . "?');\" value=\"Delete \" /></a>";

        echo "</form>";
    }


?>
</body>
</html>
