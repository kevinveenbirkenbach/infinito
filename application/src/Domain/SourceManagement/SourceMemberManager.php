<?php

namespace App\Domain\SourceManagement;

use App\Entity\Source\SourceInterface;
use App\Domain\MemberManagement\MemberManagerInterface;
use App\Domain\MemberManagement\MemberManager;

final class SourceMemberManager implements SourceMemberManagerInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var MemberManagerInterface
     */
    private $memberManager;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
        $this->memberManager = new MemberManager($this->source->getMemberRelation());
    }

    public function addMember(SourceInterface $member): void
    {
        $this->memberManager->addMember($member->getMemberRelation());
    }

    public function removeMember(SourceInterface $member): void
    {
        $this->memberManager->removeMember($member->getMemberRelation());
    }

    public function addMembership(SourceInterface $membership): void
    {
        $this->memberManager->addMembership($membership->getMemberRelation());
    }

    public function removeMembership(SourceInterface $membership): void
    {
        $this->memberManager->removeMembership($membership->getMemberRelation());
    }
}
