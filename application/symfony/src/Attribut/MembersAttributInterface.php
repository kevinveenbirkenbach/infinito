<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
interface MembersAttributInterface
{
    /**
     * @param Collection|MemberRelationInterface[] $members
     */
    public function setMembers(Collection $members): void;

    /**
     * @return Collection|MemberRelationInterface[]
     */
    public function getMembers(): Collection;
}
