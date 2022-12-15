<?php

namespace Adm\Scraping;

use Adm\Entity\News;
use Exception;
use PHPHtmlParser\Dom\Node\Collection;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * YahooニュースITトピック
 * https://news.yahoo.co.jp/topics/it
 */
class ScrapingYahoo extends ScrapingBase
{
    /**
     * @var string スクレイピングの起点URL
     */
    private string $ScrapingUrl = "https://news.yahoo.co.jp/topics/it";

    /**
     * @var string 一覧ページ上のニュースごとの最小クラス
     */
    private string $NewsListClass = "newsFeed_item_link";

    /**
     * コンストラクタ
     * 親クラスにスクレイピング先のURLを渡す
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ClientExceptionInterface
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws StrictException
     */
    public function __construct()
    {
        parent::__construct($this->ScrapingUrl);
    }

    /**
     * ニュース一覧のDOMを取ってくる
     * @return News[]
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ClientExceptionInterface
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws NotLoadedException
     * @throws StrictException
     * @throws Exception
     */
    function getNewsList() : array
    {
        $newsListEntity = array();
        $newsList = $this->getElementByClass($this->NewsListClass);
        foreach ($newsList as $news) {
            $newsEntity = new News();
            // ニュースのURL
            $newsEntity->NewsUrl = $news->getAttribute("href");
            // ニュースのタイトル
            $newsEntity->NewsTitle = $news->find(".newsFeed_item_title")->text();
            // ニュースの日付
            $newsEntity->CreateDt = $this->parseDate->parseYahooDate($news->find(".newsFeed_item_date")->text());
            // ニュースの本文を個別ページから取得
            $this->setScrapingUrl($newsEntity->NewsUrl);
            $newsEntity->NewsText = $this->detailsDom->find(".highLightSearchTarget")->text();
            $newsEntity->NewsImage = $this->detailsDom->find("picture")->find("img")->src;
            // 末尾が.jpgで終わってないURLは動画の可能性があるので排除
            if (!str_ends_with($newsEntity->NewsImage, '.jpg')){
                $newsEntity->NewsImage = "";
            }

            $newsListEntity[] = $newsEntity;
        }
        
        return $newsListEntity;
    }
}