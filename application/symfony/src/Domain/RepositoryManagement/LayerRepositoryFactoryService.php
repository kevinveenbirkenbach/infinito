<?php

namespace App\Domain\RepositoryManagement;

use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Exception\NotSetException;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
final class LayerRepositoryFactoryService implements LayerRepositoryFactoryServiceInterface
{
    const LAYER_CLASS_MAP = [
        LayerType::SOURCE => AbstractSource::class,
    ];

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param string $layer
     *
     * @throws NotSetException
     *
     * @return string
     */
    private function getRepositoryClassName(string $layer): string
    {
        $map = self::LAYER_CLASS_MAP;
        if (array_key_exists($layer, $map)) {
            return $map[$layer];
        }
        throw new NotSetException('The requested layer is not mapped!');
    }

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $layer
     *
     * @return RepositoryInterface
     */
    public function getRepository(string $layer): RepositoryInterface
    {
        $repositoryClassName = $this->getRepositoryClassName($layer);

        return $this->entityManager->getRepository($repositoryClassName);
    }
}
