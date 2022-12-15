<?php

namespace Adm;

/**
 * Memcached
 */
class Memcached
{
    /**
     * Memcached
     * @var \Memcached Memcached
     */
    private \Memcached $memcached;

    /**
     * コンストラクタ
     * @param string $hostName
     * @param string $port
     */
    public function __construct(string $hostName, string $port)
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer($hostName, $port);
    }

    /**
     * memcachedのオプション設定
     * @param array $options
     * @return bool
     */
    public function setOptions(array $options) : bool
    {
        return $this->memcached->setOptions($options);
    }

    /**
     * 今現在のoptionの値を取り出す
     * @param int $option
     * @return mixed
     */
    public function getOption(int $option) : mixed
    {
        return $this->memcached->getOption($option);
    }

    /**
     * Memcachedにデータをセット
     * 重複している場合上書き
     * @param string $key
     * @param string $value
     * @param int $expiration 有効時間(秒) デフォルト無限
     * @return bool セットに成功したらtrueを返す
     */
    public function set(string $key, string $value, int $expiration = 0): bool
    {
        return $this->memcached->set($key, $value, $expiration);
    }

    /**
     * Memcachedにデータを追加
     * 重複している場合失敗
     * @param string $key
     * @param string $value
     * @param int $expiration 有効時間(秒) デフォルト無限
     * @return bool 追加に成功したらtrue
     */
    public function add(string $key, string $value, int $expiration = 0): bool
    {
        return $this->memcached->add($key, $value, $expiration);
    }

    /**
     * Memcachedからデータをゲット
     * @param string $key
     * @return mixed 迷うねぇ
     */
    public function get(string $key): mixed
    {
        return $this->memcached->get($key);
    }

    /**
     * 直前のgetコマンドの結果を取得
     * https://www.php.net/manual/en/memcached.getresultcode.php
     * @return int
     */
    public function getResultCode(): int
    {
        return $this->memcached->getResultCode();
    }

    /**
     * Memcachedからデータを削除
     * @param string $key
     * @param int $time データを削除するまでの時間
     *                  この間は削除キューに入れられ追加や修正ができなくなる
     *                  0は即時削除
     * @return bool 成功したらture
     */
    public function delete(string $key, int $time = 0): bool
    {
        return $this->memcached->delete($key, $time);
    }

    /**
     * Memcachedから切断する
     * @return bool
     */
    public function quit(): bool
    {
        return $this->memcached->quit();
    }
}