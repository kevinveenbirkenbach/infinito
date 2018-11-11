<?php

namespace tests\unit\Entity\Source\Data;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Data\PersonIdentitySourceInterface;
use App\Entity\Source\Data\PersonIdentitySource;
use App\Entity\Source\Combination\FullPersonNameSourceInterface;

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
        $this->assertInstanceOf(FullPersonNameSourceInterface::class, $this->identity->getName());
    }

    public function testFullName(): void
    {
        $name = $this->createMock(FullPersonNameSourceInterface::class);
        $this->assertNull($this->identity->setName($name));
        $this->assertEquals($name, $this->identity->getName());
    }
}
