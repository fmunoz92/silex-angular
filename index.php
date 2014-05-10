<?php

putenv("SILEX_MODE=development");

$app = require('app/app.php');
$app->run();

?>