<?php

namespace App\Entity\Source\Operation;

use App\Logic\Result\ResultInterface;
use App\Logic\Operation\OperandInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\AbstractSource;
use App\Entity\Source\Operation\Attribut\OperandsAttribut;
use App\Exception\NotProcessedException;

/**
 * @author kevinfrantz
 * @ORM\Entity
 * @ORM\Table(name="source_operation")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"and" = "AndOperation"})
 */
abstract class AbstractOperation extends AbstractSource implements OperationInterface
{
    use OperandsAttribut;

    /**
     * The result MUST NOT be saved via Doctrine!
     *
     * @var ResultInterface
     */
    protected $result;

    /**
     * @var ArrayCollection|OperandInterface[]
     */
    protected $operands;

    public function __construct()
    {
        parent::__construct();
        $this->operands = new ArrayCollection();
    }

    public function getResult(): ResultInterface
    {
        if ($this->result) {
            return $this->result;
        }
        throw new NotProcessedException('No result was generated!');
    }
}
