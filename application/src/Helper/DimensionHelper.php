<?php

namespace App\Helper;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Helps to get all Elements till a special dimension.
 *
 * @author kevinfrantz
 *
 * @deprecated
 *
 * @todo Implement as service!
 */
final class DimensionHelper implements DimensionHelperInterface
{
    /**
     * @var string
     */
    private $attribut;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $interface;

    /**
     * @var object
     */
    private $object;

    /**
     * @var int|null the actual dimension to which the class points
     */
    private $dimension = null;

    /**
     * @param string $method
     *                          which uses the dimension helper
     * @param string $interface
     *                          which is implemented in all classes which have dimensions
     * @param object $object
     *                          which calls the dimension helper
     * @param string $attribut
     *                          which represents dimensions
     */
    public function __construct(string $method, string $interface, object $object, string $attribut)
    {
        $this->method = $method;
        $this->interface = $interface;
        $this->object = $object;
        $this->attribut = $attribut;
    }

    /**
     * @deprecated
     *
     * @param int        $dimension
     *                              The dimensions start with 1 for the elements of the actuall dimension and NULL for all elements
     * @param Collection $elements
     *                              A elements collection, to which new elements should be add
     *
     * @return Collection Returns all elements till the defined dimension
     */
    public function getDimensions(?int $dimension = null, Collection $elements = null): Collection
    {
        $this->setDimension($dimension);
        $elements = $elements ?? new ArrayCollection();
        if ($this->dimension >= 0) {
            foreach ($this->object->{$this->attributGetterName()}()
                ->toArray() as $element) {
                if (!$elements->contains($element)) {
                    $elements->add($element);
                    if ($this->continueLoop() && $element instanceof $this->interface) {
                        $element->{$this->method}($this->dimension, $elements);
                    }
                }
            }
        }

        return $elements;
    }

    private function setDimension(?int $dimension): void
    {
        $this->dimension = is_int($dimension) ? $dimension - 1 : null;
    }

    private function attributGetterName(): string
    {
        return 'get'.ucfirst($this->attribut);
    }

    private function includeInfiniteDimensions(): bool
    {
        return is_null($this->dimension);
    }

    private function isNotLastDimension(): bool
    {
        return $this->dimension > 0;
    }

    private function continueLoop(): bool
    {
        return $this->includeInfiniteDimensions() || $this->isNotLastDimension();
    }
}
