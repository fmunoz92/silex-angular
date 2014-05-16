<?php

namespace App\Controller {

    use Silex\Application;

    class IndexCtr extends Controller {

        function index(Application $app) {
            return $app["twig"]->render("index.twig");
        }

    }
}

?>