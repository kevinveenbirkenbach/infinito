<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

trait CollectionAttribut
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }
}
