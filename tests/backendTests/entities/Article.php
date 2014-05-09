<?php

use App\Entity\Article;
 
 /**
 * @backupGlobals disabled
 */
class ArticleTest extends \PHPUnit_Framework_TestCase
{
    public function setUp() {
        parent::setUp();
        global $app;
        $this->app = $app;
        $this->delete = array();
    }

    public function tearDown() {
        //remove all
        foreach ($this->delete as $entity) {
            $entity->remove();
        }
        $this->app["db.orm.em"]->flush();
    }

    ///TESTS

    public function testGetAndSet() {
        $article = Article::create();
        $article->set("title", array("title123"));
        $article->set("content", array("content123"));

        $this->assertEquals($article->getTitle(), "title123");        
        $this->assertEquals($article->getContent(), "content123");
        $this->assertEquals($article->getId(), null);
    }

    public function testFromArrayToArray() {
        $arr = array("title" => "A title", "content" => "A content");
        $article = Article::create($arr);

        $this->assertEquals($article->toArray(), array_merge(array("id" => null), $arr));
    }

    public function testSave() {
        $arr = array("title" => "title 123", "content" => "A content 1234");
        $article = Article::create($arr);
        $article->persist(); 
        $this->app["db.orm.em"]->flush();

        $this->assertNotEquals($article->getId(), null);

        $this->delete[] = $article;
    }

    /**
     * @expectedException Exception
     */
    public function testValidation() {
        $arr = array("title" => "", "content" => "A content 234");
        $article = Article::create($arr);

        $article->persist(); 

        $this->fail('Empty title validation is not working');   
    }
}


?>