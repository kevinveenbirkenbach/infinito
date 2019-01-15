<?php

namespace App\Repository\Source;

use Doctrine\ORM\EntityRepository;
use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\RequestedSourceInterface;

/**
 * @author kevinfrantz
 */
final class SourceRepository extends EntityRepository implements SourceRepositoryInterface
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
