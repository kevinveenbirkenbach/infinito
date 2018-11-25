<?php

namespace App\Entity\Meta\Relation\Parent;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Meta\Relation\CreatorRelationInterface;

class CreatorRelation extends AbstractParentRelation
{
    /**
     * @ORM\ManyToMany(targetEntity="CreatorRelation",mappedBy="childs")
     *
     * @var Collection|CreatorRelationInterface[]
     */
    protected $parents;

    /**
     * @ORM\ManyToMany(targetEntity="CreatorRelation",inversedBy="parents")
     * @ORM\JoinTable(name="meta_relation_childs",
     *      joinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|CreatorRelationInterface[]
     */
    protected $childs;
}
