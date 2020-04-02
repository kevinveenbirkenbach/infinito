<?php

namespace Infinito\Domain\Member;

use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * Allows to add and remove members and memberships from member relations.
 *
 * @see MemberRelationInterface
 *
 * @author kevinfrantz
 */
final class MemberManager implements MemberManagerInterface
{
    /**
     * @var MemberRelationInterface
     */
    private $memberRelation;

    public function __construct(MemberRelationInterface $memberRelation)
    {
        $this->memberRelation = $memberRelation;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Member\MemberManagerInterface::addMember()
     */
    public function addMember(MemberRelationInterface $member): void
    {
        if (!$this->memberRelation->getMembers()->contains($member)) {
            $this->memberRelation->getMembers()[] = $member;
            (new self($member))->addMembership($this->memberRelation);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Member\MemberManagerInterface::removeMember()
     */
    public function removeMember(MemberRelationInterface $member): void
    {
        if ($this->memberRelation->getMembers()->contains($member)) {
            $this->memberRelation->getMembers()->removeElement($member);
            (new self($member))->removeMembership($this->memberRelation);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Member\MemberManagerInterface::addMembership()
     */
    public function addMembership(MemberRelationInterface $membership): void
    {
        if (!$this->memberRelation->getMemberships()->contains($membership)) {
            $this->memberRelation->getMemberships()[] = $membership;
            (new self($membership))->addMember($this->memberRelation);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Member\MemberManagerInterface::removeMembership()
     */
    public function removeMembership(MemberRelationInterface $membership): void
    {
        if ($this->memberRelation->getMemberships()->contains($membership)) {
            $this->memberRelation->getMemberships()->removeElement($membership);
            (new self($membership))->removeMember($this->memberRelation);
        }
    }
}
