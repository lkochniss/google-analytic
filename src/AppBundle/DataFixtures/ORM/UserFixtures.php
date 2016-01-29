<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/users';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveUser($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveUser(ObjectManager $manager, $path, $count)
    {
        $userData = json_decode(file_get_contents($path), true);

        $user = new User();
        $user->setUsername($userData['username']);
        $user->setEmail($userData['email']);

        $user->setIsActive($userData['isActive']);

        $plainPassword = $userData['password'];

        $encoder = $this->container->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($user,$plainPassword);

        $user->setPassword($encodedPassword);

        $this->addReference('user-'.$user->getUsername(), $user);

        foreach ($userData['roles'] as $role) {
            $user->addRole($this->getReference('role-'.$role));
        }

        $manager->getRepository('AppBundle:User')->save($user,$this->getReference('user-Admin'));
    }

    /**
     * @param ContainerInterface|null $containerInterface
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
