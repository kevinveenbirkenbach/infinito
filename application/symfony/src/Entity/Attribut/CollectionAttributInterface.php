<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

interface CollectionAttributInterface
{
    public function getCollection(): Collection;

    public function setCollection(Collection $collection): void;
}
