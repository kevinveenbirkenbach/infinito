<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
interface SlugAttributInterface
{
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
