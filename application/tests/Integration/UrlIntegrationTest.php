<?php

namespace Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class UrlIntegrationTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    /**
     * Tests urls which are in general reachable.
     */
    public function testParameterlesGetRoutes200(): void
    {
        foreach (['/login', '/imprint'] as $url) {
            $this->parameterlesGetRouteTest($url, 200);
        }
    }

    public function testParameterlesGetRoutes302(): void
    {
        foreach (['/logout'] as $url) {
            $this->parameterlesGetRouteTest($url, 302);
        }
    }

    private function parameterlesGetRouteTest(string $url, int $status)
    {
        $request = new Request([], [], [], [], [], ['REQUEST_URI' => $url, null]);
        $request->setMethod(Request::METHOD_GET);
        $response = static::$kernel->handle($request);
        $this->assertEquals($status, $response->getStatusCode());
    }
}
