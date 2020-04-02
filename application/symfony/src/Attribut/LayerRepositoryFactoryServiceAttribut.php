<?php

namespace Infinito\Attribut;

use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 *
 * @see LayerRepositoryFactoryServiceAttributInterface
 */
trait LayerRepositoryFactoryServiceAttribut
{
    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    protected $layerRepositoryFactoryService;

    public function setLayerRepositoryFactoryService(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService): void
    {
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
    }

    public function getLayerRepositoryFactoryService(): LayerRepositoryFactoryServiceInterface
    {
        return $this->layerRepositoryFactoryService;
    }
}
