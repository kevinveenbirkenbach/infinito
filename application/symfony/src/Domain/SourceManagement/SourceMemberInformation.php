<?php

namespace Infinito\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
final class SourceMemberInformation implements SourceMemberInformationInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var Collection|SourceInterface[]
     */
    private $members;

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * @param Collection|MemberRelationInterface[] $members
     */
    private function itterateOverMembers(Collection $members): void
    {
        foreach ($members as $member) {
            if (!$this->members->contains($member->getSource())) {
                $this->members->add($member->getSource());
                $this->itterateOverMembers($member->getMembers());
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\SourceManagement\SourceMemberInformationInterface::getAllMembers()
     */
    public function getAllMembers(): Collection
    {
        $this->members = new ArrayCollection();
        $this->itterateOverMembers($this->source->getMemberRelation()->getMembers());

        return $this->members;
    }
}
