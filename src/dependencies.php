<?php

namespace Adm;

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        // view
        'view' => function ($c) {
            $settings = $c->get('settings')['view'];
            return new View($settings['template_path']);
        },
        // memcached
        'memcached' => function ($c) {
            $setting = $c->get('settings')['memcached'];
            return new Memcached($setting['hostname'], $setting['port']);
        }
    ]);
};