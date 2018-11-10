<?php

namespace tests\unit\Entity\Source\Data;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Data\IdentityInterface;
use App\Entity\Source\Data\IdentitySource;
use App\Entity\Source\Data\FullPersonNameSourceInterface;

class IdentitySourceTest extends TestCase
{
    /**
     * @var IdentityInterface
     */
    protected $identity;

    public function setUp(): void
    {
        $this->identity = new IdentitySource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(FullPersonNameSourceInterface::class, $this->identity->getName());
    }

    public function testName(): void
    {
        $name = $this->createMock(FullPersonNameSourceInterface::class);
        $this->assertNull($this->identity->setName($name));
        $this->assertEquals($name, $this->identity->getName());
    }
}
