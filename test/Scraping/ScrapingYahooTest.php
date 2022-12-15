<?php

namespace Test\Scraping;

require __DIR__ . '/../../vendor/autoload.php';

use Adm\Entity\News;
use Adm\Scraping\ScrapingYahoo;
use PHPUnit\Framework\TestCase;

class ScrapingYahooTest extends TestCase
{
    public function testGetNewsList(){
        $sp = new ScrapingYahoo();
        $result = $sp->getNewsList();
//        echo $result->text . "\n";

        foreach ($result as $item) {
            $news = new News();
            $news->NewsUrl = $item->href;
            $news->NewsTitle = $item->lastChild()->firstChild()->text;
//            $news->NewsText = $sp->getNewsDetail($ /item->href);
            echo $news->NewsTitle . " " . $news->NewsUrl . " " . $news->NewsText . "\n";
        }
    }
    
    public function testGetNews(){
        $sp = new ScrapingYahoo();
        $result = $sp->getHtmlResources();
        echo $result;
    }
    
    public function testGetElementById()
    {
//        $sp = new ScrapingYahoo();
//        $result = $sp->getElementById("yjnMain");
//        
//        echo $result;
    }
    
    public function testGetElementByTag()
    {
        $sp = new ScrapingYahoo();
        $result = $sp->getElementByTag("a");
        
        $result->each(function ($news){
            echo $news . "\n";
        });
        
//        echo $result;
    }
}
