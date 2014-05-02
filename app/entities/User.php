<?php

namespace App\Entity {


use App\SerializableEntity;
use App\ActiveEntity;

/**
 * @Table(name="users")
 * @Entity(repositoryClass="App\DataAccessLayer\UserRepository") 
 */
class User {

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