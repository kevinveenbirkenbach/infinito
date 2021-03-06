<?php

namespace tests\Unit\Domain\Twig;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Twig\LayerIconClassMap;
use Infinito\Exception\Collection\NotSetElementException;
use PHPUnit\Framework\TestCase;

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
