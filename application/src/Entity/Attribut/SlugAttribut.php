<?php

namespace App\Entity\Attribut;

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
}
