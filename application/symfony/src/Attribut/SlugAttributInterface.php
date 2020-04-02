<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface SlugAttributInterface
{
    const SLUG_ATTRIBUT_NAME = 'slug';

    public function setSlug(string $slug): void;

    /**
     * Don't use this function to check if a slug is set
     * Use instead:.
     *
     * @see self::hasSlug()
     */
    public function getSlug(): ?string;

    /**
     * @return bool Checks if a slug is set
     */
    public function hasSlug(): bool;
}
