<?php

namespace App\Domain\SourceManagement;

use App\Entity\Source\SourceInterface;

final class SourceMemberManager implements SourceMemberManagerInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    public function addMember(SourceInterface $member): void
    {
        if (!$this->source->getMembers()->contains($member)) {
            $this->source->getMembers()[] = $member;
            (new self($member))->addMembership($this->source);
        }
    }

    public function removeMember(SourceInterface $member): void
    {
        if ($this->source->getMembers()->contains($member)) {
            $this->source->getMembers()->removeElement($member);
            (new self($member))->removeMembership($this->source);
        }
    }

    public function addMembership(SourceInterface $membership): void
    {
        if (!$this->source->getMemberships()->contains($membership)) {
            $this->source->getMemberships()[] = $membership;
            (new self($membership))->addMember($this->source);
        }
    }

    public function removeMembership(SourceInterface $membership): void
    {
        if ($this->source->getMemberships()->contains($membership)) {
            $this->source->getMemberships()->removeElement($membership);
            (new self($membership))->removeMember($this->source);
        }
    }
}
