<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
trait SlugAttribut
{
    /**
     * @var string
     */
    protected $slug;

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function hasSlug(): bool
    {
        return isset($this->slug);
    }
}
