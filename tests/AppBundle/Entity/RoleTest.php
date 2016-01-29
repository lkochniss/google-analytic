<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Role;
use AppBundle\Entity\User;

/**
 * Class RoleTest
 * @package AppBundle\Tests\Controller
 */
class RoleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $role = new Role();

        $name = 'Role 1';
        $role->setName($name);
        $this->assertEquals($role->getName(), $name);

        $roleName = 'ROLE_ADMIN';
        $role->setRole($roleName);
        $this->assertEquals($role->getRole(), $roleName);

        $user = $this->getMock(User::class);

        $role->addUser($user);
        $this->assertEquals($role->getUsers(), array($user));

        $role->removeUser($user);
        $this->assertEquals($role->getUsers(), array());

        return null;
    }
}
