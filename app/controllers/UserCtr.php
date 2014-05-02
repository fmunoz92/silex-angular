<?php

namespace App\Controller {

	use Symfony\Component\HttpFoundation\Response;
	use Silex\Application;

	class UserCtr extends BaseController {

		function loggedin(Application $app) {
			$logged = $app["user_manager"]->isLogged();
			return $app->json($logged);
		}

		function logout(Application $app) {
			$response = $app["user_manager"]->logout();
			return $app->json($response);
		}

		function login(Application $app) {
			$data = $app["request"]->get("body");
			$user = $app["user_manager"]->login($data);
			if($user) {
				return $app->json($user);
			}
			else {
				return new Response("Failed Login", 403);
			}
		}

		function create(Application $app) {
			$data = $app["request"]->get("body");
			$user = $app["user_manager"]->create($data);
			return $app->json($user);
		}
	}
}

?>