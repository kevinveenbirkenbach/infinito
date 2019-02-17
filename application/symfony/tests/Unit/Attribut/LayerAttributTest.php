<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Attribut\LayerAttribut;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\NoValidChoiceException;

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
        foreach (LayerType::getChoices() as $enum) {
            $this->assertNull($this->layerAttribut->setLayer($enum));
            $this->assertEquals($enum, $this->layerAttribut->getLayer());
        }
        $this->expectException(NoValidChoiceException::class);
        $this->layerAttribut->setLayer('NoneValidLayer');
    }
}
