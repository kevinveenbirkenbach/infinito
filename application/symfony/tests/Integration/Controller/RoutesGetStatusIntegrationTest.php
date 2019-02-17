<?php

namespace Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class RoutesGetStatusIntegrationTest extends KernelTestCase
{
    const GET_URLS_STATUS = [
        'login' => 200,
        'register' => 301,
        'logout' => 302,
        'profile/edit' => 302,
        'spa' => 302,
    ];

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
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

    /**
     * @param string $url
     * @param int    $status
     */
    private function parameterlesGetRouteTest(string $url, int $status): void
    {
        $request = new Request([], [], [], [], [], ['REQUEST_URI' => $url, null]);
        $request->setMethod(Request::METHOD_GET);
        $response = static::$kernel->handle($request);
        $this->assertEquals($status, $response->getStatusCode(), "Url <<$url>> with status <<$status>> is not reachable.");
    }
}
