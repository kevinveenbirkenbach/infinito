<?php

namespace App\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ChildsAttributInterface
{
    public function setChilds(Collection $childs): void;

    public function getChilds(): Collection;
}
