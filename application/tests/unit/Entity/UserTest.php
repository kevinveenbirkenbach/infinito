<?php

namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Source\UserSource;
use App\Entity\UserInterface;

/**
 * @author kevinfrantz
use App\Entity\Source\UserSource;
 */
class UserTest extends TestCase
{
    const PASSWORD = '12345678';

    const USERNAME = 'tester';

    /**
     * @var UserInterface
     */
    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
        $this->user->setUsername(self::USERNAME);
        $this->user->setPassword(self::PASSWORD);
        
    }
    
    public function testConstructor():void{
        $this->assertInstanceOf(UserInterface::class, new User());
    }

    public function testUsername(): void
    {
        $this->assertEquals(self::USERNAME, $this->user->getUsername());
    }

    public function testPassword(): void
    {
        $this->assertEquals(self::PASSWORD, $this->user->getPassword());
    }

    public function testSource(): void
    {
        $this->assertInstanceOf(UserSource::class, $this->user->getSource());
    }
}
