<?php
/**
 * @package AppBundle\Controller
 */
namespace AppBundle\Controller;

use AppBundle\Entity\GoogleApiToken;
use AppBundle\Repository\GoogleApiTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GoogleApiController
 */
class GoogleApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticateAction(Request $request)
    {
        $client = new \Google_Client();
        $client->setClientId($this->getParameter('client_id'));
        $client->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);
        $client->setRedirectUri(
            ('https://'.$request->getHost() . $this->generateUrl('google_api_authenticate_callback'))
        );

        return $this->redirect($client->createAuthUrl());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticateCallbackAction(Request $request)
    {
        /**
         * @var GoogleApiToken $token
         */
        $token = $this->getGoogleApiTokenRepository()->findOneBy(
            array(
            'name' => 'Google Analytics Token'
            )
        );

        if (is_null($token)) {
            $token = new GoogleApiToken();
            $token->setName('Google Analytics Token');
        }

        $token->setToken($request->query->get('code'));
        $this->getGoogleApiTokenRepository()->save($token);

        return $this->redirectToRoute('app');
    }

    /**
     * @return GoogleApiTokenRepository
     */
    private function getGoogleApiTokenRepository() 
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:GoogleApiToken');
    }
}
