<?php
namespace App\Entity;

use App\Logic\Operation\OperandInterface;
use App\Logic\Result\Result;

/**
 *
 * @author kevinfrantz
 *        
 */
class AndOperation extends AbstractOperation
{
    public function process(): void
    {
        if($this->operands->isEmpty()){
            throw new \Exception("Operands must be defined!");
        }
        $this->result = new Result();
        /**
         * @var OperandInterface $operand
         */
        foreach ($this->operands->toArray() as $operand){
            if(!$operand->getResult()->getBool()){
                $this->result->setAll(false);
                return;
            }
        }
        $this->result->setAll(true);
    }
}

