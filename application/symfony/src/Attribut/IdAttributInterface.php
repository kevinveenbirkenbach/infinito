<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface IdAttributInterface
{
    const ID_ATTRIBUT_NAME = 'id';

    public function setId(int $id): void;

    /**
     * Don't use this function to check if an id is set.
     * Use instead:.
     *
     * @see self::hasId()
     */
    public function getId(): ?int;

    /**
     * @return bool Checks if attribute is set
     */
    public function hasId(): bool;
}
