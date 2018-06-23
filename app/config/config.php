<?php
use Phalcon\Config;

return new Config(
    [
        "database" => [
            "adapter"     => "postgresql",
            "host"        => "phalcon.compose.asteriks.postgres",
            "username"    => "root",
            "password"    => "root",
            "dbname"      => "asteriks",
        ],
        "application" => [
            "controllersDir" => __DIR__ . "/../../app/controllers/",
            "modelsDir"      => __DIR__ . "/../../app/models/",
            "viewsDir"       => __DIR__ . "/../../app/views/",
            "pluginsDir"     => __DIR__ . "/../../app/plugins/",
            "libraryDir"     => __DIR__ . "/../../app/library/",
            "cacheDir"       => __DIR__ . "/../../app/cache/",
            "baseUri"        => "/",
            "logDir"         => "/var/www/phalcon/logs/",
            "vendorDir"      => "/var/www/phalcon/vendor"
        ],
        'redisCache' => [
            'host' => "redis",
            'port' => 6379,
            'persistent' => false,
            'index' => 0,
            'statsKey' => 'beadon-cache-keys'
        ],
    ]
);


