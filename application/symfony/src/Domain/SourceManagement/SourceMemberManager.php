<?php

namespace App\Domain\SourceManagement;

use App\Entity\Source\SourceInterface;
use App\Domain\MemberManagement\MemberManagerInterface;
use App\Domain\MemberManagement\MemberManager;

/**
 * @author kevinfrantz
 */
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

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
        $this->memberManager = new MemberManager($this->source->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMemberManagerInterface::addMember()
     */
    public function addMember(SourceInterface $member): void
    {
        $this->memberManager->addMember($member->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMemberManagerInterface::removeMember()
     */
    public function removeMember(SourceInterface $member): void
    {
        $this->memberManager->removeMember($member->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMemberManagerInterface::addMembership()
     */
    public function addMembership(SourceInterface $membership): void
    {
        $this->memberManager->addMembership($membership->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\SourceMemberManagerInterface::removeMembership()
     */
    public function removeMembership(SourceInterface $membership): void
    {
        $this->memberManager->removeMembership($membership->getMemberRelation());
    }
}
