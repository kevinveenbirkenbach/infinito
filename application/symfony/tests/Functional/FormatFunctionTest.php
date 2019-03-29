<?php

namespace Tests\Functional;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author kevinfrantz
 */
class FormatFunctionTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<html', $client->getResponse()->getContent());
    }

    public function testHomepageWithHTML(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<html', $client->getResponse()->getContent());
    }

    public function testHomepageWithJSON(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.json');
        echo $client->getResponse()->getContent();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//         $this->assertContains('<html', $client->getResponse()->getContent());
    }

    public function testHomepageWithXML(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.xml');
        echo $client->getResponse()->getContent();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //         $this->assertContains('<html', $client->getResponse()->getContent());
    }
}
