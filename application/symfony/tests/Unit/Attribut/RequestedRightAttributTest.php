<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\RequestedRightAttribut;
use Infinito\Attribut\RequestedRightAttributInterface;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use PHPUnit\Framework\TestCase;

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
