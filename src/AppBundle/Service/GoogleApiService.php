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
   * @var string $analyticsId
   */
    private $analyticsId;

  /**
   * @param EntityManager $manager Get the entityManager.
   * @param string $clientAuthFile Get the GoogleApi AuthFile name.
   */
    public function __construct(EntityManager $manager, $clientAuthFile, $analyticsId)
    {
        $this->manager = $manager;
        $this->client = new \Google_Client();
        $this->client->setAuthConfigFile(__DIR__ . '/../../../' . $clientAuthFile);
        $this->client->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);

        if (!is_null($this->getGoogleApiToken())) {
            $this->client->setAccessToken($this->getGoogleApiToken()->getToken());
        }

        $this->analyticsId = $analyticsId;

    }

    public function getData()
    {
        $client = $this->client;
        $service = new \Google_Service_Analytics($client);
        $from = date('Y-m-d', time() - 2 * 24 * 60 * 60); // 2 days
        $to = date('Y-m-d'); // today
        $metrics = 'ga:visits,ga:pageviews,ga:bounces,ga:entranceBounceRate,ga:visitBounceRate,ga:avgTimeOnSite';
        $dimensions = 'ga:date,ga:year,ga:month,ga:day';

        // metrics
        $_params[] = 'date';
        $_params[] = 'date_year';
        $_params[] = 'date_month';
        $_params[] = 'date_day';
        // dimensions
        $_params[] = 'visits';
        $_params[] = 'pageviews';
        $_params[] = 'bounces';
        $_params[] = 'entrance_bounce_rate';
        $_params[] = 'visit_bounce_rate';
        $_params[] = 'avg_time_on_site';
    
        $data = $service->data_ga->get($this->analyticsId, $from, $to, $metrics, array('dimensions' => $dimensions));

        foreach ($data['rows'] as $row) {
            $dataRow = array();
            foreach ($_params as $colNr => $column) {
                echo $column . ': '.$row[$colNr].', ';
            }
        }
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
            'name' => 'Google Analytics Token',
            )
        );
    }

    public function getClient()
    {
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
