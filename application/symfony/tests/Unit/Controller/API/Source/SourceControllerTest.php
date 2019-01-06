<?php

namespace tests\Unit\Controller\API\Source;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class SourceControllerTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    /**
     * @todo Optimize test!
     */
    public function testCreate(): void
    {
        $url = '/en/api/source.json';
        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => $url,
        ]);
        $request->setMethod(Request::METHOD_GET);
        $response = static::$kernel->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
