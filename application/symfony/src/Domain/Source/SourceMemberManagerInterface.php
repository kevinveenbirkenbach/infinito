<?php

namespace Infinito\Domain\Source;

use Infinito\Entity\Source\SourceInterface;

/**
 * Offers to add and remove source members and memberships.
 *
 * @author kevinfrantz
 */
interface SourceMemberManagerInterface
{
    public function addMember(SourceInterface $member): void;

    public function removeMember(SourceInterface $member): void;

    public function addMembership(SourceInterface $membership): void;

    public function removeMembership(SourceInterface $membership): void;
}
