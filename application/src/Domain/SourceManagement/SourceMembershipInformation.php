<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;

final class SourceMembershipInformation implements SourceMembershipInformationInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var Collection|SourceInterface[]
     */
    private $memberships;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    private function itterateOverMemberships(Collection $memberships): void
    {
        foreach ($memberships as $membership) {
            if (!$this->memberships->contains($membership)) {
                $this->memberships->add($membership);
                $this->itterateOverMemberships($membership->getMemberRelation()->getMemberships());
            }
        }
    }

    public function getAllMemberships(): Collection
    {
        $this->memberships = new ArrayCollection();
        $this->itterateOverMemberships($this->source->getMemberRelation()->getMemberships());

        return $this->memberships;
    }
}
