<?php

/**
 * @package Tests\AppBundle\Controller
 */
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class GoogleApiControllerTest
 */
class GoogleApiControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Tests the authenticate action within the GoogleApiController
     * The authenticate action will redirect to Google Oauth2 identification
     */
    public function testAuthenticateAction()
    {
        $this->logIn();

        $crawler = $this->client->request('GET',
            '/googleApi/authenticate',
            array(),
            array(),
            array('HTTPS' => 'on')
        );

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Tests the authenticateCallback action within the GoogleApiController
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

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
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
