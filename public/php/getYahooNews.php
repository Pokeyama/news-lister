<?php

require __DIR__ . '/../../vendor/autoload.php';
use Adm\Scraping\ScrapingYahoo;

$memcached = new \Adm\Memcached("owl-memcached",11211);

/**
 * キャッシュに保管されていなかったら取得
 * json形式
 * jsonのオプション決めることを次はやりましょうかね
 * https://www.flyenginer.com/low/low_php/phpのシリアライズについて関数のまとめ.html
 * @var $result string
 */
if (!$result = $memcached->get("yahoo")){
    if ($memcached->getResultCode() == \Memcached::RES_NOTFOUND){
        $scrapingYahoo = new ScrapingYahoo();
        $result = $scrapingYahoo->getNewsList();
        $memcached->set("yahoo",json_encode($result),300);
    }
}
else{
    echo $result;
    exit;
}

//sleep(1);

$json = json_encode($result);
//$json = file_get_contents('test.json');
header("Content-Type: application/json;charset=UTF-8");
echo $json;
exit;
