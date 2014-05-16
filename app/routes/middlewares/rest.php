<?php

namespace App\REST {

    use Symfony\Component\HttpFoundation\Request;

    class Basic {

        public static function mustBeValidJSON($app) {
            return function(Request $request) use ($app) {
                $data = json_decode($request->getContent(), true);
                if (!isset($data)) {
                    $app["logger"]->err("must be valid json : " . $request->getContent());
                    return $app->abort("403");
                }
            };
        }


    }
}
?>