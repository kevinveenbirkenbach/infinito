<?php

namespace tests\Unit\Domain\TwigManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\TwigManagement\LayerIconClassMap;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\Collection\NotSetElementException;

/**
 * @author kevinfrantz
 */
class LayerIconClassMapTest extends TestCase
{
    public function testException(): void
    {
        $this->expectException(NotSetElementException::class);
        $this->assertIsString(LayerIconClassMap::getIconClass('123123V'));
    }

    public function testAllLayersSet(): void
    {
        foreach (LayerType::getValues() as $value) {
            $this->assertIsString(LayerIconClassMap::getIconClass($value));
        }
    }
}
