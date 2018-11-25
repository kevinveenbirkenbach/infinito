<?php

namespace App\Entity\Meta\Relation\Parent;

use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\ParentsAttribut;
use App\Entity\Attribut\ChildsAttribut;
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
