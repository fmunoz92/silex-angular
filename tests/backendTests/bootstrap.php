<?php
putenv("SILEX_MODE=test");

$app = require('app/app.php');
$app["debug"] = true;
?>