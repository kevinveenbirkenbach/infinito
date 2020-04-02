<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\LayerAttribut;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\Type\InvalidChoiceTypeException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class LayerAttributTest extends TestCase
{
    /**
     * @var LayerAttributInterface
     */
    protected $layerAttribut;

    public function setUp(): void
    {
        $this->layerAttribut = new class() implements LayerAttributInterface {
            use LayerAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->expectException(\TypeError::class);
        $this->layerAttribut->getLayer();
    }

    public function testAccessors(): void
    {
        foreach (LayerType::getValues() as $enum) {
            $this->assertNull($this->layerAttribut->setLayer($enum));
            $this->assertEquals($enum, $this->layerAttribut->getLayer());
        }
        $this->expectException(InvalidChoiceTypeException::class);
        $this->layerAttribut->setLayer('NoneValidLayer');
    }
}
