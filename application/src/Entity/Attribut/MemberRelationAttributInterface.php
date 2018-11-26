<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\Relation\Member\MemberRelationInterface;

interface MemberRelationAttributInterface
{
    public function setMembersRelation(MemberRelationInterface $memberRelation): void;

    public function getMemberRelation(): MemberRelationInterface;
}
