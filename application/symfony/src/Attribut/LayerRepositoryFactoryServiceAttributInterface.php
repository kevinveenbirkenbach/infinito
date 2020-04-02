<?php

namespace Infinito\Attribut;

use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
interface LayerRepositoryFactoryServiceAttributInterface
{
    public function setLayerRepositoryFactoryService(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService): void;

    public function getLayerRepositoryFactoryService(): LayerRepositoryFactoryServiceInterface;
}
