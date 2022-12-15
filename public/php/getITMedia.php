<?php

require __DIR__ . '/../../vendor/autoload.php';
use Adm\Scraping\ScrapingITmedia;

$memcached = new \Adm\Memcached("owl-memcached",11211);

/**
 * キャッシュに保管されていなかったら取得
 * json形式
 * @var $result string
 */
if (!$result = $memcached->get("itmedia")){
    if ($memcached->getResultCode() == \Memcached::RES_NOTFOUND){
        $scrapingITMedia = new ScrapingITmedia();
        $result = $scrapingITMedia->getNewsList();
        $memcached->set("itmedia",json_encode($result),300);
    }
}
else{
    echo $result;
    exit;
}

//sleep(1);

// 冗長だね
$json = json_encode($result);
//$json = file_get_contents('test.json');
header("Content-Type: application/json;charset=UTF-8");
echo $json;
exit;

