<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ParentsAttributInterface
{
    public function setParents(Collection $parents): void;

    public function getParents(): Collection;
}
