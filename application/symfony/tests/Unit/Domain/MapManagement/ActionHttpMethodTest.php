<?php

namespace tests\Unit\Domain\MapManagement;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Domain\MapManagement\ActionHttpMethodMap;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ActionHttpMethodTest extends TestCase
{
    /**
     * @param array|string[] $subset
     * @param array          $haystack|string[]
     */
    private function assertSubsetInArray(array $subset, array $haystack, bool $expectedResult)
    {
        foreach ($subset as $value) {
            $this->assertEquals($expectedResult, in_array($value, $haystack));
        }
    }

    public function testCreateActionTrue(): void
    {
        $subset = [Request::METHOD_GET, Request::METHOD_POST];
        $action = ActionType::CREATE;
        $haystack = ActionHttpMethodMap::getHttpMethods($action);
        $this->assertSubsetInArray($subset, $haystack, true);
        $this->assertEquals(2, count($haystack));
    }

    public function testCreateActionFalse(): void
    {
        $subset = [Request::METHOD_GET, Request::METHOD_POST];
        $action = 'wrong value';
        $haystack = ActionHttpMethodMap::getHttpMethods($action);
        $this->assertSubsetInArray($subset, $haystack, false);
    }

    public function testPostMethodTrue(): void
    {
        $subset = [ActionType::READ];
        $httpMethod = Request::METHOD_GET;
        $haystack = ActionHttpMethodMap::getActions($httpMethod);
        $this->assertSubsetInArray($subset, $haystack, true);
    }

    public function testPostMethodFalse(): void
    {
        $subset = [ActionType::READ];
        $httpMethod = 'wrong value';
        $haystack = ActionHttpMethodMap::getActions($httpMethod);
        $this->assertSubsetInArray($subset, $haystack, false);
    }
}
