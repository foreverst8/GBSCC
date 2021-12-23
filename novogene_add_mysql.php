<html>
<head>
    <style>
        body {
            margin-left:15%;
            margin-right:15%;
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
<p style="color:#002A60;font-size:12px">*If submission failed, please do not click the Back button on your web browser. For resubmission please reload Novogene page.</p><br>


<?php

$RNA_extraction=$_POST['RNA_extraction'];
$library_QC=$_POST['library_QC'];
$sequencing=$_POST['sequencing'];

$RNA6G=$_POST['RNA6G'];
$RNA12G=$_POST['RNA12G'];
$ChIP6G=$_POST['ChIP6G'];
$ChIP12G=$_POST['ChIP12G'];

$othername=$_POST['othername'];
$otherusd=$_POST['otherusd'];

$total_cost_usd=$_POST['total_cost_value_usd'];
$total_cost=$_POST['total_cost_value'];

$Submitter_Name=$_POST['Submitter_Name'];
$email=$_POST['email'];
$lab=$_POST['lab'];
$date=$_POST['date'];

$Form_file = $_POST['Form_file'];
$Contract_file = $_POST['Contract_file'];


$result_tmp=search("select max(seq_id) from genomics_core.novo_hiseq");

if($result_tmp[0]['max(seq_id)']==""){
    $result_tmp[0]['max(seq_id)']=0;
}

$run="FHSNovoID".($result_tmp[0]['max(seq_id)']+1);



$err_count=0;


if ($otherusd == 0) {
    if ($othername != ""){
        echo "<script>alert('Please check Other Service category. Total price of other services cannot be empty');window.history.back()</script>";
        exit;
    }
}
if ($othername == "") {
    if ($otherusd != 0){
        echo "<script>alert('Please check Other Service category. Information of other services cannot be empty');window.history.back()</script>";
        exit;
    }
}


/*
if (is_uploaded_file($_FILES['Form_file']['tmp_name'])) {
    $upfile = $_FILES["Form_file"];
    $type = $upfile["type"];
    if ($type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        echo "<script>alert('Sample information form should be an .xlsx file.');window.history.back()</script>";
        //echo "<br><p><span style=\"color:darkblue\"><b>Sample information form should be an .xlsx file.</b></span></p><br>";
        exit;
    }
    $tmp_name = $upfile["tmp_name"]; //uploaded file tmp location
    $okType = true;
    if ($okType) {
        $error = $upfile["error"]; //uploaded file system value
        $Form_file = "../genomics_core/res/novo_hiseq/Sample_Information_" . $run . ".xlsx";
        if (move_uploaded_file($tmp_name, $Form_file)) {
        } else {
            echo "<p><br>Sample information form (xlsx) upload failed. Please contact Genomics Core support.<br><br></p>";
            exit;
        }
    } else {
        echo "<br><p>Please upload the sample information form (xlsx).</p>";
    }
}
*/


$total = count($_FILES['Form_file']['name']);
for( $i=0 ; $i < $total ; $i++ ) {
    $tmpFilePath = $_FILES['Form_file']['tmp_name'][$i];
    if ($tmpFilePath != ""){
    	$a = $i + 1;
        $newFilePath = "../genomics_core/res/novo_hiseq/Sample_Information_" . $run . "_" . $a . ".xlsx";
        $Form_file = $Form_file.$newFilePath.",";
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        } else {
            echo "<p><br>Sample information form (xlsx) upload failed. Please contact Genomics Core support.<br><br></p>";
            exit;
        }
    }
}




if (is_uploaded_file($_FILES['Contract_file']['tmp_name'])) {
    $upfile = $_FILES["Contract_file"];
    $type = $upfile["type"];
    if ($type != "application/pdf") {
        echo "<script>alert('Quotation should be a PDF file.');window.history.back()</script>";
        //echo "<br><p><span style=\"color:darkblue\"><b>Quotation file should be a PDF.</b></span></p><br>";
        //$err_count++;
        exit;
    }
    $tmp_name = $upfile["tmp_name"]; //uploaded file tmp location
    $okType = true;
    if ($okType) {
        $error = $upfile["error"]; //uploaded file system value
        $Contract_file = "../genomics_core/res/novo_hiseq/Quotation_" . $run . ".pdf";
        if (move_uploaded_file($tmp_name, $Contract_file)) {
        } else {
            echo "<p><br>Quotation file (PDF) upload failed. Please contact Genomics Core support.<br><br></p>";
            exit;
        }
    } else {
        echo "<br><p>Please upload the quotation file (PDF).</p>";
    }
}




if($RNA_extraction != "" && $library_QC != "" && $sequencing != "" && $RNA6G != "" && $RNA12G != "" && $ChIP6G != "" && $ChIP12G != "") {

    if ($Form_file != "" && $Contract_file != "") {

        if ($total_cost_usd != "" && $total_cost != "" && $total_cost_usd != 0 && $total_cost != 0) {


            $value = "'" . ($result_tmp[0]['max(seq_id)'] + 1) . "','$run','$RNA_extraction','$library_QC','$sequencing','$RNA6G','$RNA12G','$ChIP6G','$ChIP12G','$othername','$otherusd','$total_cost_usd','$total_cost','$Submitter_Name','$email','$lab','$date','$Form_file','$Contract_file'";
            $name = "seq_id,run,RNA_extraction,library_QC,sequencing,RNA6G,RNA12G,ChIP6G,ChIP12G,othername,otherusd,total_cost_usd,total_cost,Submitter_Name,email,lab,date,Form_file,Contract_file";


            $conn = db_connect();
            mysqli_query($conn, "SET NAMES GB2312");
            $res = $conn->query("INSERT INTO genomics_core.novo_hiseq ($name) VALUES (" . $value . ")");


            $request_record = "";

            if ($RNA_extraction > 0) {
                $request_record .= "RNA Extraction (from TRIzol sample), quantity (per sample): $RNA_extraction<br>";
            }
            if ($library_QC > 0) {
                $request_record .= "Library QC (for user-prepared library), quantity (per library): $library_QC<br>";
            }
            if ($sequencing > 0) {
                $request_record .= "Sequencing (Novaseq), quantity (per G): $sequencing<br>";
            }

            if ($RNA6G > 0) {
                $request_record .= "RNA-Seq, 6G Raw Data (includes library preparation), quantity (per sample): $RNA6G<br>";
            }
            if ($RNA12G > 0) {
                $request_record .= "RNA-Seq, 12G Raw Data (includes library preparation), quantity (per sample): $RNA12G<br>";
            }
            if ($ChIP6G > 0) {
                $request_record .= "ChIP-Seq, 6G Raw Data (includes library preparation), quantity (per sample): $ChIP6G<br>";
            }
            if ($ChIP12G > 0) {
                $request_record .= "ChIP-Seq, 12G Raw Data (includes library preparation), quantity (per sample): $ChIP12G<br>";
            }

            if ($othername != "" && $otherusd != 0) {
                $request_record .= "Other services:<br>";
                $othertest=explode("\n",$othername);
                for($t=0;$t<count($othertest);$t++){
                    $request_record .= "$othertest[$t]<br>";
                }
            }


            $request_record .= "<br>Grand Total (in USD): $total_cost_usd<br>";

            $request_record .= "Grand Total (in MOP): $total_cost<br>";


            if (!$res) {
                echo "<br><hr><br><b><span style=\"font-family:sans-serif;font-size:20px;color:red\">Your request submission failed. Please contact Genomics Core support.</span></b>";
            } else {
                echo "<br><hr><br><b><span style=\"font-family:sans-serif;font-size:20px;color:red;\">Your Novogene service request submitted successfully.</span></b>";
               

                
                $result_lab=search("select * from lab where lab_name='$lab'");
                $tomail="wendysou@um.edu.mo,".$result_lab[0]['director_email'].",".$email;
                //$tomail="460774252@qq.com,".$result_lab[0]['director_email'].",".$email;
                require('email_CC.php');
                $tomail_arr=explode(',',$tomail);
                $CC_arr=explode(',',$CC);

                $Subject="FYI: Novogene service request of $Submitter_Name from $lab";

                if($tomail!=""){

                    $main_mesg="Dear $Submitter_Name and ".$result_lab[0]['lab_director'].",<br><br>Thank you for requesting Novogene service. Request ID is <a href=\"http://161.64.198.12/GBSCC/novogene_hiseq_search_result.php?run=$run\">$run</a>. You can find request information by clicking <a href=\"http://161.64.198.12/GBSCC/novogene_hiseq_search_result.php?run=$run\">Core Database</a>.<br><br>Please wait for a further email informing the approval status of your request.<br><br>Request summary:<br>".$request_record."<br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Genomics Core database</a>. Please do not reply to this email address. For any queries, please contact the Genomics Core Support team.";

                    $main_mesg.=$main_mesg_email;
                                       
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
                	$mail->Subject    = $Subject;
                	$mail->MsgHTML($main_mesg);
                    
                                       
                    for($i=0;$i<count($tomail_arr);$i++){
                        $mail->AddAddress($tomail_arr[$i]);
                    }
                    for($i=0;$i<count($CC_arr);$i++){
                        $mail->AddCC($CC_arr[$i]);
                    }

                    if(!$mail->Send()) {
                        echo "<br><br>Request email failed. Please contact Genomics Core support.<br><br>" . $mail->ErrorInfo;
                    } else {
                        echo "<p><br><br>Request email send to: $tomail<br><br>Request email CC: $CC<br><br>Request summary:<br>$request_record<br><br></p>";
                    }
                }
                


            }


        } else {
        echo "<script>alert('Please check the request form, grand total cannot be zero.');window.history.back()</script>";
        }

    } else {
    echo "<script>alert('Please upload the sample information form and/or the quotation file.');window.history.back()</script>";
    }

} else {
    echo "<script>alert('Please check the request form, quantity field cannot be empty.');window.history.back()</script>";
    echo "<br><p><span style=\"color:darkblue\"><b>Please upload the correct format for the sample information form and/or the quotation file.</b></span></p><br>";
}




?>
