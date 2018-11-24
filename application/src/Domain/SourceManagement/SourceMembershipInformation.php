<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;

class SourceMembershipInformation implements SourceMembershipInformationInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var Collection
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
                $this->itterateOverMemberships($membership->getMemberships());
            }
        }
    }

    public function getAllMemberships(): Collection
    {
        $this->memberships = new ArrayCollection();
        $this->itterateOverMemberships($this->source->getMemberships());

        return $this->memberships;
    }
}
