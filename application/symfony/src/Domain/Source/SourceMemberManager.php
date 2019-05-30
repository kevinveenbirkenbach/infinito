<?php

namespace Infinito\Domain\Source;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\Member\MemberManagerInterface;
use Infinito\Domain\Member\MemberManager;

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
     * @see \Infinito\Domain\Source\SourceMemberManagerInterface::addMember()
     */
    public function addMember(SourceInterface $member): void
    {
        $this->memberManager->addMember($member->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceMemberManagerInterface::removeMember()
     */
    public function removeMember(SourceInterface $member): void
    {
        $this->memberManager->removeMember($member->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceMemberManagerInterface::addMembership()
     */
    public function addMembership(SourceInterface $membership): void
    {
        $this->memberManager->addMembership($membership->getMemberRelation());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceMemberManagerInterface::removeMembership()
     */
    public function removeMembership(SourceInterface $membership): void
    {
        $this->memberManager->removeMembership($membership->getMemberRelation());
    }
}
