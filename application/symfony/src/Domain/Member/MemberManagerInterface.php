<?php

namespace Infinito\Domain\Member;

use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 */
interface MemberManagerInterface
{
    public function addMember(MemberRelationInterface $member): void;

    public function removeMember(MemberRelationInterface $member): void;

    public function addMembership(MemberRelationInterface $membership): void;

    public function removeMembership(MemberRelationInterface $membership): void;
}
