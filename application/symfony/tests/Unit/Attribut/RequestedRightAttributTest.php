<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Attribut\RequestedRightAttributInterface;
use App\Attribut\RequestedRightAttribut;

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
