<?php

namespace Adm\Entity;

use Adm\ParseDate;
use Exception;

/**
 * ニュース
 */
class News
{
    /**
     * @var int ニュースID ユニーク
     */
    public int $NewsId;
    
    /**
     * @var string ニュースタイトル
     */
    public string $NewsTitle;

    /**
     * @var string 要約されたニュースの内容
     */
    public string $NewsText;

    /**
     * @var string ニュースのURL
     */
    public string $NewsUrl;

    /**
     * @var string ニュースの画像
     */
    public string $NewsImage;

    /**
     * @var string ニュースの更新日
     */
    public string $CreateDt;

    /**
     * 24時間前までのニュースを判定
     * @throws Exception
     */
    public function isComparisonDate() : bool
    {
        if (ParseDate::diffDay($this->CreateDt) <= 24)
        {
            return true;
        }
        
        return false;
    }
}