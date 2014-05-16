<?php

namespace App\Authorizations {

    class Basic {

        public static function getMustBeLoggedIn($app) {
            return function() use ($app) {
                if (!$app["session"]->get("user")) {
                    $app["session"]->invalidate();
                    return $app->abort("401", 'Unauthorized user');
                }
            };
        }

        public static function getMustBeAnonymous($app) {
            return function() use ($app) {
                if ($app["session"]->get("user")) {
                    return $app->abort("401", 'Unauthorized');
                }
            };
        }
    }
}
?>