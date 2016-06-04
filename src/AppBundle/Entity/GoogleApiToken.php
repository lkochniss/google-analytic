<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GoogleApiToken
 */
class GoogleApiToken extends AbstractModel
{
    /**
     * @var String
     */
    private $name;

    /**
     * @var String
     */
    private $token;

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
