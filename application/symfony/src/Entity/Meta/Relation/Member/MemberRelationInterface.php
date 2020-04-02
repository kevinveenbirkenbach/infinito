<?php

namespace Infinito\Entity\Meta\Relation\Member;

use Infinito\Attribut\MembersAttributInterface;
use Infinito\Attribut\MembershipsAttributInterface;
use Infinito\Entity\Meta\Relation\RelationInterface;

interface MemberRelationInterface extends RelationInterface, MembersAttributInterface, MembershipsAttributInterface
{
}
