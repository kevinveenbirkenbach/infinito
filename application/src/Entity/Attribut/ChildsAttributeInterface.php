<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ChildsAttributeInterface
{
    public function setChilds(Collection $childs): void;

    public function getChilds(): Collection;
}
