<?php

namespace App\Entity\Meta\Relation\Parent;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 */
class CreatorRelation extends AbstractParentRelation implements CreatorRelationInterface
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface
     */
    protected $source;

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
