<?php
/**
 * @package AppBundle\Controller
 */
namespace AppBundle\Controller;

use AppBundle\Entity\GoogleApiToken;
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
        $client = $this->getGoogleApiService()->getClient();
        $client->setRedirectUri(
            ('https://' . $request->getHost() . $this->generateUrl('google_api_authenticate_callback'))
        );

        return $this->redirect($client->createAuthUrl());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticateCallbackAction(Request $request)
    {
        if (!$request->query->has('code')) {

            return $this->redirectToRoute('app');
        }
        /**
         * @var GoogleApiToken $token
         */
        $token = $this->getGoogleApiService()->getGoogleApiToken();

        if (is_null($token)) {
            $token = new GoogleApiToken();
            $token->setName('Google Analytics Token');
        }

        $client = $this->getGoogleApiService()->getClient();
        $client->setRedirectUri(
          ('https://' . $request->getHost() . $this->generateUrl('google_api_authenticate_callback'))
        );
        $client->authenticate($request->query->get('code'));

        $token->setToken($client->getAccessToken());
        $this->getGoogleApiService()->getGoogleApiTokenRepository()->save($token);

        return $this->redirectToRoute('app');
    }

    private function getGoogleApiService()
    {
        return $this->get('app.googleapi.service');
    }
}
