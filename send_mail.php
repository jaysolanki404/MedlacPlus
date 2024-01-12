<?php
require('config/config.php');
// session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $conn)
{
    require('PHPMailer-master/src/PHPMailer.php');
    require('PHPMailer-master/src/Exception.php');
    require('PHPMailer-master/src/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'medlacplus007@gmail.com';
        $mail->Password   = 'dorbeyeqyufepppv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->SetFrom("medlacplus007@gmail.com","MedlacPlus");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Hi,<br>
Forgot your password?<br>
We received a request to reset the password for your account.<br>
To reset your password, click on the button below:<br>
Reset password<br>
Or copy and paste the URL into your browser:
 <br>
            <a href='http://localhost/medlacplus/update_password.php?email=$email'>reset password</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        return false;
    }
}

if (isset($_POST['send-link'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];
    $_SESSION['role'] = $role;

    // Prepare and execute the SQL query using PDO
    $sql = "SELECT * FROM $role WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if (sendmail($email, $conn) === true) {
            echo "
                <script>
                    alert('Password reset link sent to mail.');
                    window.location.href='index.php'    
                </script>";
        } else {
            echo "
                <script>
                    alert('Something went wrong');
                    window.location.href='forgot_password.php'
                </script>";
        }
    } else {
        echo "
            <script>
                alert('Email Address Not Found');
                window.location.href='forgot_password.php'
            </script>";
    }
}
?>
