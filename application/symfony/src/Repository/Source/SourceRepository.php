<?php

namespace Infinito\Repository\Source;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Repository\AbstractRepository;

/**
 * @author kevinfrantz
 */
final class SourceRepository extends AbstractRepository implements SourceRepositoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Repository\Source\SourceRepositoryInterface::findOneBySlug()
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
     * @see \Infinito\Repository\Source\SourceRepositoryInterface::findOneByIdOrSlug()
     */
    public function findOneByIdOrSlug(RequestedEntityInterface $requestedSource): ?SourceInterface
    {
        if ($requestedSource->hasId()) {
            return $this->find($requestedSource->getId());
        }

        return $this->findOneBySlug($requestedSource->getSlug());
    }
}
