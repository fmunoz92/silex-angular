<?php

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    "twig.path" => array(APP_ROOT . "/views/"), "twig.options" => array(
        "cache" => ROOT . "/temp/twig",
    ),
));

$app->register(new \Silex\Provider\MonologServiceProvider(), array(
    "monolog.logfile" => ROOT . "/temp/access.log",
    "monolog.name"    => "app",
));

$app->register(new \Silex\Provider\SessionServiceProvider(), array(
    "session.storage.options" => array(
        "httponly" => true,
        "domain"   => "app.com"
    ),
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


// Register Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), 
    array(
        'dbs.options' => array(
            'mysql' => array (
                'driver'    => 'pdo_mysql',
                'host'      => DB_HOST,
                'dbname'    => DB_DATABASE,
                'user'      => DB_USER,
                'password'  => DB_PASSWORD,
                'charset'   => 'utf8'
            )
        )
    )
);

// Register Doctrine ORM
$app->register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.proxies_dir'           =>  ROOT . "/temp/doctrine/proxy",
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.cache'                 => !$app['debug'] && extension_loaded('apc') ? new \Doctrine\Common\Cache\ApcCache() : new \Doctrine\Common\Cache\ArrayCache(),
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',
        'path'      => APP_ROOT . "/entities/",
        'namespace' => 'App\Entity',
    )),
));

?>