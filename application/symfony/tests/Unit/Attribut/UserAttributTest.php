<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\UserAttributInterface;
use App\Attribut\UserAttribut;
use App\Entity\UserInterface;

/**
 * @author kevinfrantz
 */
class UserAttributTest extends TestCase
{
    /**
     * @var UserAttributInterface
     */
    public $user;

    public function setUp(): void
    {
        $this->user = new class() implements UserAttributInterface {
            use UserAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->assertFalse($this->user->hasUser());
        $this->expectException(\TypeError::class);
        $this->user->getUser();
    }

    public function testAccessors(): void
    {
        $user = $this->createMock(UserInterface::class);
        $this->assertNull($this->user->setUser($user));
        $this->assertEquals($user, $this->user->getUser());
        $this->assertTrue($this->user->hasUser());
    }
}
