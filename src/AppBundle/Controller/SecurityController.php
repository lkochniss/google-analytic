<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\PasswordResetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class SecurityController
 */
class SecurityController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render(
            ':Security:login.html.twig',
            array(
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            )
        );
    }
}
