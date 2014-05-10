<?php
// cli-config.php
putenv("SILEX_MODE=development");

$app = require('app/app.php');
$em = $app["db.orm.em"];

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));