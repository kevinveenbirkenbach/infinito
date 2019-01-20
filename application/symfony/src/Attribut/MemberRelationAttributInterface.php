<?php

namespace App\Attribut;

use App\Entity\Meta\Relation\Member\MemberRelationInterface;

interface MemberRelationAttributInterface
{
    public function setMemberRelation(MemberRelationInterface $memberRelation): void;

    public function getMemberRelation(): MemberRelationInterface;
}
