<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\Role;

/**
 * Class UserTest
 * @package AppBundle\Tests\Controller
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $user = new User();

        $username = 'Username';
        $user->setUsername($username);
        $this->assertEquals($user->getUsername(), $username);

        $password = '1234';
        $user->setPassword($password);
        $this->assertEquals($user->getPassword(), $password);

        $email = 'user@abc.com';
        $user->setEmail($email);
        $this->assertEquals($user->getEmail(), $email);

        $active = 1;
        $user->setActive($active);
        $this->assertEquals($user->isActive(), $active);

        $now = new \DateTime();
        $user->setValidUntil($now);
        $this->assertEquals($user->getValidUntil(), $now);

        $user->setCreatedAt();
        $this->assertNotEmpty($user->getCreatedAt());

        $user->setModifiedAt();
        $this->assertNotEmpty($user->getModifiedAt());

        $role = $this->getMock(Role::class);

        $user->addRole($role);
        $this->assertEquals($user->getRoles(), array($role));

        $user->removeRole($role);
        $this->assertEquals($user->getRoles(), array());

        return null;
    }
}
