<?php
SESSION_START();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("config.php");

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/PHPMailerAutoload.php';
require '../PHPMailer/src/SMTP.php';

$uemail = $_POST['email'];
$_SESSION['email'] = $uemail;
$chk_cf="select * from franchise_users where email='$uemail' and franchise_type!='cf'";
$res_cf = mysqli_query($conn,$chk_cf);
$cf_count = mysqli_num_rows($res_cf);
if($cf_count>0 && $cf_count==0)
{
	$data = 2;
}
else{
$sql="select * from franchise_users where email='".$uemail."' and franchise_type='cf'";
$result = mysqli_query($conn,$sql);
$row_count = mysqli_num_rows($result);
if($row_count==1)
{
	$rows = mysqli_fetch_array($result);
	$mobile = $rows['mobile'];
	$otp = rand(0000,9999);
	
	$chk_otp="select * from otp where mobile='".$mobile."' and status='1'";
	$result_otp = mysqli_query($conn,$chk_otp);
	$otp_count = mysqli_num_rows($result_otp);
	if($otp_count==0)
	{
		$add_otp = "INSERT INTO `otp`(`mobile`, `otp`) VALUES ('$mobile','$otp')";
	}
	else{
		$add_otp = "UPDATE `otp` SET `otp`='$otp' WHERE `mobile`='$mobile'";
	}
	$res_otp = mysqli_query($conn,$add_otp);
	if($res_otp)
	{
		//Otp to mobile
		$otpurl="https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=5CaCfkdZdSV&MobileNo=".$mobile."&SenderID=EXMBNI&Message=Your%20EXIMBNI%20verification%20OTP%20code%20is%20$otp.%20Please%20DO%20NOT%20share%20this%20OTP%20with%20anyone.&ServiceName=TEMPLATE_BASED";
	    $res=file_get_contents($otpurl);
		
		//otp to email
		$message = "Thank You For request. You verification OTP is $otp. Please do not share this OTP with anyone.";
		
		$email = 'info@eximbin.com';
		$password = 'EximBni.2020';
		$to_email = $uemail;
		$message = $message;
		$subject = "Franchise Request.";
			
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'TLS'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "mail.eximbin.com";
		$mail->Port = 25; // or 587
		$mail->IsHTML(true);
		$mail->Username = $email;
		$mail->Password = $password;
		$mail->SetFrom($email);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($to_email);
		$mail->Send();
		
		$data = 1;
	}
}
else
{
	$data = 0;
}
}

echo json_encode($data);
?>