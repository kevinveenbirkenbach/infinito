<?php

namespace Infinito\Domain\Source;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;
use Infinito\Entity\Source\SourceInterface;

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
     * @see \Infinito\Domain\Source\SourceMembershipInformationInterface::getAllMemberships()
     */
    public function getAllMemberships(): Collection
    {
        $this->memberships = new ArrayCollection();
        $this->itterateOverMemberships($this->source->getMemberRelation()->getMemberships());

        return $this->memberships;
    }
}
