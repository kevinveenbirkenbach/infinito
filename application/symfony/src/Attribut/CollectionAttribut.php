<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;

trait CollectionAttribut
{
    /**
     * @var Collection
     */
    protected $collection;

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }
}
