<?php

namespace App\BusinessLogic {

	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\EntityManager;

	/**
	* 
	*/
	class UsersLogic {
		
		protected $dataAccess;

		public function __construct(EntityRepository $dataAccess, EntityManager $em, $session) {
			$this->dataAccess = $dataAccess;
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
			$user = $this->dataAccess->create($data);
			$this->flush();
			return $user;
		}
	}

}
?>