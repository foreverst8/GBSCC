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
<h6>FLUIDIGM HELIOS - REQUEST INSTRUCTIONS</h6>
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

            <ul>
                <li>For sample preparation, please refer to the CyTOF sample preparation instructions: <a class="button" href="cytof_sample_preparation.php">Click</a>.</li>
                <li>All samples should meet the following criteria:
                    <ol>
                        <li>Starting cell population for staining is 3 x106 cells/mL</li>
                        <li>Cells are required to be dissociated into single cell suspension</li>
                        <li>Antibody-stained cell population should be within a range of 2.5–5 x105 cells/mL</li>
                        <li>Cells should be counted and pelleted before submission</li>
                    </ol>
                </li>
            </ul>
        </td>
        <td valign="top">
            <?php require("cytof_search.php");?>
        </td>
    </tr>
</table>
<br>

<form action="cytof.php" method="get">
    <p>How many samples do you want to prepare?&nbsp;&nbsp;</p><input type="number" name="sample_count" id="sample_count" value="<?php echo $sample_count?>" max="100" min="0"/>&nbsp;&nbsp;<input class="button" type="submit" />
</form>
<br><br><hr>

<?php

    $count=0;
    $sample_count=$_GET['sample_count'];
    $tmp_name="Sample_name-$count";

    $startdate = strtotime("today");
    $rr="CYR";
    $rtmp=str_pad(rand(1, 99), 2, "0", STR_PAD_LEFT);
    $rr.=date("ymd", $startdate);
    $rr.=$rtmp;

    $name="run,tmp_id,cell_type,identity_marker,metal_element,remark,staining,Submitter,Lab,Email,Date";

    $added_count=0;
    $err_count=0;
    $err_count2=0;

    while($count<$sample_count){

        $tmp_name="cell_type-$count";
        if(!$_GET[$tmp_name]) {
            echo "<p>Error in Record number " . ($count + 1) . ". Cell type should not be empty.<br></p>";
            $err_count2++;
            exit;
        }
        if(!preg_match("/^[-.,;_0-9a-zA-Z ]+$/",$_GET[$tmp_name])){
            echo "<p>Error in Record number ".($count+1).". Cell Type should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
            $err_count2++;
            exit;
        }

        $tmp_name="identity_marker-$count";
        if(!$_GET[$tmp_name]){
            echo "<p>Error in Record number ".($count+1).". The identity marker(s) used should not be empty.<br></p>";
            $err_count2++;
            exit;
        }
        if(!preg_match("/^[-.,;_0-9a-zA-Z ]+$/",$_GET[$tmp_name])){
            echo "<p>Error in Record number ".($count+1).". The identity marker(s) used should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
            $err_count2++;
            exit;
        }

        $tmp_name="metal_element-$count";
        if(!$_GET[$tmp_name]){
            echo "<p>Error in Record number ".($count+1).". The metal element used should not be empty.<br></p>";
            $err_count2++;
            exit;
        }
        if(!preg_match("/^[-.,;_0-9a-zA-Z ]+$/",$_GET[$tmp_name])){
            echo "<p>Error in Record number ".($count+1).". The metal element used should not include any special characters. The database only allows characters like \"a-z,A-Z,0-9,_\".<br></p>";
            $err_count2++;
            exit;
        }

        $tmp_name="staining";
        if($_GET[$tmp_name]==""){
            echo "<p>Error in Record number ".($count+1).". Please select the staining property. If staining property not applicable, please select N/A.<br></p>";
            $err_count2++;
            exit;
        }
        
        $count++;
    }

    if($err_count2<1) {
        $count = 0;

        $added_count = 0;
        $result_num = search("select max(tmp_id) from cytof where run='$rr'");
        $max_num = $result_num[0]['max(tmp_id)'] + 1;

        $cy = "";
        $cy_err = "";
        while ($count < $sample_count) {
            $tmp_name = "cell_type-$count";
            if (!$_GET[$tmp_name]) {
                break(1);
            }

            $value = "";

            $value .= "'" . ($rr) . "',";

            $value .= "'" . ($max_num + $count) . "',";

            $tmp_name = "cell_type-$count";
            $value .= "'$_GET[$tmp_name]',";

            $tmp_name = "identity_marker-$count";
            $value .= "'$_GET[$tmp_name]',";

            $tmp_name = "metal_element-$count";
            $value .= "'$_GET[$tmp_name]',";

            $tmp_name = "remark";
            $value .= "'$_GET[$tmp_name]',";
            
            $tmp_name = "staining";
            $tmp_staining = implode(',',$_GET[$tmp_name]);
            $value .= "'$tmp_staining',";

            $value .= "'" . $result_user[0]['user_name'] . "',";
            $value .= "'" . $result_user[0]['lab'] . "',";
            $value .= "'" . $result_user[0]['email'] . "',";
            $value .= "'" . date("Y/m/d") . "'";

            $conn = db_connect();
            mysqli_query($conn, "SET NAMES GB2312");
            $res = $conn->query("INSERT INTO genomics_core.cytof($name) VALUES (" . $value . ")");
            if (!$res) {
                $err_count++;
                $cy_err .= $value . "<br>";
                echo "<p>Error in Sample number " . ($count + 1) . ". mysql_1 " . mysql_error() . "<br></p>";

            } else {
                $added_count++;
                $cy .= $value . "<br>";            
            }

            $count++;

        }



        if ($err_count > 0) {
            echo "<p>$err_count records failed. Please contact Genomics Core support.<br></p>";
            exit;
        }
        
        if ($added_count > 0) {

			echo "<p style=\"color:red\"><br>This request ($added_count samples) added successfully.</p><br><br>";

			
            $result_lab = search("select * from lab where lab_name='" . $result_user[0]['lab'] . "'");
            $tomail = $result_lab[0]['director_email'] . "," . $result_user[0]['email'];
            require('email_CC.php');
            $tomail_arr = explode(',', $tomail);
            $CC_arr = explode(',', $CC);

            $Subject = "FYI: CyTOF submission of " . $_SESSION['username'] . " from " . $result_user[0]['lab'] . " ($rr).";

            if ($tomail != "") {

                $main_mesg = "Dear Core User,<br><br>" . $_SESSION['username'] . " from " . $result_user[0]['lab'] . " has submitted samples for CyTOF. Run ID <a href=\"http://161.64.198.12/GBSCC/cytof_search_result.php?run=$rr\">$rr</a>. You can find sample information by clicking <a href=\"http://161.64.198.12/GBSCC/cytof_search_result.php?run=$rr\">Core Database</a>.<br><br>Please wait for a further email informing the approval status of your request.<br><br>Please do not start staining your cells before receiving a confirmed date from us.<br><br>This is an automated email from <a href=\"http://161.64.198.12/GBSCC/index.php\">Core Database</a>. Please do not reply to this email. For any queries, please contact the Core support team.<br><br>";

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

                if (!$mail->Send()) {
                    echo "<p>Request email failed. Please contact Genomics Core support.<br></p>" . $mail->ErrorInfo;
                } else {
                    echo "<p>Request email sent to: $tomail<br><br>CC: $CC<br></p>";
                }
            }
			

        }
    }
?>

<script language="javascript" type="text/javascript">
    new TableSorter("tb1");
</script>

</body>
</html>