<?php

namespace App\DataAccessLayer {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Mapping\ClassMetadata;

    class UserRepository extends EntityRepository {

        public function getByEmailAndPass($email, $pass) {
            $user = $this->findOneBy(array("email" => $email, "password" => $pass));
            return ($user != null) ? $user->toArray() : null;
        }

    }

}

?>