<?php

namespace Infinito\Repository\Source;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Repository\RepositoryInterface;

/**
 * @author kevinfrantz
 */
interface SourceRepositoryInterface extends RepositoryInterface
{
    /**
     * Finds an Entity by slug.
     *
     * @param string $slug
     *
     * @return SourceInterface|null
     */
    public function findOneBySlug(string $slug): ?SourceInterface;

    /**
     * Loads a source by id or if not defined, by slug.
     *
     * @param RequestedEntityInterface $requestedSource
     *
     * @return SourceInterface|null
     */
    public function findOneByIdOrSlug(RequestedEntityInterface $requestedSource): ?SourceInterface;
}
