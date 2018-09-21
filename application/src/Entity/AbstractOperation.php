<?php
namespace App\Entity;

use App\Logic\Result\ResultInterface;
use App\Logic\Operation\OperationInterface;
use App\Logic\Operation\OperandInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractOperation extends AbstractSource implements OperationInterface
{
    
    /**
     * The result MUST NOT be saved via Doctrine!
     * @var ResultInterface
     */
    protected $result;
    
    /**
     * @var ArrayCollection|OperandInterface[]
     */
    protected $operands;
    
    public function getResult(): ResultInterface
    {
        return $this->result;
    }
    
    public function setOperators(ArrayCollection $operands): void
    {
        $this->operands = $operands;
    }
}

