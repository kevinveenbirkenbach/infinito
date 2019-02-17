<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\RequestAttributInterface;
use Infinito\Attribut\RequestAttribut;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class RequestAttributTest extends TestCase
{
    /**
     * @var RequestAttributInterface
     */
    protected $requestAttribut;

    public function setUp(): void
    {
        $this->requestAttribut = new class() implements RequestAttributInterface {
            use RequestAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->expectException(\TypeError::class);
        $this->requestAttribut->getRequest();
    }

    public function testAccessors(): void
    {
        $request = $this->createMock(Request::class);
        $this->assertNull($this->requestAttribut->setRequest($request));
        $this->assertEquals($request, $this->requestAttribut->getRequest());
    }
}
