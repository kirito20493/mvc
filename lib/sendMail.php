<?php
require './lib/PHPMailer/PHPMailer.php';
require './lib/PHPMailer/SMTP.php';
require './lib/PHPMailer/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
   function sendMail ($email,$username,$password) {
        $subject = "Successful registration confirmation!";
        if (isset($username) && isset($password)) {
            $msg = "User: ".$username."\nPassowrd: ".$password."\nThank you very much!";
        }
        $mail = new PHPMailer();
        $mail->isSMTP();  
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls"; 
        $mail->Port       = 587;  
        $mail->Username   = 'kiritodnvn@gmail.com';               
        $mail->Password   = 'giabao204';  
        $mail->Subject = $subject;
        $mail->setFrom($email);
        if (isset($msg)){
            $mail->Body    = $msg;
        }
        $mail->addAddress($email); 
        return $mail;
   }
?>