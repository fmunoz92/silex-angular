<?php

//Articles
$app["article_repository"] = function($app) {
    return $app["db.orm.em"]->getRepository("App\Entity\Article");
};

$app["article_manager"] = function($app) {
    return new App\BusinessLogic\ArticlesLogic($app["article_repository"], $app["db.orm.em"]);
};

//Users
$app["user_repository"] = function($app) {
    return $app["db.orm.em"]->getRepository("App\Entity\User");
};

$app["user_manager"] = function($app) {
    return new App\BusinessLogic\UsersLogic($app["user_repository"], $app["db.orm.em"], $app["session"]);
};

?>