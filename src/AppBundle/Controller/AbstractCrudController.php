<?php
/**
 * @package AppBundle\Controller
 */
namespace AppBundle\Controller;

use AppBundle\Entity\GoogleApiToken;
use AppBundle\Repository\GoogleApiTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AbstractCrudController
 */
abstract class AbstractCrudController extends Controller
{
    /**
     * Get the Google API Token
     *
     * @return null|GoogleApiToken
     *   Returns the token or null
     */
    protected function getGoogleApiToken() {
        return $this->getGoogleApiTokenRepository()->findOneBy(
          array(
            'name' => 'Google Analytics Token'
          )
        );
    }

    /**
     * @return GoogleApiTokenRepository
     */
    protected function getGoogleApiTokenRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:GoogleApiToken');
    }
}
