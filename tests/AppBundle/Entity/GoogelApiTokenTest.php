<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\GoogleApiToken;

/**
 * Class RoleTest
 */
class GoogleApiTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     * @covers AppBundle\Entity\GoogleApiToken
     */
    public function testEntity()
    {
        $token = new GoogleApiToken();

        $name = 'Token 1';
        $token->setName($name);
        $this->assertEquals($token->getName(), $name);

        $apiToken = 'a_token_from_google';
        $token->setToken($apiToken);
        $this->assertEquals($token->getToken(), $apiToken);

        return null;
    }
}
