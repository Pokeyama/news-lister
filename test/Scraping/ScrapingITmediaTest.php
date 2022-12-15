<?php

namespace Test\Scraping;

require __DIR__ . '/../../vendor/autoload.php';

use Adm\Entity\News;
use Adm\Scraping\ScrapingITmedia;
use PHPUnit\Framework\TestCase;

class ScrapingITmediaTest extends TestCase
{
    public function testGetNewsList(){
        $sp = new ScrapingITmedia();
        
        $newsList = $sp->getHtmlResources();
        
        echo $newsList;
    }
    
    public function testGetNews(){
        $sp = new ScrapingITmedia();
        $newsList = $sp->getElementByClass($sp->getNewsListClass());

//        $entityList = array();
        foreach ($newsList as $item) {
            $entity = new News();
//            echo $item->find("a")->getAttribute("href") . "\n";
            $entity->NewsUrl = $item->find("a")->href;
            $entity->NewsTitle = $item->find("a")->text;
            $entity->CreateDt = $item->find("span")->text;
            $sp->setScrapingUrl($item->find("a")->href);
//            $aaa = $sp->getElementByTag("p");
            $entity->NewsText = $sp->getElementByTag("p")->text;
//            $str = mb_convert_encoding($item->find("a"), "UTF-8");
//            echo $str . "\n";
//            echo $item->find("span")->text() . "\n";
            echo print_r($entity);
        }
    }
    
    public function testCURL(){
        $header = [
            // headerに追加したい情報
            // 例）
            //  "Content-Type: application/json",
            // "Accept: application/json",
            // "Authorization: Bearer HogeHoge"
        ];

        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL, 'https://www.itmedia.co.jp/news/subtop/bursts/index.html');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);  // 証明書の検証を無効化
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);  // 証明書の検証を無効化
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

        $output= curl_exec($curl);
        $res=mb_convert_encoding($output, 'UTF-8',"ASCII,JIS,UTF-8,EUC-JP,SJIS");
// エラーハンドリング用
        $errno = curl_errno($curl);
// コネクションを閉じる
        curl_close($curl);

// エラーハンドリング
//        if ($errno !== CURLE_OK) {
//            //エラー処理
//        }

        echo $res;
    }
}
