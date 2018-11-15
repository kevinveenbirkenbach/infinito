<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\PersonIdentitySourceAttributInterface;
use App\Entity\Attribut\PersonIdentitySourceAttribut;
use App\Entity\Source\Data\PersonIdentitySourceInterface;

/**
 * @todo Implement abstract test class for entity attributs
 *
 * @author kevinfrantz
 */
class PersonIdentitySourceAttributTest extends TestCase
{
    /**
     * @var PersonIdentitySourceAttributInterface
     */
    protected $identity;

    public function setUp(): void
    {
        $this->identity = new class() implements PersonIdentitySourceAttributInterface {
            use PersonIdentitySourceAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->identity->getIdentitySource();
    }

    public function testAccessors(): void
    {
        $identity = $this->createMock(PersonIdentitySourceInterface::class);
        $this->assertNull($this->identity->setIdentitySource($identity));
        $this->assertEquals($collection, $this->identity->getIdentitySource());
    }
}
