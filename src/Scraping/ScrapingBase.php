<?php

namespace Adm\Scraping;

use Adm\Entity\News;
use Adm\HtmlParser\Dom;
use Adm\ParseDate;
use PHPHtmlParser\Dom\Node\Collection;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use PHPHtmlParser\Options;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * スクレイピングの基底クラス
 */
abstract class ScrapingBase
{
    /**
     * @var string スクレイピングしたいページURL
     */
    protected string $url;

    /**
     * @var Options オプション
     */
    protected Options $options;

    /**
     * @var Dom ニュース一覧のDOM
     */
    protected Dom $dom;

    /**
     * @var Dom 遷移先ページのDOM
     */
    protected Dom $detailsDom;

    /**
     * @var ParseDate 日付を解析して YYYY/mm/dd HH:mm:ss の形に整える
     */
    protected ParseDate $parseDate;

    /**
     * コンストラクタ
     * スクレイピングしたいURLで初期化
     * 子クラスのメンバ変数で初期化してほしい
     * @param string $url
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws LogicalException
     * @throws StrictException
     * @throws ClientExceptionInterface
     */
    public function __construct(string $url)
    {

        $this->url = $url;
        $this->options = new Options();
        $this->options->setEnforceEncoding('utf-8');
//        echo  $this->options->getEnforceEncoding();

        $this->dom = new Dom();
        $this->dom->setOptions($this->options);
        $this->dom->loadFromUrl($this->url);

        $this->parseDate = new ParseDate();
    }

    /**
     * ニュース一覧を取得する抽象クラス
     * @return News[]
     */
    abstract function getNewsList(): array;

    /**
     * 取得するURLを変更
     * 好きなページのdomを取得したいとき
     * @throws ChildNotFoundException
     * @throws ClientExceptionInterface
     * @throws CircularException
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws StrictException
     */
    public function setScrapingUrl(string $detailUrl): void
    {
        $this->detailsDom = new Dom();
        $this->detailsDom->loadFromUrl($detailUrl, $this->options);
    }

    /**
     * .htmlファイルからDOMを作成する
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws LogicalException
     * @throws StrictException
     */
    public function setHtmlFile(string $htmlPath): void
    {
        $this->detailsDom = new Dom();
        $this->detailsDom->loadFromFile($htmlPath);
    }

    /**
     * id,class,tagからエレメントのdomを取得する
     * @param string $element 取得したいエレメント idかclassかtag
     * @param int|null $nth 取得したいエレメントの要素番号
     * 参考 : https://github.com/paquettg/php-html-parser/issues/129
     * @return Dom
     * @throws NotLoadedException
     * @throws ChildNotFoundException
     */
    protected function getElement(string $element, int $nth = null): mixed
    {
        return $this->dom->find($element, $nth);
    }

    /**
     * tagを指定してdomを取得する
     * @param string $tag
     * @return Collection
     * @throws NotLoadedException
     * @throws ChildNotFoundException
     */
    public function getElementByTag(string $tag): Collection
    {
        return $this->dom->getElementsByTag($tag);
    }

    /**
     * idを指定してdomを取得
     * @param string $id
     * @return Dom
     * @throws ChildNotFoundException
     * @throws NotLoadedException
     */
    protected function getElementById(string $id): Dom
    {
        return $this->dom->getElementById($id);
    }

    /**
     * classを指定してdomを取得
     * @param string $class
     * @return Collection
     * @throws NotLoadedException
     * @throws ChildNotFoundException
     */
    public function getElementByClass(string $class): Collection
    {
        return $this->dom->getElementsByClass($class);
    }

    /**
     * htmlファイルを丸々文字列で取ってくる
     * @return Dom
     */
    public function getHtmlResources(): Dom
    {
        return $this->dom;
    }

}