<?php
/**
 * @package AppBundle\Controller
 */
namespace AppBundle\Controller;

use AppBundle\Entity\GoogleApiToken;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GoogleApiController
 */
class GoogleApiController extends AbstractCrudController
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
        $token = $this->getGoogleApiToken();

        if (is_null($token)) {
            $token = new GoogleApiToken();
            $token->setName('Google Analytics Token');
        }

        $token->setToken($request->query->get('code'));
        $this->getGoogleApiTokenRepository()->save($token);

        return $this->redirectToRoute('app');
    }
}
