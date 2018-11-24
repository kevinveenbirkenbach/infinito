<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
trait MembersAttribut
{
    /**
     * @var Collection|SourceInterface[]
     */
    protected $memberships;

    /**
     * @return Collection|SourceInterface[]
     */
    public function getMembers(): Collection
    {
        return $this->memberships;
    }

    /**
     * @param Collection|SourceInterface[] $members
     */
    public function setMembers(Collection $members): void
    {
        $this->memberships = $members;
    }
}
