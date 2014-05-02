<?php

/*
 * 
 */

namespace App\Controller {


class BaseController {

    /**
     * retourne un tableau contenant l'erreur
     * @param type $errorMessage
     * @return array
     */
    function err($errorMessage) {
        return array("status" => "error", "message" => $errorMessage);
    }

    function ok() {
        return array("status" => "ok");
    }

}

}
?>
