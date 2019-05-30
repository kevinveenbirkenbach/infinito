<?php

namespace Infinito\Domain\Repository;

use Infinito\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\Layer\LayerClassMap;

/**
 * @author kevinfrantz
 */
final class LayerRepositoryFactoryService implements LayerRepositoryFactoryServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface::getRepository()
     */
    public function getRepository(string $layer): RepositoryInterface
    {
        $repositoryClassName = LayerClassMap::getClass($layer);

        return $this->entityManager->getRepository($repositoryClassName);
    }
}
