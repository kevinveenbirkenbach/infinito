<?php

namespace Infinito\Attribut;

/**
 * Entities which implement this interface can lock stuff on an optimistic base.
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/transactions-and-concurrency.html
 * @see https://en.wikipedia.org/wiki/Optimistic_concurrency_control
 *
 * @author kevinfrantz
 */
interface VersionAttributInterface
{
    /**
     * @var string
     */
    const VERSION_ATTRIBUT_NAME = 'version';

    /**
     * Returns the revision version of the entity.
     */
    public function getVersion(): int;

    /**
     * Sets the revision version of the entity.
     */
    public function setVersion(int $version): void;
}
