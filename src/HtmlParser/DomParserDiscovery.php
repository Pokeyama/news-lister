<?php

declare(strict_types=1);

namespace Adm\HtmlParser;

class DomParserDiscovery
{
    /**
     * @var ParserInterface|null
     */
    private static $parser = null;

    public static function find(): ParserInterface
    {
        if (self::$parser == null) {
            self::$parser = new Parser();
        }

        return self::$parser;
    }
}
