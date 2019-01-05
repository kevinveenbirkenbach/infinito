<?php

namespace App\Entity\Meta\Relation;

use App\Entity\Meta\AbstractMeta;
use App\Entity\Source\SourceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 */
abstract class AbstractRelation extends AbstractMeta implements RelationInterface
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
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
