<html>
<head>
    <style>
        a, a:visited {
            color:#002A60; text-decoration:none;
            font-size: 5px;
        }
        body {
            margin-left:15%;
            margin-right:15%;
        }
        table, th, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 15px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        div{
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
<h6>Novogene Service Report</h6>
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


<table cellpadding="0" cellspacing="0" border="1" bgcolor="#f7f7fc">
    <tr>
        <td>
            <?php
            echo "<form action=\"novogene_report.php\" method=\"get\">";

            echo "&nbsp;&nbsp;Year:&nbsp;&nbsp;<select name=\"year\">";
            $thisyear=date("Y");
            echo "<option value=\"$thisyear\" selected=\"selected\">$thisyear</option>";

            for($y=$thisyear-1;$y>=2019;$y=$y-1){
                echo "<option value=\"$y\">$y</option>";
            }
            echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<input type=\"submit\" value=\"Submit\" class=\"button\">";

            echo "</form>";
            ?>
        </td>
    </tr>
</table>
<br>



<?php

$year=$_GET['year'];

$_SESSION["year_export"] = $year;

if ($year != "") {

    $result_novogene=search("select * from novo_hiseq where Approval='Confirmed' and year(date)=$year order by run");

    if ($result_novogene != "") {

        $conn = db_connect();
        $total_novogene_usd = $conn->query("select sum(total_cost_usd) as res_usd from novo_hiseq where Approval='Confirmed' and year(date)=$year");
        $total_novogene_mop = $conn->query("select sum(total_cost) as res_mop from novo_hiseq where Approval='Confirmed' and year(date)=$year");
        $row_usd = mysqli_fetch_array($total_novogene_usd);
        $row_mop = mysqli_fetch_array($total_novogene_mop);

        echo "<div>";
        echo "<b style=\"font-size:20px\">Selected Year: $year</b>";
        echo "</div>";
        echo "<p style=\"color:#002A60;font-size:12px\">*only confirmed requests shown in Novogene service annual report.</p>";
        echo "<br><br><br>";
        
        echo "<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
        echo "<tr align=\"center\">";
        echo "<td align=\"left\" width=\"500px\" height=\"40px\"><b>&nbsp&nbspService Offered by GBSC Core</b></td>";
        echo "<td align=\"center\" width=\"130px\"><b>Unit Price (USD)</b></td>";
        echo "<td align=\"center\" width=\"130px\"><b>Unit Price (MOP)</b></td>";
        echo "<td width=\"100px\"><b>Unit</b></td>";
        echo "<td width=\"100px\"><b>Qty.</b></td>";
        echo "<td width=\"130px\"><b>Total Cost (MOP)</b></td>";
        echo "<td width=\"130px\"><b>Total Cost (USD)</b></td>";
        echo "</tr>";

        for ($i = 0; $i < count($result_novogene); $i++) {

            echo "<tr align=\"left\">";
            echo "<td colspan=\"7\" align=\"left\" height=\"50px\">";
            echo "&nbsp&nbsp<a style=\"font-size:12px\" class=\"button\" href=\"novogene_report_edit.php?run=" . $result_novogene[$i]['run'] . "&run=" . $result_novogene[$i]['run'] . "\">>></a>";
            echo "&nbsp&nbsp<b style=\"color:black;font-size:15px\">".$result_novogene[$i]['run']."</b>";
            
            echo "<p style=\"color:black;font-size:15px\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            $h1 = "../genomics_core/res/";
            $y1 = "http://161.64.198.12/genomics_core/res/";
            $p1 = $result_novogene[$i]['Form_file'];
            $n1 = str_replace($h1, $y1, $p1);
            echo "<a style=\"font-size:12px\" class=\"button\" href=\"".$n1."\">Sample Information Form</a>";
            
            echo "&nbsp&nbsp&nbsp&nbsp";
            $h2 = "../genomics_core/res/";
            $y2 = "http://161.64.198.12/genomics_core/res/";
            $p2 = $result_novogene[$i]['Contract_file'];
            $n2 = str_replace($h2, $y2, $p2);
            echo "<a style=\"font-size:12px\" class=\"button\" target=\"blank\" href=\"".$n2."\">Quotation</a>";
           
            echo "&nbsp&nbsp&nbsp&nbspSubmitter:".$result_novogene[$i]['Submitter_Name'];
            echo "&nbsp&nbsp&nbsp&nbspEmail:".$result_novogene[$i]['email'];
            echo "&nbsp&nbsp&nbsp&nbspLab:".$result_novogene[$i]['lab'];
            echo "&nbsp&nbsp&nbsp&nbspDate:".$result_novogene[$i]['date']."</p>";
            echo "</td>";
            echo "</tr>";


            if ($result_novogene[$i]['sequencing'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['sequencing'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['sequencing']*$result_novogene[$i]['sequencing'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['sequencing']*$result_novogene[$i]['sequencing'],2,".","");
                echo "</td>";
                echo "</tr>";
            }


            if ($result_novogene[$i]['library_QC'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['library_QC'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['library_QC']*$result_novogene[$i]['library_QC'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['library_QC']*$result_novogene[$i]['library_QC'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if ($result_novogene[$i]['RNA_extraction'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['RNA_extraction'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['RNA_extraction']*$result_novogene[$i]['RNA_extraction'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['RNA_extraction']*$result_novogene[$i]['RNA_extraction'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if ($result_novogene[$i]['RNA6G'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['RNA6G'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['RNA6G']*$result_novogene[$i]['RNA6G'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['RNA6G']*$result_novogene[$i]['RNA6G'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if ($result_novogene[$i]['RNA12G'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['RNA12G'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['RNA12G']*$result_novogene[$i]['RNA12G'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['RNA12G']*$result_novogene[$i]['RNA12G'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if ($result_novogene[$i]['ChIP6G'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['ChIP6G'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['ChIP6G']*$result_novogene[$i]['ChIP6G'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['ChIP6G']*$result_novogene[$i]['ChIP6G'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if ($result_novogene[$i]['ChIP12G'] > 0) {
                echo "<tr>";
                echo "<td align=\"left\" height=\"30px\">";
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
                echo $result_novogene[$i]['ChIP12G'];
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array['ChIP12G']*$result_novogene[$i]['ChIP12G'],2,".","");
                echo "</td>";
                echo "<td align=\"center\">";
                echo number_format($result_price_array_usd['ChIP12G']*$result_novogene[$i]['ChIP12G'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            if($result_novogene[$i]['othername']!="") {
                echo "<tr>";
                echo "<td colspan=\"5\" align=\"left\" style=\"padding-top:5px;padding-bottom:5px;\">";
                $test1=$result_novogene[$i]['othername'];
                $test2=explode("\n",$test1);
                echo "&nbsp&nbspOther Service:<br>";
                for($t=0;$t<count($test2);$t++) {
                	echo "&nbsp&nbsp";
                    echo $test2[$t];
                    echo "<br>";
                }
                echo "</td>";
                echo "<td align=\"center\" colspan=\"1\">";
                echo number_format($result_novogene[$i]['otherusd']*8.1,2,".","");
                echo "</td>";
                echo "<td align=\"center\" colspan=\"1\">";
                echo number_format($result_novogene[$i]['otherusd'],2,".","");
                echo "</td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<td colspan=\"5\" align=\"right\" height=\"30px\">";
            echo "<b style=\"color:black\">Subtotal&nbsp&nbsp</b>";
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo $result_novogene[$i]['total_cost'];
            echo "</td>";
            echo "<td align=\"center\" colspan=\"1\">";
            echo $result_novogene[$i]['total_cost_usd'];
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<td colspan=\"5\" align=\"left\" height=\"60px\">";
        echo "<b style=\"color:black;font-size:19px\">&nbsp&nbspGrand Total</b>";
        echo "</td>";
        echo "<td align=\"center\">";
        echo '<b style="color:black;font-size:19px">' . number_format($row_mop['res_mop'],2,".","")."</b>";
        echo "</td>";
        echo "<td align=\"center\">";
        echo '<b style="color:black;font-size:19px">' . number_format($row_usd['res_usd'],2,".","")."</b>";
        echo "</td>";
        echo "</tr>";

        echo "</table><br><br>";

		echo "<table align=\"center\">";
        echo "<td><a class=\"button\" href=\"novogene_export.php\">Export</a></td>";
        echo "</table>";

    } else {
        echo "<p>No Novogene service record of $year found in database.</p>";
    }

}
?>
</body>
</html>