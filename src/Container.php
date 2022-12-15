<?php

namespace Adm;

use DI\Definition\Source\MutableDefinitionSource;
use DI\DependencyException;
use DI\NotFoundException;
use DI\Proxy\ProxyFactory;
use Psr\Container\ContainerInterface;

/**
 * Class Container
 * @package Adm\Base
 */
class Container extends \DI\Container
{

    /**
     * Container constructor.
     * @param MutableDefinitionSource|null $definitionSource ソース
     * @param ProxyFactory|null $proxyFactory ファクトリー
     * @param ContainerInterface|null $wrapperContainer コンテナ
     */
    public function __construct(MutableDefinitionSource $definitionSource = null, ProxyFactory $proxyFactory = null, ContainerInterface $wrapperContainer = null)
    {
        parent::__construct($definitionSource, $proxyFactory, $wrapperContainer);
    }

    /**
     * ビューを返す
     * @return View ビュー
     * @throws DependencyException 内部例外
     * @throws NotFoundException 内部例外
     */
    public function getView(): View
    {
        return $this->get('view');
    }

    /**
     * Memcachedのオブジェクト
     * @return Memcached Memcached
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getMemcached(): Memcached
    {
        return $this->get('memcached');
    }
}