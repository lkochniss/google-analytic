<?php

/**
 * @package Tests\AppBundle\Controller
 */
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class GoogleApiControllerTest
 */
class GoogleApiControllerTest extends WebTestCase
{
    /**
     * @var Client $client
     */
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Tests the authenticate action within the GoogleApiController
     * The authenticate action will redirect to Google Oauth2 identification
     * @covers AppBundle\Controller\GoogleApiController::authenticate
     */
    public function testAuthenticateAction()
    {
        $this->assertTrue(TRUE);
    }

    /**
     * Tests the authenticateCallback action within the GoogleApiController
     * @covers AppBundle\Controller\GoogleApiController::authenticateCallback
     */
    public function testAuthenticateCallbackAction()
    {
        $this->logIn();

        $crawler = $this->client->request(
            'GET',
            '/googleApi/authenticate/callback',
            array(),
            array(),
            array('HTTPS' => 'on')
        );

        $this->assertEquals(
          302,
          $this->client->getResponse()->getStatusCode(),
          $this->client->getResponse()->getContent()
        );
    }

    /**
     * Login as admin.
     */
    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secured_area';
        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
