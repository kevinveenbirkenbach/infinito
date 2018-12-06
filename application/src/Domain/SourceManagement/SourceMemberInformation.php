<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;

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

    private function itterateOverMembers(Collection $members): void
    {
        foreach ($members as $member) {
            if (!$this->members->contains($member)) {
                $this->members->add($member);
                $this->itterateOverMembers($member->getMemberRelation()->getMembers());
            }
        }
    }

    public function getAllMembers(): Collection
    {
        $this->members = new ArrayCollection();
        $this->itterateOverMembers($this->source->getMemberRelation()->getMembers());

        return $this->members;
    }
}
