<?php

namespace App\Repository\Source;

use Doctrine\ORM\EntityRepository;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\RequestedSourceInterface;

final class SourceRepository extends EntityRepository
{
    /**
     * @param string $slug
     *
     * @return SourceInterface|null
     */
    public function findOneBySlug(string $slug): ?SourceInterface
    {
        return $this->findOneBy([
            'slug' => $slug,
        ]);
    }

    /**
     * Loads a source by id or if not defined, by slug.
     *
     * @param RequestedSourceInterface $requestedSource
     *
     * @return SourceInterface|null
     */
    public function findOneByIdOrSlug(RequestedSourceInterface $requestedSource): ?SourceInterface
    {
        try {
            return $this->find($requestedSource->getId());
        } catch (\Error $error) {
            return $this->findOneBySlug($requestedSource->getSlug());
        }
    }
}
