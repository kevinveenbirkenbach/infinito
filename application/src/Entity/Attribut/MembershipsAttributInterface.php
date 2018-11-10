<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Collection\TreeCollectionSourceInterface;

/**
 * @author kevinfrantz
 */
interface MembershipsAttributInterface
{
    /**
     * @param Collection|TreeCollectionSourceInterface[] $groups
     */
    public function setMemberships(Collection $memberships): void;

    /**
     * @return Collection|TreeCollectionSourceInterface[]
     */
    public function getMemberships(): Collection;
}
