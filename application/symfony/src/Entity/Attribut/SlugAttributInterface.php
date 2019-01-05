<?php

namespace App\Entity\Attribut;

interface SlugAttributInterface
{
    public function setSlug(string $slug): void;

    public function getSlug(): string;
}
