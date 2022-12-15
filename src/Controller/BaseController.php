<?php

namespace Adm\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * コントローラーの基底クラス
 */
abstract class BaseController
{
    /**
     * Container
     * @var \Adm\Container 
     */
    protected \Adm\Container $container;

    /**
     * コンストラクタ
     * @param \Adm\Container $container
     */
    public function __construct(\Adm\Container $container)
    {
        $this->container = $container;
    }

    /**
     * 作って欲しいページの抽象メソッド
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    abstract function index(Request $request, Response $response, $args): Response;
}