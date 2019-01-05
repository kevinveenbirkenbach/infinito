<?php

namespace Tests\Integration\Controller\API;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\BrowserKit\Request;
use App\DBAL\Types\LanguageType;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\RESTResponseType;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests for success etc.
 */
class ApiUrlReachableIntegrationTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testAllAPIRoutePossibilities()
    {
        foreach (LayerType::getChoices() as $layer => $layerDescription) {
            $this->controller($layer);
        }
    }

    private function controller(string $entity)
    {
        $this->language($entity, 'POST');
        $this->language($entity.'s', 'GET');
        $this->slugAndId($entity, 'PUT');
        $this->slugAndId($entity, 'GET');
        $this->slugAndId($entity, 'DELETE');
    }

    private function slugAndId(string $route, string $method): void
    {
        $this->language("$route/12345", 'PUT');
        $this->language("$route/asdfg", 'PUT');
    }

    private function language(string $entity, string $method): void
    {
        $this->type('api/'.$entity, $method);
        foreach (LanguageType::getChoices() as $key => $value) {
            $this->type("api/$key/$entity", $method);
        }
    }

    private function type(string $route, string $method): void
    {
        $this->routeAssert($route, $method);
        foreach (RESTResponseType::getChoices() as $restResponseType => $value) {
            $this->routeAssert("$route.$restResponseType", $method);
        }
    }

    private function routeAssert(string $url, int $method): void
    {
        $request = new Request([], $method, [], [], [], [
            'REQUEST_URI' => $url,
            null,
        ]);
        $request->setMethod(Request::METHOD_GET);
        $response = static::$kernel->handle($request);
        $this->assertNotEquals(404, $response->getStatusCode());
    }
}
