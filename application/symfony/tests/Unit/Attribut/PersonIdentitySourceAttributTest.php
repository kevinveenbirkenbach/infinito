<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\PersonIdentitySourceAttributInterface;
use App\Attribut\PersonIdentitySourceAttribut;
use App\Entity\Source\Complex\PersonIdentitySourceInterface;

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
        $this->identity->getPersonIdentitySource();
    }

    public function testAccessors(): void
    {
        $identity = $this->createMock(PersonIdentitySourceInterface::class);
        $this->assertNull($this->identity->setPersonIdentitySource($identity));
        $this->assertEquals($identity, $this->identity->getPersonIdentitySource());
    }
}
