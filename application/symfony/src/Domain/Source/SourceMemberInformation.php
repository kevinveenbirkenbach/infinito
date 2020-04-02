<?php

namespace Infinito\Domain\Source;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;
use Infinito\Entity\Source\SourceInterface;

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
     * @see \Infinito\Domain\Source\SourceMemberInformationInterface::getAllMembers()
     */
    public function getAllMembers(): Collection
    {
        $this->members = new ArrayCollection();
        $this->itterateOverMembers($this->source->getMemberRelation()->getMembers());

        return $this->members;
    }
}
