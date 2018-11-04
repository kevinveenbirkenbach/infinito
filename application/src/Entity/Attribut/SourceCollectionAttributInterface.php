<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

interface SourceCollectionAttributInterface
{
    /**
     * @param Collection|SourceInterface[] $collection
     */
    public function setCollection(Collection $collection): void;

    /**
     * @return Collection|SourceInterface[]
     */
    public function getCollection(): Collection;
}