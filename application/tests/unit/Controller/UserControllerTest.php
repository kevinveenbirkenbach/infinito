<?php
namespace App\Tests\Unit\Controller;

use App\Controller\UserController;
use App\Controller\UserControllerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 *
 * @author kevinfrantz
 *        
 */
class UserControllerTest extends WebTestCase
{
    /**
     * 
     * @var UserControllerInterface
     */
    protected $userController;
    
    public function setUp():void{
        $this->userController = new UserController();
    }
    
    public function testLogout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user/logout');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testRegister():void
    {
        $client = static::createClient();
        $client->request('GET', '/user/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

