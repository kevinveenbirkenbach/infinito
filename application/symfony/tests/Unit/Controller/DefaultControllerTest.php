<?php

namespace Infinito\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Infinito\Controller\DefaultController;
use Infinito\DBAL\Types\RESTResponseType;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;

/**
 * @author kevinfrantz
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * @var DefaultController
     */
    protected $defaultController;

    public function setUp(): void
    {
        $this->defaultController = new DefaultController();
    }

    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(302, $client->getResponse()
            ->getStatusCode());
    }

    public function testImprint(): void
    {
        $client = static::createClient();
        foreach (RESTResponseType::getValues() as $format) {
            $format = 'html';
            $url = '/api/rest/source/'.ImpressumFixtureSource::getSlug().'.'.$format;
            $client->request('GET', $url);
            $this->assertEquals(200, $client->getResponse()
                ->getStatusCode(), "Route $url is not reachable.");
        }
    }
}
