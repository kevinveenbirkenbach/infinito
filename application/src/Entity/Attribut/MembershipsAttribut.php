<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\GroupSourceInterface;
use App\Entity\Source\Collection\MemberCollectionSourceInterface;

/**
 * @author kevinfrantz
 */
trait MembershipsAttribut
{
    /**
     * @var Collection|MemberCollectionSourceInterface[]
     */
    protected $memberships;

    /**
     * @return Collection|MemberCollectionSourceInterface[]
     */
    public function getMemberships(): Collection
    {
        return $this->memberships;
    }

    /**
     * @param Collection|MemberCollectionSourceInterface[] $memberships
     */
    public function setMemberships(Collection $memberships): void
    {
        $this->memberships = $memberships;
    }
}
