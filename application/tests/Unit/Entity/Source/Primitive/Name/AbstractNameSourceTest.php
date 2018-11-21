<?php

namespace tests\unit\Entity\Source\Primitive;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Primitive\Name\NameSourceInterface;
use App\Entity\Source\Primitive\Name\AbstractNameSource;

/**
 * @author kevinfrantz
 */
class AbstractNameSourceTest extends TestCase
{
    /**
     * @var NameSourceInterface
     */
    protected $nameSource;

    public function setUp(): void
    {
        $this->nameSource = new class() extends AbstractNameSource {
        };
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(NameSourceInterface::class, $this->nameSource);
        $this->expectException(\TypeError::class);
        $this->nameSource->getName();
    }

    public function testName(): void
    {
        $name = 'Hello World!';
        $this->nameSource->setName($name);
        $this->assertEquals($name, $this->nameSource->getName());
    }
}
