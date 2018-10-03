<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface RightsAttributInterface
{
    public function setRights(Collection $rights): void;

    public function getRights(): Collection;
}
