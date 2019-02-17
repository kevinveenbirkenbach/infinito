<?php

namespace Infinito\Entity\Source\Operation;

use Infinito\Logic\Result\ResultInterface;
use Infinito\Logic\Operation\OperandInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Source\Operation\Attribut\OperandsAttribut;
use Infinito\Exception\NotProcessedException;

/**
 * @author kevinfrantz
 * @ORM\Entity
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
