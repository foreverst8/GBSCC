<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<style>
    body {
        margin-left:20%;
        margin-right:20%;
    }
    table, th, td {
        color: #002A60;
        font-family: sans-serif;
        font-size: 17px;
        font-weight: 100;
        margin-top: 2px;
        margin-bottom: 2px;
    }
    ol{
        list-style:none;
    }
</style>
</head>

<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>NOVOGENE SEQUENCING SERVICE</h6>
<br>
<br>

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

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
<link rel="stylesheet" type="text/css" href="jquery.editable-select.min.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.editable-select.min.js"></script>
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

    function total_cost(){
        var n1=document.getElementById("RNA_extraction").value;
        var n3=document.getElementById("library_QC").value;
        var n4=document.getElementById("sequencing").value;

        var n5=document.getElementById("RNA6G").value;
        var n6=document.getElementById("RNA12G").value;
        var n7=document.getElementById("ChIP6G").value;
        var n8=document.getElementById("ChIP12G").value;
        var n9=document.getElementById("otherusd").value;


        var pn1=<?php echo $result_price_array["RNA_extraction"]?>;
        var pn3=<?php echo $result_price_array["library_QC"]?>;
        var pn4=<?php echo $result_price_array["sequencing"]?>;

        var pn5=<?php echo $result_price_array["RNA6G"]?>;
        var pn6=<?php echo $result_price_array["RNA12G"]?>;
        var pn7=<?php echo $result_price_array["ChIP6G"]?>;
        var pn8=<?php echo $result_price_array["ChIP12G"]?>;

		
		var cost= n1*pn1 + n3*pn3 + n4*pn4 + n5*pn5 + n6*pn6 + n7*pn7 + n8*pn8 + n9*8.1;
		cost=cost.toFixed(2);
		document.getElementById("total_cost").innerHTML=cost;
		document.getElementById("total_cost_value").value=cost;
       }

    function total_cost_usd(){

        var m1=document.getElementById("RNA_extraction").value;
        var m3=document.getElementById("library_QC").value;
        var m4=document.getElementById("sequencing").value;

        var m5=document.getElementById("RNA6G").value;
        var m6=document.getElementById("RNA12G").value;
        var m7=document.getElementById("ChIP6G").value;
        var m8=document.getElementById("ChIP12G").value;
        var m9=document.getElementById("otherusd").value;


        var pm1=<?php echo $result_price_array_usd["RNA_extraction"]?>;
        var pm3=<?php echo $result_price_array_usd["library_QC"]?>;
        var pm4=<?php echo $result_price_array_usd["sequencing"]?>;

        var pm5=<?php echo $result_price_array_usd["RNA6G"]?>;
        var pm6=<?php echo $result_price_array_usd["RNA12G"]?>;
        var pm7=<?php echo $result_price_array_usd["ChIP6G"]?>;
        var pm8=<?php echo $result_price_array_usd["ChIP12G"]?>;


        var cost_usd= m1*pm1 + m3*pm3 + m4*pm4 + m5*pm5 + m6*pm6 + m7*pm7 + m8*pm8 + m9*1;
        cost_usd=cost_usd.toFixed(2);
        document.getElementById("total_cost_usd").innerHTML=cost_usd;
        document.getElementById("total_cost_value_usd").value=cost_usd;
       }

</script>

<script type="text/javascript">

    function update(){
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');
        var children = "";
        if (input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                children += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML = '<ul>'+children+'</ul>';
        }
    }

    function update_contract(){
        var input = document.getElementById('Contract_file');
        var output = document.getElementById('contract_fileList');
        var children = "";
        if (input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                children += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML = '<ul>'+children+'</ul>';
        }
    }


</script>



<table>
    <tr>
        <td align="left" valign="top" >
        <?PHP
        $result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
		$permission=$result_user[0]['hiseq'];
		if(count($result_user)==0){
			#echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
			echo 'You do not have permission to access this page.<br />';
			exit;
	    }
	    ?>

            <h6>1. Summary</h6>
            <br>
            <ul>
                <li>FHS has prepaid a PE150 Illumina Sequencing Service with Novogene, members of FHS can request this service via this website.</li>
                <br>
                <li>The cost will be deducted from the <span style="color:red">faculty allocated funding</span> of the corresponding PI.</li>
                <br>
                <li>Users who are interested in this service <span style="color:red">must get approval from FHS via this website</span> before sending out samples (please see the workflow diagram and the procedure details shown below).</li>
                <br>
                <li>To have more details in services provided by Novogene, please see in the file here: <a target="_blank" class="button" href="./files/FHSpresentation.pdf">Click</a><br>Or refer to a zoom meeting recording with Novogene representative: <a class="button" href="novogene_video.php">Click</a></li>
				<br>
            </ul>
            <br>
            <br>

            <h6>2. Novogene Services</h6>
            <br>
            <ul>
                <li class="end">The prepaid deposit by FHS only covers the following services that listed in the price table below</li>
            </ul>
            <br>
                <table border="2" cellspacing="0" cellpadding="0" bordercolor="#999999">
                    <tr height="40px" valign="middle">
                        <td style="font-size:16px;padding-left:5px" width="520px"><b>Service Offered by GBSC Core</td>
                        <td align="center" style="font-size:16px" width="120px"><b>Unit</td>
                        <td align="center" style="font-size:16px" width="180px"><b>Unit Price (USD)</td>
                        <td align="center" style="font-size:16px" width="180px"><b>Unit Price (MOP)</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">Sequencing (Novaseq)</td>
                        <td align="center" style="font-size:14px">G</td>
                        <td align="center" style="font-size:14px">7.00</td>
                        <td align="center" style="font-size:14px">56.70</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">Library QC (for user-prepared library)</td>
                        <td align="center" style="font-size:14px">library</td>
                        <td align="center" style="font-size:14px">10.00</td>
                        <td align="center" style="font-size:14px">81.00</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">RNA Extraction (from TRIzol sample)</td>
                        <td align="center" style="font-size:14px">sample</td>
                        <td align="center" style="font-size:14px">15.00</td>
                        <td align="center" style="font-size:14px">121.50</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">RNA-Seq 6G Raw Data (includes library preparation)</td>
                        <td align="center" style="font-size:14px">sample</td>
                        <td align="center" style="font-size:14px">80.00</td>
                        <td align="center" style="font-size:14px">648.00</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">RNA-Seq 12G Raw Data (includes library preparation)</td>
                        <td align="center" style="font-size:14px">sample</td>
                        <td align="center" style="font-size:14px">125.00</td>
                        <td align="center" style="font-size:14px">1012.50</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">ChIP-Seq 6G Raw Data (includes library preparation)</td>
                        <td align="center" style="font-size:14px">sample</td>
                        <td align="center" style="font-size:14px">155.00</td>
                        <td align="center" style="font-size:14px">1255.50</td>
                    </tr>
                    <tr height="40px">
                        <td style="font-size:14px;padding-left:5px">ChIP-Seq 12G Raw Data (includes library preparation)</td>
                        <td align="center" style="font-size:14px">sample</td>
                        <td align="center" style="font-size:14px">205.00</td>
                        <td align="center" style="font-size:14px">1660.50</td>
                    </tr>
                </table>
            <br>
            <ul>
                <li class="end">Raw data delivering is through FTP (direct download from server of service supplier)</li>
            </ul>
            <br>
            <ul>
                <li class="end">Information on sample preparation & shipping instruction are provided: <a target="_blank" class="button" href="./files/PreQC handbook-Novogene.pdf">Click</a></li>
            </ul>
            <br>
            <br>

            <h6>3. Workflow</h6>
            <br>
            <img src="layout/novo_flowchart.png" border="2" height="37%">
            <br>
            <br>
            <br>

            <h6>4. Procedure</h6>
            <br>
            <ul>
                <b>STEP 1</b>
                <br><br>
                <li>USER:</li>
                    <ol>
                        <li class="end">- discuss project details with Novogene representative, you can contact Elaina Lo (<span style="color:blue"><u>Elaina.lo@novogene.com</u></span>) & copy <span style="color:blue"><u>asia_hmt@novogene.com</u></span> (the group email address)</li><br>
                        <li class="end">- in your email, please indicate your name, lab and will likely use FHS account once it is approved</li>
                        <li class="end">- download and fill up the Novogene_Library_Sample_Information_FHS form here: <a class="button" href="./files/Novogene_Library_Sample_Information_FHS.xlsx">Click</a></li>
                    </ol>
                <br>
                <li>Novogene:</li>
                    <ol>
                        <li class="end">- issue a quotation file to users</li>
                    </ol>
                <br>
                <br>

                <b>STEP 2</b>
                <br><br>
                <li>USER:</li>
                <ol>
                    <li class="end">- submit the request via this website</li>
                    <li class="end">- upload sample information form & quotation file via this website</li>
                </ol>
                <br>
                <p><font size="2"><span style="color:red">*Once the sample information form has been uploaded, user cannot make any changes, please fill the form carefully.</span></font></p>
                <br>
                <p><font size="2"><span style="color:red">*If user would like to edit the uploaded form, please contact Genomics Core support: siyunliu@um.edu.mo</span></font></p>
                <br>
                <br>
                <li>FHS:</li>
                <ol>
                    <li class="end">- review the request submitted by users</li>
                </ol>
                <br>
                <br>

                <b>STEP 3</b>
                <br><br>
                <li>FHS:</li>
                <ol>
                    <li class="end">- if the request is <span style="color:red">approved</span>, the confirmation email will be sent to users & Novogene</li>
                    <li class="end">- if the request is <span style="color:red">rejected</span>, the rejection email will be sent to users</li>
                </ol>
                <br>
                <li>USER:</li>
                <ol>
                    <li class="end">- receive confirmation email if the request is <span style="color:red">approved</span></li>
                    <li class="end">- receive rejection email and check remarks if the request is <span style="color:red">rejected</span></li>
                </ol>
                <br>
                <p><font size="2"><span style="color:red">*Please be aware that only the request that has been approved by FHS can be proceeded.</span></font></p>
                <br>
                <br><br>

                <b>STEP 4</b>
                <br><br>
                <li>USER:</li>
                <ol>
                    <li class="end">- send out samples to Novogene upon receiving the confirmation email</li>
                </ol>
                <br>
                <p><font size="2"><span style="color:red">*User will be solely responsible for sending the samples to Novogene.</span></font></p>
                <br>
                <br>
                <br>
                
                <b>STEP 5&nbsp;&nbsp;Shipping of samples</b>
                <br><br>
                <p>Users can select to ship samples via China or Hong Kong.</p><br><br><br>
                <p><u>(1) For shipping via China (e.g. Zhuhai):</u></p><br><br>
                <li>Users are recommended to ship samples in dry ice to Novogene in Tianjin. You are recommended to use SF express service, indicating Novogene will pay for the shipping service.</li><br>
                <li>Address:</li><br>
                <ol>
                    <li class="end">Novogene Building B07, Venture Headquarter Base, Wuqing Development Area, Tianjin, China</li>                   
                    <li class="end">天津市武清区创业总部基地B07栋</li>
                </ol>
                <br>
                <li>Contact:</li><br>
                <ol>
                    <li class="end">Sample Receiving Department</li>
                    <li class="end">联系人：天津科服收样组</li>
                    <li class="end">Tel: +86 18522699037</li>
                </ol>
                <br><br>
                <p><u>(2) For shipping via Hong Kong:</u></p><br><br>
                <li>The collection site is the address of the courier Novogene cooperated and consolidate all samples in HK and transfer to Beijing. The shipping cost from Macau to HK is to be paid by user. For the time being, sample can only be sent at room temperature.</li><br>
                <li>Collection site address</li>
                <br>
                <ol>
                    <li class="end">Novogene (HK) Co., LTD</li>
                    <li class="end">Lot NO.3719, DD104, Kam Pok West Road, Tai Sun Wai, Yuen Long, N.T, Hong Kong</li>
                </ol>
                <br>
                <li>Contact:</li><br>
                <ol>
                    <li class="end">ATTN: GARY CHAN</li>
                    <li class="end">Tel: +852 34859221, 26121032, 26121828</li>
                </ol>
                <br>                
                <br>                
                           
            </ul>
	    </td>

	    <td valign="top">
	    <?php require("novogene_hiseq_search.php");?>
	    </td>
    </tr>
</table>
<hr>
	
	<br>
    <?php

        echo "<h6>5. Request Form<h6><br>";

	    echo "<form name=\"novogene\" action=\"novogene_add_mysql.php#top\" method=\"post\" enctype=\"multipart/form-data\">";
		echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
		echo "<tr height=\"40px\" align=\"left\"/>";
		echo "<td width=\"260\">";
		echo "&nbsp&nbspSubmitter:&nbsp";
		echo $result_user[0]['user_name'];
		echo "<input type=\"hidden\" name=\"Submitter_Name\" value=\"".$result_user[0]['user_name']."\"/>";
		echo "</td>";
        echo "<td width=\"260\">";
        echo "&nbsp&nbspEmail:&nbsp";
        echo $result_user[0]['email'];
        echo "<input type=\"hidden\" name=\"email\" value=\"".$result_user[0]['email']."\"/>";
        echo "</td>";
		echo "<td width=\"260\">";
		echo "&nbsp&nbspLab:&nbsp";
		echo $result_user[0]['lab'];
        echo "<input type=\"hidden\" name=\"lab\" value=\"".$result_user[0]['lab']."\"/>";
        echo "</td>";
        echo "<td width=\"260\">";
		echo "&nbsp&nbspDate:&nbsp";
		echo date('Y-m-d');
		echo "<input type=\"hidden\" name=\"date\" value=\"".date('Y-m-d')."\"/>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";

		/* price table */
		
		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";

		echo "<tr height=\"40px\" valign=\"middle\">";
		echo "<td align=\"left\" width=\"480px\">";
		echo "<b>&nbsp&nbspService Offered by GBSC Core</b>";
		echo "</td>";
        echo "<td align=\"center\" width=\"180\">";
        echo "<b>Unit Price (USD)";
        echo "</td>";
		echo "<td align=\"center\" width=\"180\">";
		echo "<b>Unit Price (MOP)";
		echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "<b>Unit";
        echo "</td>";
		echo "<td align=\"center\"  width=\"100\">";
		echo "<b>Quantity";
		echo "</td>";
		echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspSequencing (Novaseq)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['sequencing'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['sequencing'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "G";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"sequencing\" id=\"sequencing\"  value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspLibrary QC (for user-prepared library)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['library_QC'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['library_QC'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "library";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"library_QC\" id=\"library_QC\"  value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspRNA Extraction (from TRIzol sample)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['RNA_extraction'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['RNA_extraction'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "sample";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" size=\"2\" style=\"width: 50px;\" name=\"RNA_extraction\" id=\"RNA_extraction\"  value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"30px\" valign=\"middle\">";
        echo "<td align=\"center\" colspan=\"5\">";
        echo "<p style=\"font-size:16px;color:#002A60\">RNA-Seq</p>";
        echo "</td>";      
        echo "</tr>";
        
        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspRNA-Seq 6G Raw Data (includes library preparation)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['RNA6G'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['RNA6G'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "sample";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" style=\"width: 50px;\" name=\"RNA6G\" id=\"RNA6G\" value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspRNA-Seq 12G Raw Data (includes library preparation)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['RNA12G'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['RNA12G'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "sample";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" style=\"width: 50px;\" name=\"RNA12G\" id=\"RNA12G\" value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";
        
        echo "<tr height=\"30px\" valign=\"middle\">";
        echo "<td align=\"center\" colspan=\"5\">";
        echo "<p style=\"font-size:16px;color:#002A60\">ChIP-Seq</p>";
        echo "</td>";      
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspChIP-Seq 6G Raw Data (includes library preparation)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['ChIP6G'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['ChIP6G'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "sample";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" style=\"width: 50px;\" name=\"ChIP6G\" id=\"ChIP6G\" value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

        echo "<tr height=\"40px\" valign=\"middle\">";
        echo "<td align=\"left\" >";
        echo "&nbsp&nbspChIP-Seq 12G Raw Data (includes library preparation)";
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array_usd['ChIP12G'];
        echo "</td>";
        echo "<td align=\"center\">";
        echo $result_price_array['ChIP12G'];
        echo "</td>";
        echo "<td align=\"center\" width=\"100\">";
        echo "sample";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" style=\"width: 50px;\" name=\"ChIP12G\" id=\"ChIP12G\" value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";

		echo "</table><br>";

        /* price table for others*/

        echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
        echo "<tr height=\"80px\" valign=\"middle\">";
        echo "<td align=\"left\" width=\"480px\">";
        echo "<b>&nbsp&nbspOther Service</b> <p style=\"font-size:12px\">(If applicable, please specify service name, price, unit, quantity)</p><br>";
        echo "&nbsp&nbsp<p style=\"color:#002A60;font-size:12px\">*specify as a numbered list</p><br>";
        echo "&nbsp&nbsp<p style=\"color:#002A60;font-size:12px\">*list each service on a new line</p>";
        echo "</td>";
        echo "<td align=\"left\" width=\"365\">";
        echo "&nbsp<p style=\"color:#002A60;font-size:12px\">e.g.</p><br>";
        echo "&nbsp<p style=\"color:#002A60;font-size:12px\">1. RNA extraction, quantity:10, unit price(USD):15</p><br>";
        echo "&nbsp<p style=\"color:#002A60;font-size:12px\">2. Standard Analysis, quantity:10, unit price(USD):60</p><br>";
        echo "</td>";
        echo "<td align=\"center\" width=\"200\">";
        echo "<b>Total Price of Other Service (USD)";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td colspan=\"2\">";
        echo "<textarea name=\"othername\" id=\"othername\" rows=\"4\" style=\"width:850px\"></textarea>";
        echo "</td>";
        echo "<td align=\"center\">";
        echo "<input type=\"number\" min=\"0\" style=\"width: 100px;\" name=\"otherusd\" id=\"otherusd\" value=\"0\" onchange=\"total_cost();total_cost_usd()\">";
        echo "</td>";
        echo "</tr>";
        echo "</table><br>";


        /* total cost */

		echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
		echo "<tr align=\"center\" height=\"60px\">";
		echo "<td align=\"left\" width=\"480\">";
		echo "<p style=\"font-size:20px;color:#002A60\"><b>&nbsp&nbspGrand Total</b></p>";
		echo "</td>";
        echo "<td align=\"center\" width=\"285\">";
        echo "<span id=\"total_cost_usd\" name=\"total_cost_usd\" style=\"display:none\"></span><input type=\"text\" value=\"0\" id=\"total_cost_value_usd\" readonly=\"true\" style=\"width:110;height:30;font-family:sans-serif;font-size:20px;font-weight:700;color:#002A60;text-align:center;border:solid #e6ecff;background-color:#e6ecff;\" name=\"total_cost_value_usd\"><b>USD</b>";
        echo "</td>";
		echo "<td align=\"center\" width=\"285\">";
		echo "<span id=\"total_cost\" name=\"total_cost\" style=\"display:none\"></span><input type=\"text\" value=\"0\" id=\"total_cost_value\" readonly=\"true\" style=\"width:110;height:30;font-family:sans-serif;font-size:20px;font-weight:700;color:#002A60;text-align:center;border:solid #e6ecff;background-color:#e6ecff;\" name=\"total_cost_value\"><b>MOP</b>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		echo "<p><span style=\"color:#002A60\">*please make sure grand total price in this form is the same as shown in quotation.</span></p><br><br><hr><br>";


        /* upload file */

        echo "<p>Upload <span style=\"color:red\">Novogene_Library_Sample_Information_FHS Form</span></p><br>";
        echo "<p style=\"font-size:10px;line-height:20px\">*the form must be in an Excel (.xlsx) format&nbsp&nbsp&nbsp&nbsp*hold down Ctrl key (in Windows) or Command key (on Mac) to select multiple forms if required</p>";
        echo "<br><br>";
        echo "<input name=\"Form_file[]\" id=\"file\" type=\"file\" multiple=\"multiple\" onchange=\"update()\"/>";
        echo "<br><br>";
        echo "<p style=\"font-size:12px;line-height:20px\">selected file(s):</p><br>";
        echo "<div id=\"fileList\"></div>";
        echo "<br><hr><br>";


        echo "<p>Upload <span style=\"color:red\"> Quotation File</span></p><br>";
        echo "<p style=\"font-size:10px;line-height:20px\">*the file must be in a PDF (.pdf) format</p>";
        echo "<br><br>";
        echo "<input name=\"Contract_file\" id=\"Contract_file\" type=\"file\" onchange=\"update_contract()\"/>";
        echo "<br><br>";
        echo "<p style=\"font-size:12px;line-height:20px\">selected file(s):</p><br>";
        echo "<div id=\"contract_fileList\"></div>";
        echo "<br><hr><br>";

		echo "<input type=\"submit\" class=\"button\" value=\"Submit\" onclick=\"javascript:{this.disabled=true;document.novogene.submit()}\">";
		echo "</form>";

	?>

<br><p style="color:#002A60;font-size:12px;line-height:30px">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p><br>


</body>
</html>