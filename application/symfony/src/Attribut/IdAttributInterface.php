<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface IdAttributInterface
{
    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * Don't use this function to check if an id is set.
     * Use instead:.
     *
     * @see self::hasId()
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return bool Checks if attribute is set
     */
    public function hasId(): bool;
}
