<?php

namespace Infinito\Repository\Source;

use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Repository\RepositoryInterface;

/**
 * @author kevinfrantz
 */
interface SourceRepositoryInterface extends RepositoryInterface
{
    /**
     * Finds an Entity by slug.
     */
    public function findOneBySlug(string $slug): ?SourceInterface;

    /**
     * Loads a source by id or if not defined, by slug.
     */
    public function findOneByIdOrSlug(RequestedEntityInterface $requestedSource): ?SourceInterface;
}
