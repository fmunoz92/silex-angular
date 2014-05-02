<?php

$protectedRoutes = $app["controllers_factory"];


$app->post("/articles", "App\Controller\ArticlesCtr::create")
        ->bind("createarticle")
        ->before(App\REST\Basic::mustBeValidJSON($app))
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->get("/articles", "App\Controller\ArticlesCtr::index")
        ->bind("articles")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->get("/articles/{id}", "App\Controller\ArticlesCtr::show")
        ->bind("showarticle")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->delete("/articles/{id}", "App\Controller\ArticlesCtr::destroy")
        ->bind("destroyarticle")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->put("/articles/{id}", "App\Controller\ArticlesCtr::update")
        ->bind("updatearticle")
        ->before(App\REST\Basic::mustBeValidJSON($app))
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));


?>
