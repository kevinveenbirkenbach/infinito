<?php
namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 */
trait MembersAttribut
{

    /**
     *
     * @var Collection
     */
    protected $members;

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }

    /**
     *
     * @param int $dimension
     *            The dimensions start with 1 for the members of the actuall dimension and NULL for all members
     * @param Collection $members
     *            A reference to a members list, to which new members should be add
     *            
     * @return Collection|MembersAttributInterface[] Returns all members till the defined dimension
     */
    public function getMembersInclusiveChildren(?int $dimension = null, Collection $members = null): Collection
    {
        // print_r('Dimension:');
        // var_dump($dimension);
        $dimension = is_int($dimension) ? $dimension - 1: null;
        // var_dump($dimension);
        $members = $members ?? new ArrayCollection();
        // print_r('Hello ' . $this . ' (' . $dimension . ')' . $members->count() . "\n");
        foreach ($this->members->toArray() as $member) {
            if (! $members->contains($member)) {
                $members->add($member);
                if ($dimension > 0) {
                    var_dump($dimension);
                    $member->getMembersInclusiveChildren($dimension, $members);
                }
            }
        }
        return $members;
    }

    private function continueIncludeMembersLoop(?int $dimension): bool
    {
        return (is_null($dimension) || $dimension > 0);
    }
}
