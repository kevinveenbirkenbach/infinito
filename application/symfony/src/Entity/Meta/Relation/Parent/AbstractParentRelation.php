<?php

namespace Infinito\Entity\Meta\Relation\Parent;

use Infinito\Attribut\IdAttribut;
use Infinito\Attribut\ParentsAttribut;
use Infinito\Attribut\ChildsAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Entity\Meta\Relation\AbstractRelation;

/**
 * This class represents a relation.
 *
 * @author kevinfrantz
 */
abstract class AbstractParentRelation extends AbstractRelation implements ParentRelationInterface
{
    use IdAttribut;
    use
    ParentsAttribut;
    use
    ChildsAttribut;

    public function __construct()
    {
        parent::__construct();
        $this->parents = new ArrayCollection();
        $this->childs = new ArrayCollection();
    }
}
