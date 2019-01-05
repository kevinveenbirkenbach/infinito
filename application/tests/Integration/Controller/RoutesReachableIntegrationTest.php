<?php

namespace Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DBAL\Types\LanguageType;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\RESTResponseType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests for success etc.
 */
class RoutesReachableIntegrationTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testAllRoutePossibilities()
    {
        foreach (LayerType::getChoices() as $layer => $layerDescription) {
            $this->controller($layer);
        }
    }

    private function controller(string $entity)
    {
        $this->language($entity, Request::METHOD_GET);
        $this->language($entity, Request::METHOD_POST);
        $this->language($entity.'s', Request::METHOD_GET);
        $this->slugAndId($entity, Request::METHOD_PUT);
        $this->slugAndId($entity, Request::METHOD_GET);
        $this->slugAndId($entity, Request::METHOD_DELETE);
    }

    private function slugAndId(string $route, string $method): void
    {
        $this->language("$route/12345", $method);
        $this->language("$route/asdfg", $method);
    }

    /**
     * @todo Implement routing without i18l part!
     *
     * @param string $entity
     * @param string $method
     */
    private function language(string $entity, string $method): void
    {
        //$this->type('api/'.$entity, $method);
        foreach (LanguageType::getChoices() as $language) {
            $this->type("$language/api/$entity", $method);
            $this->type("$language/html/$entity", $method);
        }
    }

    private function type(string $route, string $method): void
    {
        $this->routeAssert($route, $method);
        foreach (RESTResponseType::getChoices() as $restResponseType => $value) {
            $this->routeAssert("$route.$restResponseType", $method);
        }
    }

    private function routeAssert(string $url, string $method): void
    {
        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => $url,
        ]);
        $request->setMethod($method);
        $response = static::$kernel->handle($request);
        $this->assertNotEquals(404, $response->getStatusCode(), "Route $url with Method $method sends an 404 response!");
    }
}
