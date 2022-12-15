<?php

namespace Adm;

use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * View
 */
class View
{
    /**
     * @var string 拡張子
     */
    private static string $SUFFIX = '.twig';

    /**
     * @var Twig twig
     */
    private Twig $twig;
    
    /**
     * @var array テンプレートにアサインするデータ
     */
    private array $attributes = [];


    /**
     * @param string $template_path
     * @throws LoaderError
     */
    public function __construct(string $template_path)
    {
        $this->twig = Twig::create($template_path);
    }
    
    /**
     * 変数をアサインする
     * @param string $key 変数名
     * @param mixed $value 変数値
     */
    public function addAttribute(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    /**
     * テンプレートを評価する
     * @param string $template テンプレートへのパス
     * @param array $data 追加データ
     * @return string 評価結果
     * @throws LoaderError 内部エラー
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function fetch(string $template, array $data = []): string
    {
        return $this->twig->fetch($template . self::$SUFFIX, $data);
    }

    /**
     * テンプレートの評価結果をレスポンスに書き込む
     * @param Response $response レスポンス
     * @param string $template テンプレートへのパス
     * @param array $data 追加データ
     * @return Response 評価結果
     * @throws LoaderError 内部エラー
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(Response $response, string $template, array $data = []): Response
    {
        $data = array_merge($this->attributes, $data);
        $output = $this->fetch($template, $data);
        $response->getBody()->write($output);
        return $response;
    }

}