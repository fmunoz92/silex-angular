<?php

$app->match("/", "App\Controller\IndexCtr::index")
        ->bind("index");
?>
