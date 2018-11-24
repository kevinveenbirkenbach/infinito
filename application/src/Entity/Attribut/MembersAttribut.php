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
    protected $members;

    /**
     * @return Collection|SourceInterface[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @param Collection|SourceInterface[] $members
     */
    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }
}
