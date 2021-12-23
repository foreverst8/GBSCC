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
            font-size: 17px;
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
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }
            ?>
        </td>
    </tr>
</table>
<br>

<?php

$run = $_POST['run'];
$person = $_POST['person'];
$lab = $_POST['lab'];
$date = $_POST['date'];
$cost = $_POST['cost'];

$remark = $_POST['remark'];
$Approval = $_POST['Approval'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$res = $conn->query("UPDATE genomics_core.novo_hiseq SET remark = '$remark' WHERE run='$run'");
$res = $conn->query("UPDATE genomics_core.novo_hiseq SET Approval = '$Approval' WHERE run='$run'");

if (!$res) {
    echo "<hr><p style=\"font-family:sans-serif;font-size:20px;color:red\"><br>Request $run failed to updated. Please contact Genomics Core support.<br><br></p>" . mysql_error();
} else {
    echo "<hr><p style=\"font-family:sans-serif;font-size:20px;color:red\"><br>Request $run has been $Approval.<br><br></p>";
}



$search_result = search("select * from novo_hiseq where run='$run'");
$count_search_result = count($search_result);


for ($i = 0; $i < $count_search_result; $i++) {
    if ($result_user[0]['main'] == y) {

        if ($search_result[$i]['Approval'] == "Confirmed") {
        	
 
        	$id_tmp=search("select max(statement_id) from genomics_core.novo_statement");
            if($id_tmp[0]['max(statement_id)']==""){
                $id_tmp[0]['max(statement_id)']=0;
            }
            
            $value1 = "'" . ($id_tmp[0]['max(statement_id)'] + 1) . "','$date','$run','withdrawal','$cost','$person','$lab'";
            $name1 = "statement_id,date,description,type,cost,person,lab";
            $res1 = $conn->query("INSERT INTO genomics_core.novo_statement ($name1) VALUES (" . $value1 . ")");
            
                        
           	        
            if ($search_result[$i]['Form_file'] != "" && $search_result[$i]['Contract_file'] != "") {

                $result_lab = search("select * from lab where lab_name='" . $search_result[$i]['lab'] . "'");
                $tomail = "gongxin@novogene.com,"."hanxiao@novogene.com,"."asia_hmt@novogene.com,"."wendysou@um.edu.mo,".$result_lab[0]['director_email'] . "," . $search_result[$i]['email'];
                //$tomail = "siyun.liu@uq.net.au,".$result_lab[0]['director_email'] . "," . $search_result[$i]['email'];
                $tomail_arr = explode(',', $tomail);
                require('email_CC.php');
                $CC_arr = explode(',', $CC);                

                $d = explode(",",$search_result[$i]['Form_file']);
                $e = count($d);
                $f = $e - 1;
                $phraseContract = $search_result[$i]['Contract_file'];

                $Subject = "[UM-FHS] Project confirmation using FHS GBSC Core account";

                if ($tomail != "") {

                    $main_mesg = "To: NOVOGENE (HK) COMPANY LIMITED
                            <br><br>
                            Dear Novogene,
                            <br><br>
                            Based on your previous quotation, we confirm to proceed with the sequencing service (Project ID: $run) as attached using the account of Genomics, Bioinformatics & Single Cell Analysis Core account. 
                            <br><br>
                            Attached please find the sample information form and the quotation for your follow up.
                            <br><br>
                            Please deliver all results to the corresponding user(s) directly.
                            <br><br>
                            Please acknowledge by email reply. Thank you.
                            <br><br>
                            Best Regards,
                            <br><br>
                            Wendy Sou
                            <br>
                            Faculty of Health Sciences | University of Macau
                            <br>
                            Tel: +853 8822 4976";

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

                    for($g=0;$g<$f;$g++){
                        $mail->AddAttachment($d[$g]);
                    }
                    $mail->AddAttachment($phraseContract);


                    for ($i = 0; $i < count($tomail_arr); $i++) {
                        $mail->AddAddress($tomail_arr[$i]);
                    }
                    for ($i = 0; $i < count($CC_arr); $i++) {
                        $mail->AddCC($CC_arr[$i]);
                    }

                    //send the message, check for errors
                    if (!$mail->Send()) {
                        echo "<p>Confirmation email failed. Please contact Genomics Core support.<br><br></p>" . $mail->ErrorInfo;
                    } else {
                        echo "<p>Confirmation email has been sent to Novogene & Users. <br><br>Email send to: $tomail<br><br>Email CC: $CC<br><br></p>";
                    }
                }
            } else {
                echo "<p>Please upload the sample information form and/or the quotation file.</p><br><br>";
            }
            
        }



        if ($search_result[$i]['Approval'] == "Rejected") {

                $result_lab=search("select * from lab where lab_name='".$search_result[$i]['lab']."'");
                $tomail= "wendysou@um.edu.mo,".$result_lab[0]['director_email'].",".$search_result[$i]['email'];
                //$tomail= "siyun.liu@uq.net.au,".$result_lab[0]['director_email'].",".$search_result[$i]['email'];
                require('email_CC.php');
                $tomail_arr = explode(',', $tomail);
                $CC_arr = explode(',', $CC);

                $Subject = "FYI: Novogene sequencing request of ".$search_result[$i]['Submitter_Name']." from " . $search_result[$i]['lab'] . "";

                if ($tomail != "") {

                    $main_mesg = "Dear Core User,<br><br>Please be informed that your request <a href=\"http://161.64.198.12/GBSCC/novogene_hiseq_search_result.php?run=$run\">$run</a> for Novogene sequencing has been declined due to reasons stated in the remarks. Please check for details by clicking <a href=\"http://161.64.198.12/GBSCC/novogene_hiseq_search_result.php?run=$run\">Core Database</a>.<br><br>Remark: $remark<br><br>Please be noted that the current request is invalid now. Any resubmission of request will need to be submitted as a new request with new request ID.<br><br>This is an automated email from the <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

                    $main_mesg .= $main_mesg_email;
                    
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

                    for ($i = 0; $i < count($tomail_arr); $i++) {
                        $mail->AddAddress($tomail_arr[$i]);
                    }
                    for ($i = 0; $i < count($CC_arr); $i++) {
                        $mail->AddCC($CC_arr[$i]);
                    }

                    //send the message, check for errors
                    if (!$mail->Send()) {
                        echo "<p>Email failed to send to request submitter. Please contact Genomics Core support.<br><br></p>" . $mail->ErrorInfo;
                    } else {
                        echo "<p>Rejection email send to: $tomail<br><br>Rejection email CC: $CC<br><br>Remark: $remark<br><br></p>";
                    }
                }

        }



    }
}




?>
