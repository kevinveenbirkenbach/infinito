<?php

namespace App\Entity\Source\Operation;

use App\Logic\Operation\OperandInterface;
use App\Logic\Result\Result;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_operation_and")
 * @ORM\Entity()
 */
final class AndOperation extends AbstractOperation
{
    public function process(): void
    {
        if ($this->operands->isEmpty()) {
            throw new \Exception('Operands must be defined!');
        }
        $this->result = new Result();
        /*
         * @var OperandInterface
         */
        foreach ($this->operands->toArray() as $operand) {
            if (!$operand->getResult()->getBool()) {
                $this->result->setAll(false);

                return;
            }
        }
        $this->result->setAll(true);
    }
}
