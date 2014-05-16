<?php

use Silex\WebTestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

 class UsersControllerTest extends WebTestCase {

    protected $remove;

    public function createApplication()
    {
        global $app;
        return $app;
    }


    function setUp() {
        parent::setUp();
    }

    function tearDown() {
        parent::tearDown();
    }


    function userProvider() {
        return array(
            array(
                array("email"    => "prueba@prueba.com", 
                      "password" => "prueba"),
                array("Content-Type" => "application/json"),
            ),
        );
    }

    /**
     * @dataProvider userProvider
     */
    public function testCreate($user, $headers) {
        $client = $this->createClient();
        $client->request("POST", "/register", array(), array(), $headers, json_encode($user));
        $response = $client->getResponse();

        $this->assertTrue($response->isOk());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals($data["email"], "prueba@prueba.com");    
    }

}

?>