<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailerphp';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail= new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vashti.delapaz@gmail.com';
    $mail->Password = 'kjkqqytznpehyvat';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('vashti.delapaz@gmail.com');

    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    try {
    $mail->send();
    echo "<script>alert('Sent Successfully'); document.location.href = 'email.php';</script>";
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = 'email.php'
    </script>
    ";



}