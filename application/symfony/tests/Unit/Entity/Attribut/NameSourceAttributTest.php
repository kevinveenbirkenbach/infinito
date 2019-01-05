<?php

namespace tests\unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\NameSourceAttributInterface;
use App\Entity\Attribut\NameSourceAttribut;
use App\Entity\Source\Primitive\Name\NameSourceInterface;

class NameSourceAttributTest extends TestCase
{
    /**
     * @var NameSourceAttributInterface
     */
    protected $name;

    public function setUp(): void
    {
        $this->name = new class() implements NameSourceAttributInterface {
            use NameSourceAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->name->getNameSource();
    }

    public function testAccessors(): void
    {
        $nameSource = $this->createMock(NameSourceInterface::class);
        $this->assertNull($this->name->setNameSource($nameSource));
        $this->assertEquals($nameSource, $this->name->getNameSource());
    }
}
