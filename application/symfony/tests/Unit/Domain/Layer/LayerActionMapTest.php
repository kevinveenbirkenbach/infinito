<?php

namespace tests\Unit\Domain\Layer;

use PHPUnit\Framework\TestCase;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Layer\LayerActionMap;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
class LayerActionMapTest extends TestCase
{
    public function testGetLayersBySource(): void
    {
        foreach (ActionType::getValues() as $action) {
            $layers = LayerActionMap::getLayers($action);
            $this->assertArraySubset([LayerType::SOURCE], $layers);
        }
    }

    public function testGetActionsBySource(): void
    {
        $actions = LayerActionMap::getActions(LayerType::SOURCE);
        foreach (ActionType::getValues() as $action) {
            $this->assertTrue(in_array($action, $actions));
        }
    }

    public function testEmptyGetActionsBySource(): void
    {
        $this->assertEquals(0, count(LayerActionMap::getActions('blablabla')));
    }
}
