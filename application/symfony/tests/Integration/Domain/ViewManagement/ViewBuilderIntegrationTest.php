<?php
namespace Tests\Integration\Domain\ViewManagement;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * 
 * @author kevinfrantz
 *
 */
class ViewBuilderIntegrationTest extends WebTestCase
{   
    public  function testHomepageFrameless(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=0');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $xml = @simplexml_load_string($client->getResponse()->getContent());
        $this->assertFalse($xml);
    }
    

    public  function testHomepageFrameWithoutParameter(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $xml = @simplexml_load_string($content);
        $this->assertTrue($xml,"The content <<\n$content\n>> is no valid xml!");
    }
    
//     /**
//      * @param string $url
//      * @param int    $status
//      */
//     public  function testHomepageFrameless(): void
//     {
//         $client = static::createClient();
//         $crawler = $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=');
//         $this->assertEquals(200, $client->getResponse()->getStatusCode());
//         $this->assertEquals(1,$crawler->filter('html')->count());
//     }
    
//     /**
//      * @param string $url
//      * @param int    $status
//      */
//     public  function testHomepageExplizitNoFrame(): void
//     {
//         $client = static::createClient();
//         $crawler = $client->request(Request::METHOD_GET, 'api/rest/source/HOMEPAGE.html?frame=0');
//         $this->assertEquals(200, $client->getResponse()->getStatusCode());
//         $this->assertEquals(1,$crawler->filter('html')->count());
//     }
}

