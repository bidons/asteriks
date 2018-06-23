<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration fileregisterClas
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
        $config->application->vendorDir
    ]
);

$loader->registerFiles(['/var/www/phalcon/vendor' . '/autoload.php']);

$loader->registerNamespaces(
    [
        'App\Models' => $config->application->modelsDir,
        'App\Library' => $config->application->libraryDir,
    ],
    true
)->register();





