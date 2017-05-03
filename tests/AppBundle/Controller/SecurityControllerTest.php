<?php

/**
 * @package Tests\AppBundle\Controller
 */
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class SecurityControllerTest
 */
class SecurityControllerTest extends WebTestCase
{
    /**
     * Tests the login action within the SecurityController
     * @covers AppBundle\Controller\SecurityController::login
     */
    public function testLoginAction()
    {
        /**
         * @var Client $client
         */
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('HTTPS' => 'on')
        );

        $this->assertEquals(
          200,
          $client->getResponse()->getStatusCode(),
          $client->getResponse()->getContent()
        );
    }
}
