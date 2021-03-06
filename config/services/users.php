<?php

//Users
$app["users.entity"] = function($app) {
    return new App\Entity\User();
};

$app["users.repository"] = function($app) {
    return $app["db.orm.em"]->getRepository("App\Entity\User");
};

$app["users.manager"] = function($app) {
    return new App\BusinessLogic\UsersLogic($app["users.repository"], $app["users.entity"], $app["db.orm.em"], $app["session"]);
};

$app['users.controller'] = function($app) {
    return new App\Controller\UserCtr($app['users.manager']);
};

?>