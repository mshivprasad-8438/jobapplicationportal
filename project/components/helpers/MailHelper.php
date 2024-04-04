<?php
namespace app\helpers;

use CComponent;
use Yii;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class MailHelper extends CComponent
{
    public static function sendMail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host ='smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bookexchange.server@gmail.com'; // SMTP username
            $mail->Password = 'intw uaaa rnpq fkbo'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;
            $mail->setFrom("bookexchange.server@gmail.com","frm server");
            $mail->addAddress($to);
            // $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            $mail->send();
            echo "in helper";
           return true;
        } catch (Exception $e) {
           return false;
        }
    }
}