<?php

namespace Infinito\Entity\Meta\Relation;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Entity\Meta\AbstractMeta;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
abstract class AbstractRelation extends AbstractMeta implements RelationInterface
{
    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface
     */
    protected $source;

    public function __construct()
    {
        parent::__construct();
    }
}
