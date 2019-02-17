<?php

namespace Infinito\Domain\RepositoryManagement;

use Infinito\Repository\RepositoryInterface;

/**
 * Offers a fabric to produce entity repositories by layer.
 *
 * @author kevinfrantz
 */
interface LayerRepositoryFactoryServiceInterface
{
    /**
     * @param string $layer
     *
     * @return RepositoryInterface
     */
    public function getRepository(string $layer): RepositoryInterface;
}
