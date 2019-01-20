<?php

namespace App\Attribut;

use App\Entity\Meta\Relation\Member\MemberRelationInterface;

trait MemberRelationAttribut
{
    /**
     * @var MemberRelationInterface
     */
    protected $memberRelation;

    public function setMemberRelation(MemberRelationInterface $memberRelation): void
    {
        $this->memberRelation = $memberRelation;
    }

    public function getMemberRelation(): MemberRelationInterface
    {
        return $this->memberRelation;
    }
}
