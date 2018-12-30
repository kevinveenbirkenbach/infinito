<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;

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
                $memberMembers = $member->getMembers();
                $this->itterateOverMembers($memberMembers);
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMemberInformationInterface::getAllMembers()
     */
    public function getAllMembers(): Collection
    {
        $this->members = new ArrayCollection();
        $this->itterateOverMembers($this->source->getMemberRelation()->getMembers());

        return $this->members;
    }
}
