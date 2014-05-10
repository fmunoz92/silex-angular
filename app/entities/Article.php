<?php

namespace App\Entity {


use SerializableEntity;
use ActiveEntity;
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
        if(trim($this->getTitle()) == "" || $this->getTitle() == null) {
            throw new Exception("The title can not be empty");
        }
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function assertTitleLength() {
        if(strlen(trim($this->getTitle())) < 3) {
            throw new Exception("The title must have 3 chars at least");
        }
    }

}

}