<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->formsDir,
    ]
)->register();


$loader->registerNamespaces(
    [

        'Hrcontacts\Models' => $config->application->modelsDir,
        'Hrcontacts\Library'     => $config->application->libraryDir,
        'Hrcontacts\Forms'       => $config->application->formsDir,
    ]
)->register();
