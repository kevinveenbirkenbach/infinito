<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
interface MembershipsAttributInterface
{
    /**
     * @param Collection|MemberRelationInterface[] $groups
     */
    public function setMemberships(Collection $memberships): void;

    /**
     * @return Collection|MemberRelationInterface[]
     */
    public function getMemberships(): Collection;
}
