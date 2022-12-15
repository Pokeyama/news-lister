<?php

namespace Test\Entity;

require __DIR__ . '/../../vendor/autoload.php';

use Adm\Entity\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{

    public function testIsComparisonDate()
    {
        $entity = new News();
        $entity->CreateDt = new \DateTime('2022-6-8 11:55:33');

        echo var_export($entity->isComparisonDate());

    }
}
