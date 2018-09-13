<?php

namespace App\Entity\Attribut;

use App\Entity\NodeInterface;

/**
 * @author kevinfrantz
 */
trait NodeAttribut
{
    /**
     * @var NodeInterface
     * @ORM\OneToOne(targetEntity="Node",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     */
    protected $node;

    public function setNode(NodeInterface $node): void
    {
        $this->node = $node;
    }

    public function getNode(): NodeInterface
    {
        return $this->node;
    }
}
