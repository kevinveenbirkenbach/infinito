<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\TypeAttribut;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\Entity\Attribut\LawAttribut;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Attribut\GrantAttribut;
use App\Logic\Operation\OperationInterface;
use App\Entity\Attribut\ConditionAttribut;
use App\Entity\Attribut\RecieverAttribut;
use App\Entity\Attribut\LayerAttribut;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Attribut\PriorityAttribut;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_right")
 * @ORM\Entity(repositoryClass="App\Repository\RightRepository")
 */
class Right extends AbstractMeta implements RightInterface
{
    use TypeAttribut,LawAttribut, RelationAttribut, GrantAttribut,ConditionAttribut,RecieverAttribut,LayerAttribut,PriorityAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface The requested source to which the law applies
     */
    protected $source;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int which priority has the right in a roleset
     */
    protected $priority;

    /**
     * @ORM\ManyToOne(targetEntity="Law", inversedBy="rights")
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    /**
     * @ORM\Column(name="layer", type="LayerType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\LayerType")
     *
     * @var string
     */
    protected $layer;

    /**
     * @todo Test and implement it on an correct way!
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist"})
     * @ORM\JoinColumn(name="reciever_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface
     */
    protected $reciever;

    /**
     * @ORM\Column(type="boolean",name="`grant`")
     *
     * @var bool
     */
    protected $grant;

    /**
     * @ORM\Column(name="type", type="RightType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\RightType")
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\Operation\AbstractOperation",cascade={"persist"})
     * @ORM\JoinColumn(name="operation_id", referencedColumnName="id",nullable=true)
     *
     * @var OperationInterface
     */
    protected $condition;

    public function __construct()
    {
        parent::__construct();
        $this->grant = true;
        $this->priority = 0;
    }
}
