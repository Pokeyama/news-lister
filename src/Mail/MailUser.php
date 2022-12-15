<?php

namespace Adm\Mail;

/**
 * MailUser
 */
class MailUser
{
    /**
     * @var string|null $userName 差出人 or 受信者
     * 受信者名はオプションなのでnull許可
     */
    public ?string $userName;

    /**
     * @var string $mailAddress 差出人アドレス or 受信者アドレス
     */
    public string $mailAddress;

    /**
     * コンストラクタ
     * @param string|null $userName
     * @param string $mailAddress
     */
    public function __construct(string|null $userName, string $mailAddress)
    {
        $this->mailAddress = $mailAddress;
        
        // 受信者名入力されていなかったらnullのまま
        if ($userName == null) {
            return;
        }
        // 日本語が含まれていたらエンコード
        if (strlen($userName != mb_strlen($userName, 'utf8'))) {
            // 日本語文字列が含まれている
            $this->userName = mb_encode_mimeheader($userName);
        } else {
            // 日本語文字列が含まれていない
            $this->userName = $userName;
        }
    }
}