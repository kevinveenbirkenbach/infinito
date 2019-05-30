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
    /**
     * @param SourceInterface $member
     */
    public function addMember(SourceInterface $member): void;

    /**
     * @param SourceInterface $member
     */
    public function removeMember(SourceInterface $member): void;

    /**
     * @param SourceInterface $membership
     */
    public function addMembership(SourceInterface $membership): void;

    /**
     * @param SourceInterface $membership
     */
    public function removeMembership(SourceInterface $membership): void;
}
