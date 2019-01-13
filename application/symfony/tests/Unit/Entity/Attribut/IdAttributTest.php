<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\IdAttributInterface;

/**
 * @author kevinfrantz
 */
class IdAttributTest extends TestCase
{
    /**
     * @var IdAttributInterface
     */
    protected $id;

    public function setUp(): void
    {
        $this->id = new class() implements IdAttributInterface {
            use IdAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->assertFalse($this->id->hasId());
        $this->expectException(\TypeError::class);
        $this->id->getId();
    }

    public function testAccessors(): void
    {
        $id = 1234;
        $this->assertNull($this->id->setId($id));
        $this->assertEquals($id, $this->id->getId());
        $this->assertTrue($this->id->hasId());
        $this->assertNull($this->id->setId(0));
        $this->assertTrue($this->id->hasId());
    }
}
