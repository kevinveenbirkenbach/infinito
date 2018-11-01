<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Collection\MemberCollectionSourceInterface;

/**
 * @author kevinfrantz
 */
interface MembershipsAttributInterface
{
    /**
     * @param Collection|MemberCollectionSourceInterface[] $groups
     */
    public function setMemberships(Collection $memberships): void;

    /**
     * @return Collection|MemberCollectionSourceInterface[]
     */
    public function getMemberships(): Collection;
}
