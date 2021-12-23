<html>
<head>
    <style>
        img {
            margin-right:10px;
        }
        body {
            margin-left:10%;
            margin-right:10%;
        }
        table, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        th {
            font-weight: bold;
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
<h6>HYPERION SEARCH RESULTS</h6>
<br>
<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }

            $sample_count=0;
            if($_GET['sample_count']){
                $sample_count=$_GET['sample_count'];
            }
            ?>
        </td>
        <td valign="top">
            <?php require("hyperion_search.php");?>
        </td>
    </tr>
</table>
<br>
<hr>
<br>

<?php
$tmp_id=$_GET['tmp_id'];
$keywords=$_GET['Keywords'];
$kk=0;
$column=array("run","Approval","tmp_id","tissue_type","identity_marker","metal_element","ROI_number","ROI_dimension","Ar_hours","remark","Submitter","Lab","Email","Date");

if($_GET['run']){
    if($_GET['Keywords']!=""){
        if($result_user[0]['main']==y){
            $search_result=search("select * from hyperion where run='".$_GET['run']."' and (tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
            $search_run_result=search("select distinct(run) from hyperion where tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%'");
        }
        else{
            $search_result=search("select * from hyperion where Submitter='".$result_user[0]['user_name']."' and run='".$_GET['run']."'  and (tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
            $search_run_result=search("select distinct(run) from hyperion where Submitter='".$result_user[0]['user_name']."' and (tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%')");
        }

    }
    else{
        if($result_user[0]['main']==y){
            $search_result=search("select * from hyperion where run='".$_GET['run']."'");
            $search_run_result=search("select distinct(run) from hyperion");
        }
        else{
            $search_result=search("select * from hyperion where Submitter='".$result_user[0]['user_name']."' and run='".$_GET['run']."'");
            $search_run_result=search("select distinct(run) from hyperion where Submitter='".$result_user[0]['user_name']."'");
        }
    }
}
else{
    if($_GET['Keywords']!=""){

        if($result_user[0]['main']==y){

            $search_result=search("select * from hyperion where run like '%$keywords%' or tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%'");
            $search_run_result=search("select distinct(run) from hyperion where run like '%$keywords%' or tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%' ORDER BY run ASC");
        }
        else{

            $search_result=search("select * from hyperion where (run like '%$keywords%' or tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%') and Submitter='".$result_user[0]['user_name']."'");
            $search_run_result=search("select distinct(run) from hyperion where Submitter='".$result_user[0]['user_name']."' and ( run like '%$keywords%' or tissue_type like '%$keywords%' or identity_marker like '%$keywords%' or metal_element like '%$keywords%' or Submitter like '%$keywords%' or Date like '%$keywords%' or Lab like '%$keywords%' or Email like '%$keywords%') ORDER BY run ASC");

        }
    }
    else{
        $kk=1;
        if($result_user[0]['main']==y){
            $search_result=search("select * from hyperion ORDER BY seq_id DESC");
            $search_run_result=search("select distinct(run) from hyperion ORDER BY seq_id ");

        }
        else{
            $search_result=search("select * from hyperion where Submitter='".$result_user[0]['user_name']."' ORDER BY seq_id DESC");
            $search_run_result=search("select distinct(run) from hyperion where Submitter='".$result_user[0]['user_name']."' ORDER BY seq_id ASC");
        }
    }
}

$last_run_order=count($search_run_result)-1;
$count_search_result=count($search_result);

if($count_search_result>0){

    echo "<table border=\"1\"  cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
    echo "<tr align=\"center\">";
    echo "<td width=\"100px\">Total Run</td>";
    echo "<td width=\"250px\">";

    echo "<form action=\"hyperion_search_result.php\" method=\"get\">";
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
    echo "</td></tr></table><br>";
    echo "<p><b>Selected Run: </b></p>";
    echo $_GET['Keywords'].$_GET['run']."<br><br>";

    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#999999\" >";
    echo "<tr align=\"center\">";
    if($result_user[0]['main']==y){
        echo "<td width=\"10px\">&nbsp;</td>";
    }
    echo "<td width=\"100px\">Run</td>";
    echo "<td width=\"100px\"><span style=\"color:red\">Approval status</span></td>";
    echo "<td width=\"40px\">No.</td>";
    echo "<td width=\"100px\">Type of tissues</td>";
    echo "<td width=\"100px\">Identity marker(s)</td>";
    echo "<td width=\"100px\">Metal element</td>";
    echo "<td width=\"100px\">Number of ROI(s) in total</td>";
    echo "<td width=\"100px\">Dimension of each ROI (mm*mm)</td>";
    echo "<td width=\"100px\">Expected hours of Ar usage</td>";
    echo "<td width=\"100px\">User Remark</td>";
    echo "<td width=\"100px\">Submitter</td>";
    echo "<td width=\"100px\">Lab</td>";
    echo "<td width=\"100px\">Email</td>";
    echo "<td width=\"100px\">Date</td>";
    echo "</tr>";

    $col=count($column);
    for($i=0;$i<$count_search_result;$i++){
        if($search_result[$i]['run']!=$search_run_result[$last_run_order]['run'] and ($_GET['run']=="")){
            continue;
        }
        echo "<tr align=\"center\">";

        if($result_user[0]['main']==y){
            echo "<td width=\"10\"><a class=\"button\" href=\"hyperion_edit_record.php?tmp_id=".$search_result[$i]['tmp_id']."&run=".$search_result[$i]['run']."\">>></a></td>";
        }

        for($ii=0;$ii<$col;$ii++){
            echo "<td>";
            if($search_result[$i][$column[$ii]]==""){
                echo "&nbsp;";
            }
            else{
                echo $search_result[$i][$column[$ii]];
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";



    if($result_user[0]['main']==y){

        $runid=$search_result[0]['run'];
        echo "<p><br>*Request ($runid) approval status: </p>";
        echo $search_result[0]['Approval'];

        if($search_result[0]['Approval']==Confirmed){
            echo "<p><br><br>*Time slot: </p>";
            echo $search_result[0]['date_run'];
            echo "&nbsp;&nbsp;";
            echo $search_result[0]['time_run'];
        }

        if($search_result[0]['Approval']==Rejected){
            echo "<p><br><br>*Remarks: </p>";
            echo $search_result[0]['remark_reject'];
        }

        echo "<p><br><br><span style=\"color:red\">Please confirm this request approval status: </span></p>";
        echo "<a class=\"button\" href=\"hyperion_confirm.php?&run=".$search_result[0]['run']."#top\">Click</a>";

    } else{

        $runid=$search_result[0]['run'];
        echo "<p><br>*Your request ($runid) approval status: </p>";
        echo $search_result[0]['Approval'];

        if($search_result[0]['Approval']==Confirmed){
            echo "<p><br><br><span style=\"color:red\">*Time slot: </span></p>";
            echo $search_result[0]['date_run'];
            echo "&nbsp;&nbsp;";
            echo $search_result[0]['time_run'];
        }

        if($search_result[0]['Approval']==Rejected){
            echo "<p><br><br><span style=\"color:red\">*Remarks: </span></p>";
            echo $search_result[0]['remark_reject'];
        }

        if($search_result[0]['Approval']==Pending){
            echo "<p><br><br><span style=\"color:red\">Please wait for a further email informing the approval status of your request.</span></p>";
        }
    }




}
else{
    echo "<p>No record found.</p><br>";
}
?>

<script language="javascript" type="text/javascript">
    new TableSorter("tb1");
</script>

</body>
</html>