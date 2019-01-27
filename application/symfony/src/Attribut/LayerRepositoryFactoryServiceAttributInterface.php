<?php

namespace App\Attribut;

use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
interface LayerRepositoryFactoryServiceAttributInterface
{
    /**
     * @param LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService
     */
    public function setLayerRepositoryFactoryService(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService): void;

    /**
     * @return LayerRepositoryFactoryServiceInterface
     */
    public function getLayerRepositoryFactoryService(): LayerRepositoryFactoryServiceInterface;
}
