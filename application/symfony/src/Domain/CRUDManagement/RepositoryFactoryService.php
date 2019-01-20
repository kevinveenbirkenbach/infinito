<?php

namespace App\Domain\CRUDManagement;

use App\Entity\EntityInterface;
use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 */
final class RepositoryFactoryService implements RepositoryFactoryServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    private function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\CRUDManagement\RepositoryFactoryInterface::getRepository()
     */
    public function getRepository(EntityInterface $entity): RepositoryInterface
    {
        $this->entityManager->getRepository(get_class($entity));
    }
}
