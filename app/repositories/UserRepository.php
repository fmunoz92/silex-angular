<?php

namespace App\DataAccessLayer {

    use Doctrine\ORM\EntityRepository;
    use App\Entity\Article;

    class UserRepository extends EntityRepository {

        public function getByEmailAndPass($email, $pass) {
            $user = $this->findOneBy(array("email" => $email, "password" => $pass));
            return ($user != null) ? $user->toArray() : null;
        }

        public function create($data) {
            $user = User::create($data);
            $user->persist();
            return $user;
        }

    }

}

?>