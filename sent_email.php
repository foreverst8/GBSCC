<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<br>
<?php require('login.php');?>
<hr>
<br>
<h6>SEND EMAIL<h6>
<br>

<table width="100%" border="0"  cellspacing="0">
   <tr>
	<td align="left" valign="top">
    
	<?PHP
 	error_reporting(E_ERROR | E_PARSE);
	$tomail="";
	$CC="";
	$tomail=$_GET['tomail'];
	$CC=$_GET['CC'];
	$tomail_arr=explode(',',$tomail);
	$main_mesg=$_GET['main_mesg'];
	$Subject=$_GET['Subject'];
	$CC_arr=explode(',',$CC);

	if($tomail!=""){
		
		$main_mesg.="<br><br>This is an automated email from the <a href=\"http://161.64.198.12/genomics_core/index.php\">Genomics Core database</a>. Please do not reply to this email address. For any queries, please contact the Genomics Core Support team.";
		
		/*
		require './PHPMailer-master/PHPMailerAutoload.php';
        $mail = new PHPMailer;
		$mail->CharSet = "UTF-8";
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.office365.com";
		$mail->Port = 587;
		$mail->Username = "fhs.genomics.core@outlook.com";
		$mail->Password = "gbscc12345";
		$mail->SetFrom('fhs.genomics.core@outlook.com', 'fhs.genomics.core');
		$mail->Subject = $Subject;
		$mail->MsgHTML($main_mesg);
		*/
		
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
		
		//$mail->AddAttachment("images/phpmailer.gif"); // attachment 
		if(!$mail->Send()) {
			echo "Email Failed.<br>" . $mail->ErrorInfo;
		} else {
			echo "Email Sent.<br>";
		}
	}
	?>

</body>
</html>