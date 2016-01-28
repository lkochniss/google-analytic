<?php
/**
 * @package AppBundle\Controller
 */
namespace AppBundle\Controller;

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
        $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setRedirectUri($this->generateUrl('google_api_authenticate_callback'));

        return $this->redirect($client->createAuthUrl());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticateCallbackAction(Request $request)
    {

        return $this->render(
            ':googleApi:authenticate_callback.html.twig',
            array(
               'code' => $request->query->get('code')
            )
        );
    }
}
