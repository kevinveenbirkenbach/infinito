<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface RightsAttributInterface
{
    /**
     * @param Collection|RightInterface[] $rights
     */
    public function setRights(Collection $rights): void;

    /**
     * @return Collection|RightInterface[]
     */
    public function getRights(): Collection;
}
