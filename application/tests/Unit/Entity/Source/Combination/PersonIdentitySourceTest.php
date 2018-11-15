<?php

namespace tests\unit\Entity\Source\Combination;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Combination\PersonIdentitySourceInterface;
use App\Entity\Source\Combination\PersonIdentitySource;
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
        $this->assertInstanceOf(FullPersonNameSourceInterface::class, $this->identity->getFullPersonNameSource());
    }

    public function testFullName(): void
    {
        $name = $this->createMock(FullPersonNameSourceInterface::class);
        $this->assertNull($this->identity->setFullPersonNameSource($name));
        $this->assertEquals($name, $this->identity->getFullPersonNameSource());
    }
}
