<?php

namespace App\Entity\Meta\Relation\Member;

use App\Entity\Meta\Relation\AbstractRelation;
use App\Entity\Attribut\MembersAttribut;
use App\Entity\Attribut\MembershipsAttribut;

class MemberRelation extends AbstractRelation implements MemberRelationInterface
{
    use MembersAttribut,MembershipsAttribut;
}
