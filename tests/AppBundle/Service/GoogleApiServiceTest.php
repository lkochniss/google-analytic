<?php


namespace Tests\AppBundle\Service;

class GoogleApiServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsGoogleApiConnected()
    {
        $estimatedStatus = true;
        $client = new \Google_Client();
        var_dump($client->getAuth());

    }
}
