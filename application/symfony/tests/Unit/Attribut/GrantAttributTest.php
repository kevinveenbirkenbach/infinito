<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\GrantAttribut;
use Infinito\Attribut\GrantAttributInterface;
use PHPUnit\Framework\TestCase;

class GrantAttributTest extends TestCase
{
    /**
     * @var GrantAttributInterface
     */
    protected $grant;

    public function setUp(): void
    {
        $this->grant = new class() implements GrantAttributInterface {
            use GrantAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->expectException(\TypeError::class);
        $this->grant->getGrant();
    }

    public function testAccessors(): void
    {
        $grant = true;
        $this->assertNull($this->grant->setGrant($grant));
        $this->assertEquals($grant, $this->grant->getGrant());
    }
}
