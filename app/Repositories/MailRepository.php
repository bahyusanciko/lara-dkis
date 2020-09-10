<?php
namespace App\Repositories;

use App\Repositories\MailRepository as MailInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailRepository 
{
    public static function sendMail($data)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.sabaindomedika.com';                    // Set the SMTP server to send through
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->SMTPAuth   = "true";    
            $mail->SMTPSecure = "ssl";                               // Enable SMTP authentication
            $mail->Username   = 'noreply@sabaindomedika.com';                     // SMTP username
            $mail->Password   = '!SvG2x&7P}RN';                               // SMTP password
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('noreply@sabaindomedika.com', 'Alumni BKK');
            $mail->AddAddress($data['email']);
            $mail->addReplyTo($data['email']);
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = view($data['view'],$data);
            $mail->send();
            return 'Check your mail';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
