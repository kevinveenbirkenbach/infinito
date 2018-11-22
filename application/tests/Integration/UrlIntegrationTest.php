<?php

namespace Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class UrlIntegrationTest extends KernelTestCase
{
    const GET_URLS_STATUS = [
        'login' => 200,
        'imprint' => 200,
        'register' => 301,
        'logout' => 302,
    ];

    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testParameterlesGetUrls(): void
    {
        foreach (self::GET_URLS_STATUS as $url => $status) {
            $this->parameterlesGetRouteTest($url, $status);
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
