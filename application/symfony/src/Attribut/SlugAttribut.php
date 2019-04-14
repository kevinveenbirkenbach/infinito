<?php

namespace Infinito\Attribut;

use Infinito\Exception\Validation\ValueInvalidException;

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
     * @todo Maybe throw an other Exception here?
     *
     * @param string $slug
     *
     * @throws ValueInvalidException
     */
    public function setSlug(string $slug): void
    {
        if (is_numeric($slug)) {
            throw new ValueInvalidException('A slug must not be numeric!');
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
