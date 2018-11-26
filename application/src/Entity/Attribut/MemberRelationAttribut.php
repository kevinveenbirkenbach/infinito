<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\Relation\Member\MemberRelationInterface;

trait MemberRelationAttribut
{
    /**
     * @var MemberRelationInterface
     */
    protected $memberRelation;

    public function setMembersRelation(MemberRelationInterface $memberRelation): void
    {
        $this->memberRelation = $memberRelation;
    }

    public function getMemberRelation(): MemberRelationInterface
    {
        return $this->memberRelation;
    }
}
