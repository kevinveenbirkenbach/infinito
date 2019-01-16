<?php

namespace App\Repository\Source;

use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\RequestedSourceInterface;
use App\Repository\RepositoryInterface;

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
     * @param RequestedSourceInterface $requestedSource
     *
     * @return SourceInterface|null
     */
    public function findOneByIdOrSlug(RequestedSourceInterface $requestedSource): ?SourceInterface;
}
