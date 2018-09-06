<?php
namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

/**
 *
 * @author kevinfrantz
 *        
 */
class UserTest extends TestCase
{
    const PASSWORD = '12345678';
    
    const USERNAME = 'tester';
    
    /**
     * 
     * @var User
     */
    protected $user;
    
    public function setUp():void{
        $this->user = new User();
        $this->user->setPassword(self::PASSWORD);
        $this->user->setUsername(' '.self::USERNAME.' ');
    }
    
    public function testUsername():void{
        $this->assertEquals(self::USERNAME,$this->user->getUsername());
    }
    
    public function testPassword():void{
        $this->assertEquals(self::PASSWORD,$this->user->getPassword());
    }
}

