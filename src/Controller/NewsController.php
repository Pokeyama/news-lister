<?php

namespace Adm\Controller;

use Adm\Container;
use Adm\Entity\News;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class NewsController extends BaseController
{
    /**
     * コンストラクタ
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * @throws SyntaxError
     * @throws NotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     * @throws DependencyException
     * @throws ChildNotFoundException
     * @throws NotLoadedException
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function index(Request $request, Response $response, $args): Response
    {
        /**
         * @var $newsListEntity News[]
         */
        // Yahoo
//        $scrapingYahoo = new  ScrapingYahoo();
//        $newsListEntity = $scrapingYahoo->getNewsList();

        // ITmedia
//        $scrapingITMedia = new ScrapingITmedia();
//        $newsListEntity = $scrapingITMedia->getNewsList();

//        $newsListEntity = array_merge($scrapingYahoo->getNewsList(),$scrapingITMedia->getNewsList());
        
        // デバッグ用
//        $newsEntity = new News();
//        $newsEntity->NewsId = 1;
//        $newsEntity->NewsTitle = "「八重洲ブックセンター本店」営業終了へ 東京駅前の大型書店 開店から44年、再開発で";
//        $newsEntity->NewsText = "JR東京駅前にある大型書店「八重洲ブックセンター本店」は9月9日、2023年3月で営業を終了すると発表した。同店を含むエリアの再開発のため。オープンから44年での終了となる。";
//        $newsEntity->NewsUrl = "https://www.itmedia.co.jp/news/articles/2209/09/news097.html";
//        $newsEntity->NewsImage = "https://image.itmedia.co.jp/news/articles/2209/06/mt1626333_OUBCRDEX.jpg";
//        $newsEntity->CreateDt = "2022/9/22 16:59:00";
//        $newsListEntity[] = $newsEntity;
//        
//        $newsEntity = new News();
//        $newsEntity->NewsId = 2;
//        $newsEntity->NewsTitle = "「宣戦布告もその後の攻撃も知っている」 松野官房長官、KILLNET声明に言及";
//        $newsEntity->NewsText = "ロシアを支持するハッカー集団「KILLNET」が日本政府に宣戦布告した問題を巡り、松野博一官房長官は9月8日の会見で「（同集団が）宣戦布告のあと、東京メトロ、大阪メトロを攻撃したとしているのは承知している」と話した。";
//        $newsEntity->NewsUrl = "https://www.itmedia.co.jp/news/articles/2209/09/news097.html";
//        $newsEntity->NewsImage = "https://news-pctr.c.yimg.jp/t/news-topics/images/tpc/2022/9/6/5134e0e2f0944af02336b51fb61c295c60cce5b862cd11ec8d3d9d2b7e6fab70.jpg";
//        $newsEntity->CreateDt = "2022/9/22 16:50:00";
//        $newsListEntity[] = $newsEntity;
////        
//        $newsEntity = new News();
//        $newsEntity->NewsId = 3;
//        $newsEntity->NewsTitle = "日本の「iPhone 14」は世界で2番目に安い 世界37カ国の税込価格を円換算で比較 価格調査サイト調べ";
//        $newsEntity->NewsText = "「iPhone 14」シリーズの販売価格は、日本が世界で2番目に安い──ガジェットの国際価格の調査を行うNukeniは9月8日、世界37カ国におけるiPhone 14シリーズの税込価格を比較した結果を発表した。各国の販売価格を日本円（8日時点）に換算したところ、最も安かったのは米国。日本は2位だったという。";
//        $newsEntity->NewsUrl = "https://www.itmedia.co.jp/news/articles/2209/09/news097.html";
//        $newsEntity->NewsImage = "https://news-pctr.c.yimg.jp/t/news-topics/images/tpc/2022/9/6/5134e0e2f0944af02336b51fb61c295c60cce5b862cd11ec8d3d9d2b7e6fab70.jpg";
//        $newsEntity->CreateDt = "2022/9/22 16:50:00";
//        $newsListEntity[] = $newsEntity;

//        $this->container->getMemcached()->set("news","テストニュース",300);
        
        $this->container->getView()->addAttribute('entities',$newsListEntity);
        
        return $this->container->getView()->render($response,'index');
    }
}