<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;

interface MemberRelationAttributInterface
{
    public function setMemberRelation(MemberRelationInterface $memberRelation): void;

    public function getMemberRelation(): MemberRelationInterface;
}
