<?php

namespace App\Entity {


    use \SerializableEntity;
    use \ActiveEntity;

    /**
     * @Table(name="users")
     * @Entity(repositoryClass="App\DataAccessLayer\UserRepository") 
     */
    class User extends Entity {

        use ActiveEntity;
        use SerializableEntity;

        /** 
         * @Id @Column(type="integer")
         * @GeneratedValue
         */
        private $id;

        /** @Column(type="text") */
        private $email;
     
        /** @Column(type="text") */
        private $password;
    }

}