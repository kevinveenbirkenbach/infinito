<?php

namespace tests\unit\Entity\Source\Complex;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;
use Infinito\Entity\Source\Complex\PersonIdentitySource;
use Infinito\Entity\Source\Complex\FullPersonNameSourceInterface;

class PersonIdentitySourceTest extends TestCase
{
    /**
     * @var PersonIdentitySourceInterface
     */
    protected $identity;

    public function setUp(): void
    {
        $this->identity = new PersonIdentitySource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(FullPersonNameSourceInterface::class, $this->identity->getFullPersonNameSource());
    }

    public function testFullName(): void
    {
        $name = $this->createMock(FullPersonNameSourceInterface::class);
        $this->assertNull($this->identity->setFullPersonNameSource($name));
        $this->assertEquals($name, $this->identity->getFullPersonNameSource());
    }
}
