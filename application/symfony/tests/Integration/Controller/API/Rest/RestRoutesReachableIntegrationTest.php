<?php

namespace Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\RESTResponseType;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Domain\LayerManagement\LayerActionMap;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\MapManagement\ActionHttpMethodMap;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests for success etc.
 */
class RestRoutesReachableIntegrationTest extends KernelTestCase
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

    public function testAllRoutePossibilities(): void
    {
        foreach ([
            '12314123',
            'testslug',
        ] as $uri) {
            foreach (RESTResponseType::getChoices() as $format) {
                foreach (LayerType::getChoices() as $layer) {
                    $actions = LayerActionMap::getActions($layer);
                    foreach ($actions as $action) {
                        foreach (ActionHttpMethodMap::getHttpMethods($action) as $method) {
                            $baseUrl = "api/rest/$layer";
                            switch ($action) {
                                case ActionType::CREATE:
                                    $url = "$baseUrl.$format";
                                    $this->routeAssert($url, $method);
                                    break;
                                case ActionType::EXECUTE:
                                    $url = "$baseUrl/$uri/action/execute.$format";
                                    $this->routeAssert($url, $method);
                                    break;
                                default:
                                    $url = "$baseUrl/$uri.$format";
                                    $this->routeAssert($url, $method);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param string $url
     * @param string $method
     */
    private function routeAssert(string $url, string $method): void
    {
        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => $url,
        ]);
        $request->setMethod($method);
        $response = static::$kernel->handle($request);
        $this->assertTrue($this->isResponseValid($response), "Route $url with Method $method sends an 404 response and doesn't throw an EntityNotFoundHttpException!");
    }

    /**
     * @param Response $response
     *
     * @return bool
     */
    private function isResponseValid(Response $response): bool
    {
        $is404 = 404 === $response->getStatusCode();
        $isEntityNotFoundHttpException = strpos($response->getContent(), 'EntityNotFoundHttpException');

        return !$is404 || $isEntityNotFoundHttpException;
    }
}
