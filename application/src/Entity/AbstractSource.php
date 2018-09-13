<?php

namespace App\Entity;

use App\Entity\Attribut\NodeAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "UserSource"})
 */
abstract class AbstractSource extends AbstractEntity implements SourceInterface
{
    use NodeAttribut;

    /**
     * @var NodeInterface
     * @ORM\OneToOne(targetEntity="Node",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     */
    protected $node;

    public function __construct()
    {
        $this->node = new Node();
        $this->node->setSource($this);
    }
}
