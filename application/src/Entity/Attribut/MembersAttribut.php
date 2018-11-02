<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Helper\DimensionHelper;

/**
 * @author kevinfrantz
 *
 * @todo this attribut should be refactored to mapp fully on collections instead of members
 */
trait MembersAttribut
{
    /**
     * @var Collection
     */
    protected $collection;

    public function getMembers(): Collection
    {
        return $this->collection;
    }

    public function setMembers(Collection $members): void
    {
        $this->collection = $members;
    }

    /**
     * @param int        $dimension The dimensions start with 1 for the members of the actuall dimension and NULL for all members
     * @param Collection $members   A reference to a members list, to which new members should be add
     *
     * @return Collection|MembersAttributInterface[] Returns all members till the defined dimension
     */
    public function getMembersIncludingChildren(?int $dimension = null, Collection $members = null): Collection
    {
        $dimensionHelper = new DimensionHelper(__FUNCTION__, MembersAttributInterface::class, $this, 'members');

        return $dimensionHelper->getDimensions($dimension, $members);
    }

    private function continueIncludeMembersLoop(?int $dimension): bool
    {
        return is_null($dimension) || $dimension > 0;
    }
}
