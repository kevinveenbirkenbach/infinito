<?php

namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Meta\Law;
use App\Entity\Meta\Relation;
use App\Entity\Source\UserSource;

/**
 * @author kevinfrantz
use App\Entity\Source\UserSource;
 */
class UserTest extends TestCase
{
    const PASSWORD = '12345678';

    const USERNAME = 'tester';

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testUsername(): void
    {
        $this->user->setUsername(self::USERNAME);
        $this->assertEquals(self::USERNAME, $this->user->getUsername());
    }

    public function testPassword(): void
    {
        $this->user->setPassword(self::PASSWORD);
        $this->assertEquals(self::PASSWORD, $this->user->getPassword());
    }

    public function testSource(): void
    {
        $this->assertInstanceOf(UserSource::class, $this->user->getSource());
    }

    public function testNode(): void
    {
        $this->assertInstanceOf(Relation::class, $this->user->getSource()->getNode());
    }

    public function testLaw(): void
    {
        $this->assertInstanceOf(Law::class, $this->user->getSource()->getNode()->getLaw());
    }
}
