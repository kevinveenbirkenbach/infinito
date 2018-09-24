<?php

namespace App\Entity\Attribut\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface RightsAttributInterface
{
    public function setRights(Collection $rights): void;

    public function getRights(): Collection;
}
