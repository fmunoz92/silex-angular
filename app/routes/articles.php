<?php

$protectedRoutes = $app["controllers_factory"];


$app->post("/articles", "articles.controller:create")
        ->bind("createarticle")
        ->before(App\REST\Basic::mustBeValidJSON($app))
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->get("/articles", "articles.controller:index")
        ->bind("articles")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->get("/articles/{id}", "articles.controller:show")
        ->bind("showarticle")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->delete("/articles/{id}", "articles.controller:destroy")
        ->bind("destroyarticle")
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));

$app->put("/articles/{id}", "articles.controller:update")
        ->bind("updatearticle")
        ->before(App\REST\Basic::mustBeValidJSON($app))
        ->before(App\Authorizations\Basic::getMustBeLoggedIn($app));


?>
