<?php

namespace App\Repository\Source;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\RequestedSourceInterface;

/**
 * @author kevinfrantz
 */
interface SourceRepositoryInterface extends ObjectRepository, Selectable
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
