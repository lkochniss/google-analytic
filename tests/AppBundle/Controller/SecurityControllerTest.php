<?php

/**
 * @package Tests\AppBundle\Controller
 */
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SecurityControllerTest
 */
class SecurityControllerTest extends WebTestCase
{
    /**
     * Tests the login action within the SecurityController
     */
    public function testLoginAction()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('HTTPS' => 'on')
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
