<?php

$app->get("/loggedin", "App\Controller\UserCtr::loggedin")
        ->bind("loggedin");

$app->get("/logout", "App\Controller\UserCtr::logout")
        ->bind("logout");

$app->post("/login", "App\Controller\UserCtr::login")
        ->bind("login")
        ->before(App\Authorizations\Basic::getMustBeAnonymous($app));

$app->post("/register", "App\Controller\UserCtr::create")
        ->bind("registeruser")
        ->before(App\Authorizations\Basic::getMustBeAnonymous($app));

?>