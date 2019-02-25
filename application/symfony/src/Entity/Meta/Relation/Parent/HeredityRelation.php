<?php

namespace Infinito\Entity\Meta\Relation\Parent;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * * @ORM\Entity(repositoryClass="Infinito\Repository\Meta\Relation\Parent\HeredityRepository")
 */
class HeredityRelation extends AbstractParentRelation implements HeredityRelationInterface
{
    /**
     * Parents represent from which inhieres.
     *
     * @ORM\ManyToMany(targetEntity="HeredityRelation",mappedBy="childs")
     *
     * @var Collection|HeredityRelationInterface[]
     */
    protected $parents;

    /**
     * Childs represent the by the object produced relations.
     *
     * @ORM\ManyToMany(targetEntity="HeredityRelation",inversedBy="parents")
     * @ORM\JoinTable(
     *      joinColumns={
     *      @ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id")}
     *      )
     *
     * @var Collection|HeredityRelationInterface[]
     */
    protected $childs;
}
