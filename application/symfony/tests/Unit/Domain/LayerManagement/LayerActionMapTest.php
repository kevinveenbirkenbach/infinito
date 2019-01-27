<?php

namespace tests\Unit\Domain\LayerManagement;

use PHPUnit\Framework\TestCase;
use App\DBAL\Types\ActionType;
use App\Domain\LayerManagement\LayerActionMap;
use App\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
class LayerActionMapTest extends TestCase
{
    public function testGetLayersBySource(): void
    {
        foreach (ActionType::getChoices() as $action) {
            $layers = LayerActionMap::getLayers($action);
            $this->assertArraySubset([LayerType::SOURCE], $layers);
        }
    }

    public function testGetActionsBySource(): void
    {
        $actions = LayerActionMap::getActions(LayerType::SOURCE);
        foreach (ActionType::getChoices() as $action) {
            $this->assertTrue(in_array($action, $actions));
        }
    }

    public function testEmptyGetActionsBySource(): void
    {
        $this->assertEquals(0, count(LayerActionMap::getActions('blablabla')));
    }
}
