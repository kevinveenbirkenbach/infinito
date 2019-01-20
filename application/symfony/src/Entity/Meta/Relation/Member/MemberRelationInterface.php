<?php

namespace App\Entity\Meta\Relation\Member;

use App\Entity\Meta\Relation\RelationInterface;
use App\Attribut\MembersAttributInterface;
use App\Attribut\MembershipsAttributInterface;

interface MemberRelationInterface extends RelationInterface, MembersAttributInterface, MembershipsAttributInterface
{
}
