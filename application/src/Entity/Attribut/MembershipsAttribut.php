<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Complex\Collection\TreeCollectionSourceInterface;

/**
 * @author kevinfrantz
 */
trait MembershipsAttribut
{
    /**
     * @var Collection|TreeCollectionSourceInterface[]
     */
    protected $memberships;

    /**
     * @return Collection|TreeCollectionSourceInterface[]
     */
    public function getMemberships(): Collection
    {
        return $this->memberships;
    }

    /**
     * @param Collection|TreeCollectionSourceInterface[] $memberships
     */
    public function setMemberships(Collection $memberships): void
    {
        $this->memberships = $memberships;
    }
}
