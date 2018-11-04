<?php

namespace tests\unit\Entity\Source\Data;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Data\NameSourceInterface;
use App\Entity\Source\Data\NameSource;

/**
 * @author kevinfrantz
 */
class NameSourceTest extends TestCase
{
    /**
     * @var NameSourceInterface
     */
    protected $nameSource;

    public function setUp(): void
    {
        $this->nameSource = new NameSource();
    }

    public function testConstructor():void{
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
