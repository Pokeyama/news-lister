<?php

namespace Adm;

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => [

            // View settings
            'view' => [
                'template_path' => __DIR__ . '/../template/',
            ],
            // memcached setting
            'memcached' => [
                'hostname' => 'owl-memcached',
                'port' => 11211,
            ]
        ],
    ]);
};