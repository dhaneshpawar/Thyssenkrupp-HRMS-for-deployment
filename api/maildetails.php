<?php
//error_reporting(0);
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    require_once('vendor/autoload.php');
    require 'phpmailer/PHPMailerAutoload.php';
    require 'credentials.php';
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 4;                               // Enable verbose debug output
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // $mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = Email;                 // SMTP username
    $mail->Password = Password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
}
else
{
    header("refresh:0;url=notfound.html");    
}
?>