<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\NodeInterface;

/**
 * @author kevinfrantz
 */
trait ChildsAttribut
{
    /**
     * Many Nodes have many childs.
     *
     * @ORM\ManyToMany(targetEntity="Node")
     * @ORM\JoinTable(name="nodes_childs",
     *      joinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="node_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection|NodeInterface[]
     */
    protected $childs;

    public function getChilds(): ArrayCollection
    {
        return $this->getChilds();
    }

    public function setChilds(ArrayCollection $childs): void
    {
        $this->childs = $childs;
    }
}
