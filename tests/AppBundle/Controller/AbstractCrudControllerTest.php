<?php

/**
 * @package Tests\AppBundle\Controller
 */
namespace Tests\AppBundle\Controller;

use AppBundle\Controller\AbstractCrudController;
use AppBundle\Entity\GoogleApiToken;
use AppBundle\Repository\GoogleApiTokenRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractCrudControllerTest
 */
class AbstractCrudControllerTest extends WebTestCase
{
    /**
     * Check if the GoogleApiToken or null is returned
     * @covers AppBundle\Controller\AbstractCrudController:getGoogleApiToken
     */
    public function testGetGoogleApiToken() {
        $tokenMock = $this->getMockBuilder(GoogleApiToken::class)->getMock();
        $mock = $this->getMockBuilder(AbstractCrudController::class)->getMock();
        $mock->expects($this->once())
          ->method('getGoogleApiToken')
          ->willReturn($tokenMock);

        $this->assertEquals($mock->method('getGoogleApiToken'), $tokenMock);

        $mock->expects($this->once())
          ->method('getGoogleApiToken')
          ->willReturn(null);

        $this->assertEquals($mock->method('getGoogleApiToken'), null);
    }
    /**
     * Check if the GoogleApiTokenRepository is returned
     * @covers AppBundle\Controller\AbstractCrudController:getGoogleApiTokenRepository
     */
    public function testGetGoogleApiTokenRepository() {
        $tokenRepositoryMock = $this->getMockBuilder(GoogleApiTokenRepository::class)
          ->disableOriginalConstructor()
          ->getMock();
        $mock = $this->getMockBuilder(AbstractCrudController::class)->getMock();
        $mock->expects($this->once())
          ->method('getGoogleApiTokenRepository')
          ->willReturn($tokenRepositoryMock);

        $this->assertEquals($mock->method('getGoogleApiTokenRepository'), $tokenRepositoryMock);
    }
}
