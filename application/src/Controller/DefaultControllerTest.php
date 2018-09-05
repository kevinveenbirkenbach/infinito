<?php
namespace App\Controller;

use PHPUnit\Framework\TestCase;

/**
 *
 * @author kevinfrantz
 *        
 */
class DefaultControllerTest extends TestCase
{
    protected $defaultController;
    
    public function setUp():void{
        $this->defaultController = new DefaultController();    
    }
    
    public function testHomepage():void{
        $this->assertEquals(true, $this->defaultController->homepage()->isSuccessful());
    }
    
    public function testImprint():void{
        $this->assertEquals(true, $this->defaultController->imprint()->isSuccessful());
    }
}

