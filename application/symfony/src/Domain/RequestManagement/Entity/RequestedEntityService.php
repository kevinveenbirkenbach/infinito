<?php

namespace Infinito\Domain\RequestManagement\Entity;

use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedEntityService extends LazyRequestedEntity implements RequestedEntityServiceInterface
{
    /**
     * @param LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService
     */
    public function __construct(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService = null)
    {
        parent::__construct($layerRepositoryFactoryService);
    }
}
