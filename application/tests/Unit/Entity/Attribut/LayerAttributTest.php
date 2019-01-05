<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\LayerAttributInterface;
use App\Entity\Attribut\LayerAttribut;
use App\DBAL\Types\Meta\Right\LayerType;

class LayerAttributTest extends TestCase
{
    /**
     * @var LayerAttributInterface
     */
    protected $layer;

    public function setUp(): void
    {
        $this->layer = new class() implements LayerAttributInterface {
            use LayerAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->expectException(\TypeError::class);
        $this->layer->getLayer();
    }

    public function testAccessors(): void
    {
        foreach ([
            LayerType::LAW,
            LayerType::RELATION,
            LayerType::SOURCE,
        ] as $value) {
            $this->assertNull($this->layer->setLayer($value));
            $this->assertEquals($value, $this->layer->getLayer());
        }
    }
}
