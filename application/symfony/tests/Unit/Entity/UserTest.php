<?php

namespace tests\unit\Entity;

use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Entity\User;
use Infinito\Entity\UserInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
use Infinito\Entity\Source\UserSource;
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

    public function testConstructor(): void
    {
        $this->assertInstanceOf(UserInterface::class, new User());
        $this->assertEquals(0, $this->user->getVersion());
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
        $this->assertEquals($this->user, $this->user->getSource()->getUser());
    }
}
