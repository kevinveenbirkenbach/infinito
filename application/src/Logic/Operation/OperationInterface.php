<?php
namespace App\Logic\Operation;

use App\Logic\Result\ResultInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
 *
 * @author kevinfrantz
 *        
 */
interface OperationInterface extends OperandInterface
{
    /**
     * Sets the Operators the operation has to deal with
     * @param ArrayCollection $operands | OperandInterface[]
     */
    public function setOperators(ArrayCollection $operands):void;
    
    /**
     * Process the logic
     */
    public function process():void;
}

