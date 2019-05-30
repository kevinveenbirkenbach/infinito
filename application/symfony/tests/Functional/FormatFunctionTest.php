<?php

namespace Tests\Functional;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Infinito\Domain\Fixture\FixtureSource\HomepageFixtureSource;

/**
 * @author kevinfrantz
 */
class FormatFunctionTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $identity;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->identity = HomepageFixtureSource::getSlug();
    }

    public function testHomepage(): void
    {
        $this->client->request(Request::METHOD_GET, 'api/rest/source/'.$this->identity);
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
        $this->assertJson($this->client->getResponse()
            ->getContent());
    }

    public function testHomepageWithHTML(): void
    {
        $this->client->request(Request::METHOD_GET, 'api/rest/source/'.$this->identity.'.html');
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
        $this->assertContains('<html', $this->client->getResponse()
            ->getContent());
    }

    public function testHomepageWithJSON(): void
    {
        $this->client->request(Request::METHOD_GET, 'api/rest/source/'.$this->identity.'.json');
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
        $this->assertJson($this->client->getResponse()
            ->getContent());
    }

    public function testHomepageWithXML(): void
    {
        $this->client->request(Request::METHOD_GET, 'api/rest/source/'.$this->identity.'.xml');
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
        $content = $this->client->getResponse()->getContent();
        $xml = new \XMLReader();
        $xml->XML($content);
        $xml->setParserProperty(\XMLReader::VALIDATE, true);
        $this->assertTrue($xml->isValid());
    }
}
