<?php

namespace App\DataAccessLayer {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\Mapping\ClassMetadata;

    class UserRepository extends EntityRepository {

        public function __construct($em, ClassMetadata $class) {
            parent::__construct($em, $class);
            $class = $this->getClassName();
            $this->entity = new $class;
        }

        public function getByEmailAndPass($email, $pass) {
            $user = $this->findOneBy(array("email" => $email, "password" => $pass));
            return ($user != null) ? $user->toArray() : null;
        }

        public function create($data) {
            $user = $this->entity->create($data);
            $user->persist();
            return $user;
        }

    }

}

?>