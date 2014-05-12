<?php

//Articles
$app["articles.entity"] = function($app) {
    return new App\Entity\Article();
};

$app["articles.repository"] = function($app) {
    return $app["db.orm.em"]->getRepository("App\Entity\Article");
};

$app["articles.manager"] = function($app) {
    return new App\BusinessLogic\ArticlesLogic($app["articles.repository"], $app["articles.entity"], $app["db.orm.em"]);
};

$app['articles.controller'] = function($app)  {
    return new App\Controller\ArticlesCtr($app['articles.manager']);
};

?>