<?php

/*
 * 
 */

namespace App\Controller {

    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;

    class Controller {

        public function err($errorMessage) {
            return array("status" => "error", "message" => $errorMessage);
        }

        public function json($data = array(), $status = 200, $headers = array())
        {
            return new JsonResponse($data, $status, $headers);
        }

        public function unauthorized() {
            return new Response("Unauthorized request", 403);
        }

    }

}
?>