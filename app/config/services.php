<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Events\Manager as EventsManager;
use Hrcontacts\Library\Elements;
use Hrcontacts\Plugins\NotFoundPlugin;
use Hrcontacts\Plugins\Acl\Resource;
use Hrcontacts\Plugins\Acl\SecurityPlugin;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;


$eventsManager = new EventsManager;

$di->setShared('eventsManager', $eventsManager);

/**
 * We register the events manager
 */
$di->setShared('dispatcher', function () use ($eventsManager) {
    $securityPlugin = new SecurityPlugin;
    $securityPlugin->setResources(new Resource);

    /**
     * Check if the user is allowed to access certain action using the SecurityPlugin
     */
    $eventsManager->attach('dispatch:beforeDispatch', $securityPlugin);

    /**
     * Handle exceptions and not-found exceptions using NotFoundPlugin
     */
    $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

    $dispatcher = new Dispatcher;

    // $dispatcher->setDefaultNamespace('HeroContact\Controllers');
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});
/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($di, $eventsManager) {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);
            $volt->getCompiler()
                ->addFunction('strtotime', 'strtotime')
                ->addFunction('sprintf', 'sprintf')
                ->addFunction('str_replace', 'str_replace')
                ->addFunction('is_a', 'is_a');


            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    $eventsManager->attach('view', function ($event, $view) use ($di, $config) {
        /**
         * @var \Phalcon\Events\Event $event
         * @var \Phalcon\Mvc\View $view
         */
        if ($event->getType() == 'notFoundView') {
            $message = sprintf('View not found - %s', $view->getActiveRenderPath());
            throw new Exception($message);
        }
    });

    $view->setEventsManager($eventsManager);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Register Menu component
 */
$di->set('elements', function () {
    return new Elements;
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});
