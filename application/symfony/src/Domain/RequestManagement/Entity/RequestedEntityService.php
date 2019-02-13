<?php

namespace App\Domain\RequestManagement\Entity;

use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
final class RequestedEntityService extends RequestedEntity implements RequestedEntityServiceInterface
{
    /**
     * @param LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService
     */
    public function __construct(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService = null)
    {
        parent::__construct($layerRepositoryFactoryService);
    }
}
