<?php

namespace App\Entity\Meta\Relation\Member;

use App\Entity\Meta\Relation\RelationInterface;
use App\Entity\Attribut\MembersAttributInterface;
use App\Entity\Attribut\MembershipsAttributInterface;

interface MemberRelationInterface extends RelationInterface, MembersAttributInterface, MembershipsAttributInterface
{
}
