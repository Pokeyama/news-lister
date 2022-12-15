<?php

namespace Test;

require __DIR__ . '/../vendor/autoload.php';
use Adm\ParseDate;
use PHPUnit\Framework\TestCase;

class ParseDateTest extends TestCase
{

    public function testParseYahooDate()
    {
        $parseYahoo = new ParseDate();
        
        echo $parseYahoo->parseYahooDate("6/9(木) 2:59") . "\n";
        echo $parseYahoo->parseYahooDate("10/9(金) 15:9") . "\n";
        echo $parseYahoo->parseYahooDate("6/5(月) 6:59") . "\n";
        echo $parseYahoo->parseYahooDate("5/9(土) 16:52") . "\n";

    }
    
    public function testParseITMediaDate()
    {
        $parseIT = new ParseDate();
        
        echo $parseIT->parseITMediaDate("（9月6日 13時00分）") . "\n";
        echo $parseIT->parseITMediaDate("（10月6日 1時00分）") . "\n";
        echo $parseIT->parseITMediaDate("（12月30日 13時00分）") . "\n";
        echo $parseIT->parseITMediaDate("（1月4日 1時59分）") . "\n";

    }
    
    public function testDiffDay()
    {
        echo "Timezone" . date_default_timezone_get() . "\n";
        echo "現在時刻" . ParseDate::now() . "\n";
        echo "Timezone" . date_default_timezone_get() . "\n";
        $parseDate = new ParseDate();
        
        echo $parseDate::diffDay('2022-6-8 11:55:33') . "\n";
        echo $parseDate::diffDay('2022-7-7 11:55:33') . "\n";
    }
}
