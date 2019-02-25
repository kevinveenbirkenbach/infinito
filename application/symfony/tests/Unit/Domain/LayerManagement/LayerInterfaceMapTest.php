<?php

namespace tests\Unit\Domain\LayerManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\LayerManagement\LayerInterfaceMap;

/**
 * @author kevinfrantz
 */
class LayerInterfaceMapTest extends TestCase
{
    public function testIfInterfaceForEachLayerExist(): void
    {
        foreach (LayerInterfaceMap::getAllInterfaces() as $interface) {
            $this->assertTrue(interface_exists($interface));
        }
    }
}
