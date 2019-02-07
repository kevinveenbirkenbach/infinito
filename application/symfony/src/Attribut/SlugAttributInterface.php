<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
interface SlugAttributInterface
{
    const SLUG_ATTRIBUT_NAME = 'slug';

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @return bool Checks if a slug is set
     */
    public function hasSlug(): bool;
}
