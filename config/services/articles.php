<?php

//Articles
$app["articles.repository"] = function($app) {
    return $app["db.orm.em"]->getRepository("App\Entity\Article");
};

$app["articles.manager"] = function($app) {
    return new App\BusinessLogic\ArticlesLogic($app["articles.repository"], $app["db.orm.em"]);
};

$app['articles.controller'] = function($app)  {
    return new App\Controller\ArticlesCtr($app['articles.manager']);
};

?>