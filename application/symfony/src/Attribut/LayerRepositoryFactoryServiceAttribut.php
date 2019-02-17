<?php

namespace Infinito\Attribut;

use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

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

    /**
     * @param LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService
     */
    public function setLayerRepositoryFactoryService(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService): void
    {
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
    }

    /**
     * @return LayerRepositoryFactoryServiceInterface
     */
    public function getLayerRepositoryFactoryService(): LayerRepositoryFactoryServiceInterface
    {
        return $this->layerRepositoryFactoryService;
    }
}
