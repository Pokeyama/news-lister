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
}
