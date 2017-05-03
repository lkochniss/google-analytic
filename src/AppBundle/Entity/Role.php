<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Role
 */
class Role implements RoleInterface, \Serializable
{
    /**
     * @var Integer
     */
    private $id;

    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $role;

    /**
     * @var ArrayCollection
     */
    private $users;

    /**
     * set empty user array
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name Set name.
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $role Set role.
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param User $user Add user to array.
     * @return $this
     */
    public function addUser(User $user)
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    /**
     * @param User $user Remove user from array.
     * @return $this
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users->toArray();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize(
            array(
                $this->id,
                $this->role,
            )
        );
    }

    /**
     * @param string $serialized Unserialize id and role.
     * @return $this
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->role
            ) = \unserialize($serialized);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
