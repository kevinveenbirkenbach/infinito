<?php

namespace tests\Unit\Domain\Layer;

use Infinito\Domain\Layer\LayerInterfaceMap;
use PHPUnit\Framework\TestCase;

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
