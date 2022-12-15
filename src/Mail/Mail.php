<?php

namespace Adm\Mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * メール
 */
class Mail
{
    public PHPMailer $mailer;

    /**
     * コンストラクタ メーラーの設定を入れておく
     * @param MailerConfig $mailerConfig 
     */
    public function __construct(MailerConfig $mailerConfig)
    {
        mb_language("ja");
        mb_internal_encoding("UTF-8");
        $this->mailer = new PHPMailer(true);

        $this->mailer->CharSet = $mailerConfig->charaSet;
        try {
            $this->mailer->SMTPDebug = $mailerConfig->debugMode;
            $this->mailer->isSMTP();
            $this->mailer->Host = $mailerConfig->host;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $mailerConfig->userName;
            $this->mailer->Password = $mailerConfig->passWord;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mailer->Port = $mailerConfig->port;
            $this->mailer->isHTML($mailerConfig->htmlMode);
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }

    /**
     * 送信するメッセージを入れる
     * @param MailMessage $message メッセージ
     * @return void
     */
    public function setMassage(MailMessage $message): void
    {
        try {

            $this->mailer->setFrom($message->getFrom()->mailAddress, $message->getFrom()->userName);

            foreach ($message->getTo() as $toUser) {
                // 受信者名はnull許可してるからチェック
                if ($toUser == null) {
                    $this->mailer->addAddress($toUser->mailAddress);
                } else {
                    $this->mailer->addAddress($toUser->mailAddress, $toUser->userName);
                }
            }

            $this->mailer->Subject = $message->getSubject();
            $this->mailer->Body = $message->getBody();
            if ($message->getAltBody() != ''){
                $this->mailer->AltBody = $message->getAltBody();
            }
        }catch (\Exception $e){
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }

    /**
     * 送信
     * @return bool 送信できなかったらfalse
     * @throws Exception
     */
    public function send(): bool
    {
        return $this->mailer->send();
    }
}