<?php
// cli-config.php

$app = require('app/app.php');
$em = $app["db.orm.em"];

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));