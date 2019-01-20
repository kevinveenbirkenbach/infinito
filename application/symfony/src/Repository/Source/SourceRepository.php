<?php

namespace App\Repository\Source;

use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Repository\AbstractRepository;

/**
 * @author kevinfrantz
 */
final class SourceRepository extends AbstractRepository implements SourceRepositoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Repository\Source\SourceRepositoryInterface::findOneBySlug()
     */
    public function findOneBySlug(string $slug): ?SourceInterface
    {
        return $this->findOneBy([
            'slug' => $slug,
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Repository\Source\SourceRepositoryInterface::findOneByIdOrSlug()
     */
    public function findOneByIdOrSlug(RequestedEntityInterface $requestedSource): ?SourceInterface
    {
        if ($requestedSource->hasId()) {
            return $this->find($requestedSource->getId());
        }

        return $this->findOneBySlug($requestedSource->getSlug());
    }
}
