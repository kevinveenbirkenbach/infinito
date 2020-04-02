<?php

namespace Infinito\Domain\Repository;

use Infinito\Repository\RepositoryInterface;

/**
 * Offers a fabric to produce entity repositories by layer.
 *
 * @author kevinfrantz
 */
interface LayerRepositoryFactoryServiceInterface
{
    public function getRepository(string $layer): RepositoryInterface;
}
