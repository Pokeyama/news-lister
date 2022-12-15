<?php

namespace Adm\Scraping;

use Adm\Entity\News;
use Exception;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * IT media新着ニュース
 * https://www.itmedia.co.jp/news/
 */
class ScrapingITmedia extends ScrapingBase
{
    /**
     * @var string スクレイピングの起点URL
     */
    private string $ScrapingUrl = "https://www.itmedia.co.jp/news/subtop/bursts/index.html";

    /**
     * @var array 一覧ページ上のニュースごとの最小クラス
     * 最小のニュースの要素が2つあったので配列
     */
    private array $NewsListClass = ["dispatch-0","dispatch-1"];

    /**
     * @return array
     */
    public function getNewsListClass(): array
    {
        return $this->NewsListClass;
    }

    /**
     * コンストラクタ
     * 親クラスにスクレイピング先のURLを渡す
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ClientExceptionInterface
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
    function getNewsList(): array
    {
        $newsListEntity = array();
        foreach ($this->NewsListClass as $newsListClass) {
            $newsList = $this->getElementByClass($newsListClass);
            foreach ($newsList as $item) {
                $entity = new News();
                // 詳細ページのURL
                $entity->NewsUrl = $item->find("a")->href;
                // ニュースのタイトル
                $entity->NewsTitle = $item->find("a")->text;
                // ニュースの更新日時
                $entity->CreateDt = $this->parseDate->parseITMediaDate($item->find("span")->text);
//                echo "----------------  " . $entity->NewsUrl . " ----------------------";
                // 詳細ページ取得
                $this->setScrapingUrl($entity->NewsUrl);
//                    file_put_contents($entity->NewsTitle . ".html", $this->detailsDom);
                // 詳細ページから本文の最初らへん取得
                $entity->NewsText = $this->detailsDom->find("#cmsBody")->find("p")[0]->text;
//                $entity->NewsText = "";
                // 詳細ページから最初の画像取得
                $entity->NewsImage = $this->detailsDom->find("#cmsBody")->find("img")[0]->src;
//                $entity->NewsImage = "";
                $newsListEntity[] = $entity;
            }
        }
        return $newsListEntity;
    }

//    function getNewsListToHtml(): array
//    {
//        
//    }
}