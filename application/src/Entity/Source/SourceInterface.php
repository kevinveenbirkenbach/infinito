<?php

namespace App\Entity\Source;

use App\Entity\Attribut\IdAttributInterface;
use App\Entity\EntityInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Attribut\MembershipsAttributInterface;
use App\Entity\Attribut\SlugAttributInterface;
use App\Entity\Attribut\MembersAttributInterface;

/**
 * @author kevinfrantz
 */
interface SourceInterface extends IdAttributInterface, EntityInterface, MembershipsAttributInterface, LawAttributInterface, RelationAttributInterface, SlugAttributInterface, MembersAttributInterface
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
