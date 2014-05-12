<?php

namespace App\BusinessLogic {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\EntityManager;
    use Symfony\Component\HttpFoundation\Session\Session;

    /**
    * 
    */
    class UsersLogic {
        
        protected $dataAccess;
        protected $em;

        public function __construct(EntityRepository $dataAccess, $entity, EntityManager $em, Session $session) {
            $this->dataAccess = $dataAccess;
            $this->entity = $entity;
            $this->session = $session;
            $this->em = $em;
        }

        public function isLogged() {
            return ($this->session->get("user")) ? $this->session->get("user") : 0;
        }

        public function login($data) {
            $user = $this->dataAccess->getByEmailAndPass($data["email"], $data["password"]);
            if($user) {
                $user["password"] = "";
                $this->session->set("user", json_encode($user));
            }
            return $user;
        }

        public function logout() {
            $this->session->invalidate();
            return json_encode(array("success" => 1));
        }

        public function create($data) {
            $user = $this->entity->create($data);
            $this->em->flush();
            return $user;
        }
    }

}
?>