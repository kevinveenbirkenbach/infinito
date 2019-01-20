<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\FirstNameSourceAttribut;
use App\Attribut\FirstNameSourceAttributInterface;
use App\Entity\Source\Primitive\Name\FirstNameSourceInterface;

/**
 * @author kevinfrantz
 */
class FirstNameSourceAttributTest extends TestCase
{
    /**
     * @var FirstNameSourceAttributInterface
     */
    protected $name;

    public function setUp(): void
    {
        $this->name = new class() implements FirstNameSourceAttributInterface {
            use FirstNameSourceAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->name->getFirstNameSource();
    }

    public function testAccessors(): void
    {
        $name = $this->createMock(FirstNameSourceInterface::class);
        $this->assertNull($this->name->setFirstNameSource($name));
        $this->assertEquals($name, $this->name->getFirstNameSource());
    }
}
