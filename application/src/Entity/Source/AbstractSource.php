<?php

namespace App\Entity\Source;

use App\Entity\Attribut\NodeAttribut;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use App\Entity\Source\SourceInterface;
use App\Entity\NodeInterface;
use App\Entity\AbstractEntity;

/**
 * @author kevinfrantz
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html
 * @ORM\Entity
 * @ORM\Table(name="source")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "UserSource","name" = "NameSource"})
 */
abstract class AbstractSource extends AbstractEntity implements SourceInterface
{
    use NodeAttribut;

    /**
     * @var NodeInterface
     * @ORM\OneToOne(targetEntity="Node",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     * @Exclude
     */
    protected $node;

    public function __construct()
    {
        parent::__construct();
        $this->node = new Node();
        $this->node->setSource($this);
    }
}
