<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\PersonIdentitySourceAttribut;
use Infinito\Attribut\PersonIdentitySourceAttributInterface;
use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;
use PHPUnit\Framework\TestCase;

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
