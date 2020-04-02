<?php

namespace tests\unit\Entity\Source\Complex;

use Infinito\Entity\Source\Complex\FullPersonNameSourceInterface;
use Infinito\Entity\Source\Complex\PersonIdentitySource;
use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;
use PHPUnit\Framework\TestCase;

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
