<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\CrudAttributInterface;
use App\Entity\Attribut\CrudAttribut;

/**
 * @author kevinfrantz
 */
class CrudAttributTest extends TestCase
{
    /**
     * @var CrudAttributInterface
     */
    protected $typeAttribut;

    public function setUp(): void
    {
        $this->typeAttribut = new class() implements CrudAttributInterface {
            use CrudAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->typeAttribut->getCrud();
    }

    public function testAccessors(): void
    {
        $type = 'Hello World!';
        $this->assertNull($this->typeAttribut->setCrud($type));
        $this->assertEquals($type, $this->typeAttribut->getCrud());
    }
}
