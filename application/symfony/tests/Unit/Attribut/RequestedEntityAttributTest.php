<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\RequestedEntityAttribut;
use Infinito\Attribut\RequestedEntityAttributInterface;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class RequestedEntityAttributTest extends TestCase
{
    /**
     * @var RequestedEntityAttributInterface
     */
    protected $requestedEntityAttribut;

    public function setUp(): void
    {
        $this->requestedEntityAttribut = new class() implements RequestedEntityAttributInterface {
            use RequestedEntityAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->requestedEntityAttribut->getRequestedEntity();
    }

    public function testAccessors(): void
    {
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $this->assertNull($this->requestedEntityAttribut->setRequestedEntity($requestedEntity));
        $this->assertEquals($requestedEntity, $this->requestedEntityAttribut->getRequestedEntity());
    }
}
