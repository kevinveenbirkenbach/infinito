<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\LayerRepositoryFactoryServiceAttributInterface;
use App\Attribut\LayerRepositoryFactoryServiceAttribut;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
class LayerRepositoryFactoryServiceAttributTest extends TestCase
{
    /**
     * @var LayerRepositoryFactoryServiceAttributInterface
     */
    protected $layerRepositoryFactoryServiceAttribut;

    public function setUp(): void
    {
        $this->layerRepositoryFactoryServiceAttribut = new class() implements LayerRepositoryFactoryServiceAttributInterface {
            use LayerRepositoryFactoryServiceAttribut;
        };
    }

    public function testConstruct(): void
    {
        $this->expectException(\TypeError::class);
        $this->layerRepositoryFactoryServiceAttribut->getLayerRepositoryFactoryService();
    }

    public function testAccessors(): void
    {
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $this->assertNull($this->layerRepositoryFactoryServiceAttribut->setLayerRepositoryFactoryService($layerRepositoryFactoryService));
        $this->assertEquals($layerRepositoryFactoryService, $this->layerRepositoryFactoryServiceAttribut->getLayerRepositoryFactoryService());
    }
}
