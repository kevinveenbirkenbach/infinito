<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * Allows to group other sources in a source.
 *
 * @author kevinfrantz
 */
interface MembersAttributInterface
{
    /**
     * @param Collection $members
     */
    public function setMembers(Collection $members): void;

    /**
     * @return Collection
     */
    public function getMembers(): Collection;

    /**
     * @return Collection
     */
    public function getMembersInclusiveChildren(int $dimension = null): Collection;
}
