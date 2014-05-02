<?php

namespace App\Entity {


use App\SerializableEntity;
use App\ActiveEntity;

/**
 * @Table(name="articles")
 * @Entity(repositoryClass="App\DataAccessLayer\ArticleRepository") 
 */
class Article {

	use ActiveEntity;
	use SerializableEntity;

    /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="text") */
    private $title;
 
    /** @Column(type="text") */
    private $content;
}

}