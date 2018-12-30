<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\MemberRelationAttributInterface;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;
use App\Entity\EntityInterface;

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
     * @param Collection|MemberRelationAttributInterface[] $members
     */
    private function itterateOverMembers(Collection $members): void
    {
        foreach ($members as $member) {
            if (!$this->members->contains($member)) {
                $this->addMemberSource($member);
                $this->itterateOverMembers($this->getMemberMembers($member));
            }
        }
    }

    /**
     * @todo Implement tests!
     *
     * @param EntityInterface $member
     */
    private function addMemberSource(EntityInterface $member): void
    {
        if ($member instanceof MemberRelationInterface) {
            $this->members->add($member->getSource());
        } else {
            $this->members->add($member);
        }
    }

    /**
     * @todo Implement tests
     *
     * @param EntityInterface $member
     *
     * @return Collection
     */
    private function getMemberMembers(EntityInterface $member): Collection
    {
        if ($member instanceof MemberRelationInterface) {
            return $member->getMembers();
        }

        return $member->getMemberRelation()->getMembers();
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
