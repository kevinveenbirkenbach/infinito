<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;

interface CollectionAttributInterface
{
    public function getCollection(): Collection;

    public function setCollection(Collection $collection): void;
}
