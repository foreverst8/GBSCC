<?php 
require('email_CC.php');
require './PHPMailer-master/PHPMailerAutoload.php';

function db_connect()
{
    $server = "localhost";
    $username = "root";
    $password = "fhs12345";
    $database = "genomics_core";
    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) 
    {
        die("Connected failed: " . $conn->connect_error);
    } 
    else {
        return $conn;
        // echo "success";
    }
}

function search($query)
{
    $conn = db_connect();
    $result = mysqli_query($conn, $query);
    $arr = array();
    if (mysqli_num_rows($result)>0) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $arr[] = $row; 
        }
    }
    else 
    {
        echo "ERROR: No record found in the database by '$query'<br>";
    }
    mysqli_close($conn);
    return $arr;
}

function send_mail($username, $address, $CC, $Subject, $main_mesg) 
{
    if ($username != '')
    {
        $mail = new PHPMailer;
        $mail->CharSet    = "UTF-8";
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
    }
    for ($i = 0; $i < count($address); $i++) {
        $mail->AddAddress($address[$i]);
    }
    for ($i = 0; $i < count($CC); $i++) {
        $mail->AddCC($CC[$i]);
    }
    if (!$mail->Send()) {
        echo "Request email failed. Please contact Genomics Core Tech support.<br><br>" . $mail->ErrorInfo;
    } else {
        echo "<p>Request email send to: $address<br><br>Request email CC: $CC<br><br></p>";
    }
}