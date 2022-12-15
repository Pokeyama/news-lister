<?php

namespace Adm\Mail;

/**
 * メールメッセージ
 */
class MailMessage
{
    /**
     * @var MailUser $from 自分のアドレス
     */
    private MailUser $from;

    /**
     * @var MailUser[] $to 送信先アドレスリスト
     */
    private array $to;

    /**
     * @var string $subject メールタイトル 空でもいいよ
     */
    private string $subject;
    
    /**
     * @var string $body 本文 htmlでもOK 空でもいいよ
     */
    private string $body;

    /**
     * @var string $altBody bodyがhtmlのときのテキスト形式の文章 空でもいいよ
     * このプロパティを入れるとcontent-type が強制的に text/html になるから注意
     */
    private string $altBody;

    /**
     * コンストラクタ
     * @param MailUser $from
     * @param MailUser[] $to
     */
    public function __construct(MailUser $from, array $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = '';
        $this->body = '';
        $this->altBody = '';
    }

    /**
     * @return MailUser
     */
    public function getFrom(): MailUser
    {
        return $this->from;
    }

    /**
     * @return MailUser[]
     */
    public function getTo(): array
    {
        return $this->to;
    }


    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getAltBody(): string
    {
        return $this->altBody;
    }

    /**
     * @param string $altBody
     */
    public function setAltBody(string $altBody): void
    {
        $this->altBody = $altBody;
    }

}

