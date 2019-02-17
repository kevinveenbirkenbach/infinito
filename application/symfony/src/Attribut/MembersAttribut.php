<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
trait MembersAttribut
{
    /**
     * @var Collection|MemberRelationInterface[]
     */
    protected $members;

    /**
     * @return Collection|MemberRelationInterface[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @param Collection|MemberRelationInterface[] $members
     */
    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }
}
