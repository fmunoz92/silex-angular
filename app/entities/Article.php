<?php

namespace App\Entity {


use App\SerializableEntity;
use App\ActiveEntity;
use Exception;

/**
 * @Table(name="articles")
 * @Entity(repositoryClass="App\DataAccessLayer\ArticleRepository") 
 * @HasLifecycleCallbacks
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

    /**
     * @PrePersist @PreUpdate
     */
    public function assertTitleNotEmpty() {
        if($this->getTitle() == "" || $this->getTitle() == null) {
            throw new Exception("The title can not be empty");
        }
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function assertTitleLength() {
        if(strlen($this->getTitle()) > 10) {
            throw new Exception("The title must have 10 chars at least");
        }
    }

}

}