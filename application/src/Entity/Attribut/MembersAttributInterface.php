<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface MembersAttributInterface
{
    /**
     * @param Collection|SourceInterface[] $members
     */
    public function setMembers(Collection $members): void;

    /**
     * @return Collection|SourceInterface[]
     */
    public function getMembers(): Collection;
}
