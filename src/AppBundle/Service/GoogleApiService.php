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
     * @var \Google_Client $client
     */
    private $client;

    /**
     * @param EntityManager $manager Get the entityManager.
     * @param string $clientAuthFile Get the GoogleApi AuthFile name.
     */
    public function __construct(EntityManager $manager, $clientAuthFile)
    {
        $this->manager = $manager;
        $this->client =  new \Google_Client();
        $this->client->setAuthConfigFile(__DIR__ . '/../../../' .$clientAuthFile);
        $this->client->addScope(\Google_Service_Analytics::ANALYTICS_PROVISION);

        if(!is_null($this->getGoogleApiToken())){
          $token['access_token'] = $this->getGoogleApiToken()->getToken();
          $token['refresh_token'] = $this->getGoogleApiToken()->getToken();
          $this->client->setAccessToken(json_encode($token));
        }

    }

    public function getData() {
        $client = $this->client;
        $service = new \Google_Service_Analytics($client);
        $properties = $service->management_webproperties->listManagementWebproperties("~all");
        var_dump($properties);
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

    public function getClient() {
        return $this->client;
    }

    /**
     * @return GoogleApiTokenRepository
     */
    public function getGoogleApiTokenRepository()
    {
        return $this->manager->getRepository('AppBundle:GoogleApiToken');
    }
}
