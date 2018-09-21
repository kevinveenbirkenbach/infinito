<?php

namespace App\Entity;

use App\Entity\Attribut\TypeAttribut;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\Entity\Attribut\LawAttribut;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Attribut\PermissionsAttribut;
use App\Entity\Attribut\NodeAttribut;
use App\Entity\Attribut\RecieverAttribut;
use App\Entity\Attribut\GrantAttribut;
use App\Logic\Operation\OperationInterface;
use App\Entity\Attribut\ConditionAttribut;
use App\Entity\Attribut\RecieverGroupAttribut;
use App\Entity\Attribut\LayerAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="`right`")
 * @ORM\Entity(repositoryClass="App\Repository\RightRepository")
 */
class Right extends AbstractEntity implements RightInterface
{
    use TypeAttribut,LawAttribut,PermissionsAttribut, NodeAttribut, RecieverAttribut,GrantAttribut,ConditionAttribut,RecieverGroupAttribut,LayerAttribut;

    /**
     * @ORM\ManyToOne(targetEntity="Law", inversedBy="rights")
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    /**
     * @ORM\Column(name="type", type="LayerType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\LayerType")
     *
     * @var string
     */
    protected $layer;

    /**
     * @ORM\OneToOne(targetEntity="RecieverGroup",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="reciever_id", referencedColumnName="id")
     *
     * @var RecieverGroupInterface
     */
    protected $recieverGroup;

    /**
     * @ORM\Column(type="boolean",name="`grant`")
     *
     * @var bool
     */
    protected $grant;

    /**
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     *
     * @var NodeInterface
     */
    protected $node;

    /**
     * @ORM\Column(name="type", type="RightType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\RightType")
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\OneToOne(targetEntity="AbstractOperation",cascade={"persist"},nullable=true)
     *
     * @var OperationInterface
     */
    protected $condition;

    public function __construct()
    {
        parent::__construct();
        $this->grant = true;
    }

    public function isGranted(NodeInterface $node, string $layer, string $right): bool
    {
        if ($this->layer == $layer && $this->type == $right && $this->checkIfNodeIsReciever($node) && $this->getConditionBoolOrTrue()) {
            return $this->grant;
        }

        return !($this->grant);
    }

    private function getConditionBoolOrTrue(): bool
    {
        if ($this->hasCondition()) {
            return $this->condition->getResult()->getBool();
        }

        return true;
    }

    private function checkIfNodeIsReciever(NodeInterface $node): bool
    {
        return $this->recieverGroup->getAllRecievers()->contains($node);
    }
}
