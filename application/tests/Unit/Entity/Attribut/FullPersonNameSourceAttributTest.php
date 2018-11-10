<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Combination\FullPersonNameSourceInterface;
use App\Entity\Attribut\FullPersonNameSourceAttributInterface;
use App\Entity\Attribut\FullPersonNameSourceAttribut;

/**
 * @author kevinfrantz
 */
class FullPersonNameSourceAttributTest extends TestCase
{
    /**
     * @var FullPersonNameSourceAttributInterface
     */
    protected $fullname;

    public function setUp(): void
    {
        $this->fullname = new class() implements FullPersonNameSourceAttributInterface {
            use FullPersonNameSourceAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->fullname->getFullPersonNameSource();
    }

    public function testAccessors(): void
    {
        $fullname = $this->createMock(FullPersonNameSourceInterface::class);
        $this->assertNull($this->fullname->setFullPersonNameSource($fullname));
        $this->assertEquals($collection, $this->fullname->getFullPersonNameSource());
    }
}
