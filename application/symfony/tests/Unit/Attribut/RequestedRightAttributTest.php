<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Attribut\RequestedRightAttributInterface;
use Infinito\Attribut\RequestedRightAttribut;

/**
 * @author kevinfrantz
 */
class RequestedRightAttributTest extends TestCase
{
    /**
     * @var RequestedRightAttributInterface
     */
    protected $requestedRightAttribut;

    public function setUp(): void
    {
        $this->requestedRightAttribut = new class() implements RequestedRightAttributInterface {
            use RequestedRightAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->requestedRightAttribut->getRequestedRight();
    }

    public function testAccessors(): void
    {
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $this->assertNull($this->requestedRightAttribut->setRequestedRight($requestedRight));
        $this->assertEquals($requestedRight, $this->requestedRightAttribut->getRequestedRight());
    }
}
