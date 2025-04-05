<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$otp = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
$_SESSION['otp'] = $otp;


$email = $_SESSION['email'];
$role = $_SESSION['role'];


function sendmail($email, $otp, $conn)
{
    require('PHPMailer-master/src/PHPMailer.php');
    require('PHPMailer-master/src/Exception.php');
    require('PHPMailer-master/src/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'medlacplus007@gmail.com';
        $mail->Password = 'dorbeyeqyufepppv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->SetFrom("medlacplus007@gmail.com", "MedlacPlus");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; padding: 30px;">

    <div style="background-color: #ffffff; max-width: 500px; margin: auto; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">

        <h2 style="color: #333333;">One Time Password (OTP)</h2>

        <p style="font-size: 18px; color: #555555; margin-top: 20px;">Your OTP is:</p>

        <div style="background-color: #f9f9f9; border: 1px solid #dddddd; padding: 10px; font-size: 24px; font-weight: bold; color: #333333; margin-top: 10px;">
            ' . $otp . '
        </div>

        <p style="font-size: 14px; color: #777777; margin-top: 20px;">Please use this OTP to complete the verification process.</p>

        <p style="font-size: 14px; color: #777777;">If you didnt request this OTP, please ignore this email.</p>

    </div>

</body>
</html>

';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        return false;
    }
}

if (sendmail($email, $otp, $conn)) {
    header("location: form_otp.php");
    exit();
}
?>