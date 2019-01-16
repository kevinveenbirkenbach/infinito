<?php

namespace App\Repository\Source;

use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\RequestedSourceInterface;
use App\Repository\AbstractRepository;

/**
 * @author kevinfrantz
 */
final class SourceRepository extends AbstractRepository implements SourceRepositoryInterface
{
    public function findOneBySlug(string $slug): ?SourceInterface
    {
        return $this->findOneBy([
            'slug' => $slug,
        ]);
    }

    public function findOneByIdOrSlug(RequestedSourceInterface $requestedSource): ?SourceInterface
    {
        if ($requestedSource->hasId()) {
            return $this->find($requestedSource->getId());
        }

        return $this->findOneBySlug($requestedSource->getSlug());
    }
}
