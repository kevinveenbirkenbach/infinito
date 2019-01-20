<?php

namespace App\Domain\CRUDManagement;

use App\Repository\RepositoryInterface;
use App\Entity\EntityInterface;

/**
 * Offers a fabric for entity repositories.
 *
 * @author kevinfrantz
 */
interface RepositoryFactoryServiceInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return RepositoryInterface The repositoy of the interface
     */
    public function getRepository(EntityInterface $entity): RepositoryInterface;
}
