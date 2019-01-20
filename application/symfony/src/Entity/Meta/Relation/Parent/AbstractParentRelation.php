<?php

namespace App\Entity\Meta\Relation\Parent;

use App\Attribut\IdAttribut;
use App\Attribut\ParentsAttribut;
use App\Attribut\ChildsAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Meta\Relation\AbstractRelation;

/**
 * This class represents a relation.
 *
 * @author kevinfrantz
 */
abstract class AbstractParentRelation extends AbstractRelation implements ParentRelationInterface
{
    use IdAttribut,
    ParentsAttribut,
    ChildsAttribut;

    public function __construct()
    {
        parent::__construct();
        $this->parents = new ArrayCollection();
        $this->childs = new ArrayCollection();
    }
}
