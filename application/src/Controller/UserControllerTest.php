<?php
namespace App\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\UserController;
use App\Controller\UserControllerInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
class UserControllerTest extends TestCase
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
        $this->assertEquals(true, $this->userController->logout()->isSuccessful());
    }
    
    public function testLogin(): void
    {
        $this->assertEquals(true, $this->userController->login()->isSuccessful());
    }
    
    public function testRegister():void
    {
        $this->assertEquals(true, $this->userController->register()->isSuccessful());
    }
}

