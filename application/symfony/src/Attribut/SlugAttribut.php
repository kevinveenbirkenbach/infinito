<?php

namespace App\Attribut;

use App\Exception\UnvalidValueException;

/**
 * @author kevinfrantz
 */
trait SlugAttribut
{
    /**
     * @var string
     */
    protected $slug;

    /**
     * @param string $slug
     *
     * @throws UnvalidValueException
     */
    public function setSlug(string $slug): void
    {
        if (is_numeric($slug)) {
            throw new UnvalidValueException('A slug must not be numeric!');
        }
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return bool
     */
    public function hasSlug(): bool
    {
        return isset($this->slug);
    }
}