<?php

if (!defined("ROOT")) {
    define('ROOT', dirname(__DIR__));
}

if (!defined("APP_ROOT")) {
    define('APP_ROOT', __DIR__);
}

$loader = require(ROOT . '/vendor/autoload.php');

$app = new Silex\Application();

$app->register(new App\Config());

return $app;

?>