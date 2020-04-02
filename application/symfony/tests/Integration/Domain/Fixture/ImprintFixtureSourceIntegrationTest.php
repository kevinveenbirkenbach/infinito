<?php

namespace tests\Integration\Domain\Fixture;

use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class ImprintFixtureSourceIntegrationTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testImprintSourceReachable(): void
    {
        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => 'api/rest/source/'.ImpressumFixtureSource::getSlug().'.html',
        ]);
        $request->setMethod(Request::METHOD_GET);
        $response = static::$kernel->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
