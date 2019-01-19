<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
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

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * @param Collection|MemberRelationInterface[] $memberships
     */
    private function itterateOverMemberships(Collection $memberships): void
    {
        foreach ($memberships as $membership) {
            if (!$this->memberships->contains($membership->getSource())) {
                $this->memberships->add($membership->getSource());
                $this->itterateOverMemberships($membership->getMemberships());
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMembershipInformationInterface::getAllMemberships()
     */
    public function getAllMemberships(): Collection
    {
        $this->memberships = new ArrayCollection();
        $this->itterateOverMemberships($this->source->getMemberRelation()->getMemberships());

        return $this->memberships;
    }
}
