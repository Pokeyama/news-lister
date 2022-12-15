<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder(Adm\Container::class);
$containerBuilder->useAutowiring(false);

// 設定
$settings = require __DIR__ . '/../src/settings.php';
//var_dump(__DIR__ . '/../src/settings.php');
$settings($containerBuilder);
// 依存注入
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($containerBuilder);
/**
 * @var $container \Adm\Container
 */
$container = $containerBuilder->build();
$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// memcached接続
$container->getMemcached();
// 1ページしかないからルーティングもここでやっちゃう
$app->get('/', \Adm\Controller\NewsController::class . ':index');
// memcached切断
$container->getMemcached()->quit();

$app->run();