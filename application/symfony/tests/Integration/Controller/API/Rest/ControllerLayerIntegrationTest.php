<?php

namespace tests\Integration\Controller\API\Rest;

use PHPUnit\Framework\TestCase;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
class ControllerLayerIntegrationTest extends TestCase
{
    public function testThatControllerForEachLayerExist(): void
    {
        foreach (LayerType::getChoices() as $layer) {
            $className = 'Infinito\\Controller\\API\\Rest\\'.ucfirst($layer).'Controller';
            $this->assertTrue(class_exists($className));
        }
    }
}
