<?php
require_once __DIR__ . '/../libraries/PHPMailer/Exception.php';
require_once __DIR__ . '/../libraries/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../libraries/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class RSSMailer {
    public static function send($toEmail, $rssUrl)  {
        $rss = @simplexml_load_file($rssUrl);
        if (!$rss) {
            echo "Fluxul RSS nu a putut fi încarcat.";
            return;
        }

        $content = "<h3>Evenimente:</h3><ul>";
        foreach ($rss->channel->item as $item) {
            $content .= "<li><a href='{$item->link}'>{$item->title}</a>";
            $content .= "<p>{$item->description}</p></li><br>";
        }
        $content .= "</ul>";

        $mail = new PHPMailer(true);
        
        // Config SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = Config::get('MAIL_ADDRESS');   
        $mail->Password = Config::get('MAIL_PASSWORD');        
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(Config::get('MAIL_ADDRESS'), 'SportIS');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Evenimente SportIS';
        $mail->Body = $content;

        $mail->send();
    }
}
