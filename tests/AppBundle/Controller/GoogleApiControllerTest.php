<?php


namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GoogleApiControllerTest extends WebTestCase
{
    /**
     * Tests the authenticate action within the GoogleApiController
     */
    public function testAuthenticateAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/googleApi/authenticate');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Tests the authenticateCallback action within the GoogleApiController
     */
    public function testAuthenticateCallbackAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/googleApi/authenticate/callback');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
