<?php

namespace App\Controller {

	use Silex\Application;

	class IndexCtr extends BaseController {

		function index(Application $app) {
			return $app["twig"]->render("index.twig");
		}

	}
}

?>