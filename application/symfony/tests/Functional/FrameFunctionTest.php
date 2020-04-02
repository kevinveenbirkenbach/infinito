<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class FrameFunctionTest extends WebTestCase
{
    public function testHomepageWithFrame(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<html', $client->getResponse()->getContent());
    }

    public function testHomepageFrameWithoutParameter(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $this->assertContains('<html', $content);
    }

    public function testHomepageFrameless(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=0');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $this->assertNotContains('<html', $content);
    }

    public function testIncorrectParameterValue(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=true');
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}
