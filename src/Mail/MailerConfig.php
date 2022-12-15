<?php

namespace Adm\Mail;

use PHPMailer\PHPMailer\SMTP;

/**
 * メールの設定
 */
class MailerConfig
{
    /**
     * @var string ローカルの文字コード
     */
    public string $encoding = 'UTF-8';

    /**
     * @var string 送信する文字の文字コード
     */
    public string $charaSet = 'UTF-8';

    /**
     * @var int デバッグモード オンにすると送信までの過程がコンソールに表示されます
     */
    public int $debugMode = SMTP::DEBUG_OFF;

    /**
     * @var string HOST名 Gmail
     */
    public string $host = 'smtp.gmail.com';

    /**
     * @var string Gmailのアカウント名 メールアドレス
     */
    public string $userName;

    /**
     * @var string Gmailのパスワード
     */
    public string $passWord;

    /**
     * @var int SMTPで使用するポート番号
     */
    public int $port = 465;

    /**
     * @var bool htmlメール
     */
    public bool $htmlMode = false;

    /**
     * コンストラクタ
     * @param $userName
     * @param $passWord
     */
    public function __construct($userName, $passWord)
    {
        $this->userName = $userName;
        $this->passWord = $passWord;
    }

    /**
     * @param string $encoding
     * @return void
     */
    public function setEncoding(string $encoding): void
    {
        $this->encoding = $encoding;
    }

    /**
     * @param string $charaSet
     */
    public function setCharaSet(string $charaSet): void
    {
        $this->charaSet = $charaSet;
    }

    /**
     * @param int|SMTP $debugMode
     * @return void
     */
    public function setDebugMode(int|SMTP $debugMode): void
    {
        $this->debugMode = $debugMode;
    }

    /**
     * @param string $port
     * @return void
     */
    public function setPort(string $port): void
    {
        $this->port = $port;
    }

    /**
     * @param bool $htmlMode
     * @return void
     */
    public function setHtmlMode(bool $htmlMode): void
    {
        $this->htmlMode = $htmlMode;
    }
}