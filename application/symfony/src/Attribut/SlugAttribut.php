<?php

namespace Infinito\Attribut;

use Infinito\Exception\UnvalidValueException;

/**
 * @author kevinfrantz
 *
 * @see SlugAttributInterface
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
     * @return string|null
     */
    public function getSlug(): ?string
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
