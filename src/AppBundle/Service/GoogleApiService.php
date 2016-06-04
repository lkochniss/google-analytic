<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\GoogleApiToken;
use AppBundle\Repository\GoogleApiTokenRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class GoogleApiService
 */
class GoogleApiService
{

    /** @var  EntityManager */
    private $manager;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Get the Google API Token
     *
     * @return null|GoogleApiToken
     *   Returns the token or null
     */
    public function getGoogleApiToken()
    {
        return $this->getGoogleApiTokenRepository()->findOneBy(
            array(
            'name' => 'Google Analytics Token'
            )
        );
    }

    /**
     * @return GoogleApiTokenRepository
     */
    public function getGoogleApiTokenRepository()
    {
        return $this->manager->getRepository('AppBundle:GoogleApiToken');
    }
}
