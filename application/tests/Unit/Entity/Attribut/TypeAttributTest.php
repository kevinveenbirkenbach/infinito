<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\TypeAttribut;

/**
 * @author kevinfrantz
 */
class TypeAttributTest extends TestCase
{
    /**
     * @var TypeAttributInterface
     */
    protected $typeAttribut;

    public function setUp(): void
    {
        $this->typeAttribut = new class() implements TypeAttributInterface {
            use TypeAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->typeAttribut->getType();
    }

    public function testAccessors(): void
    {
        $type = 'Hello World!';
        $this->assertNull($this->typeAttribut->setType($type));
        $this->assertEquals($type, $this->typeAttribut->getType());
    }
}
