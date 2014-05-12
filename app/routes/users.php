<?php

$app->get("/loggedin", "users.controller:loggedin")
        ->bind("loggedin");

$app->get("/logout", "users.controller:logout")
        ->bind("logout");

$app->post("/login", "users.controller:login")
        ->bind("login")
        ->before(App\Authorizations\Basic::getMustBeAnonymous($app));

$app->post("/register", "users.controller:create")
        ->bind("registeruser")
        ->before(App\Authorizations\Basic::getMustBeAnonymous($app));

?>