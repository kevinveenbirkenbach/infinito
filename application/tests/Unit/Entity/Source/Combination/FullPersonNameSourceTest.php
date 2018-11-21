<?php

namespace tests\unit\Entity\Source\Combination;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Combination\FullPersonNameSourceInterface;
use App\Entity\Source\Combination\FullPersonNameSource;
use App\Entity\Source\Primitive\Name\SurnameSourceInterface;
use App\Entity\Source\Primitive\Name\FirstNameSourceInterface;

class FullPersonNameSourceTest extends TestCase
{
    /**
     * @var FullPersonNameSourceInterface
     */
    protected $name;

    public function setUp(): void
    {
        $this->name = new FullPersonNameSource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(SurnameSourceInterface::class, $this->name->getSurnameSource());
        $this->assertInstanceOf(FirstNameSourceInterface::class, $this->name->getFirstNameSource());
    }

    public function testFirstNameAccessor(): void
    {
        $name = $this->createMock(FirstNameSourceInterface::class);
        $this->assertNull($this->name->setFirstNameSource($name));
        $this->assertEquals($name, $this->name->getFirstNameSource());
    }

    public function testSurnameAccessor(): void
    {
        $name = $this->createMock(SurnameSourceInterface::class);
        $this->assertNull($this->name->setSurnameSource($name));
        $this->assertEquals($name, $this->name->getSurnameSource());
    }
}
