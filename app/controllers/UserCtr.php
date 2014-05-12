<?php

namespace App\Controller {

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use App\BusinessLogic\UsersLogic;


    class UserCtr extends BaseController {


        public function __construct(UsersLogic $manager)
        {
            $this->manager = $manager;
        }

        function loggedin(Request $req) {
            $logged = $this->manager->isLogged();
            return $this->json($logged);
        }

        function logout(Request $req) {
            $response = $this->manager->logout();
            return $this->json($response);
        }

        function login(Request $req) {
            $data = $req->get("body");
            $user = $this->manager->login($data);
            if($user) {
                return $this->json($user);
            }
            else {
                return $this->unauthorized();
            }
        }

        function create(Request $req) {
            $data = $req->get("body");
            $user = $this->manager->create($data);
            return $this->json($user);
        }
    }
}

?>