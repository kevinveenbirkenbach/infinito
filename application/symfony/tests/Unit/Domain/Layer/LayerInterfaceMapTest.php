<?php

namespace tests\Unit\Domain\Layer;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Layer\LayerInterfaceMap;

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
