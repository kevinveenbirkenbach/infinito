<?php

namespace Infinito\Entity\Source\Operation;

use Infinito\Logic\Result\Result;
use Doctrine\ORM\Mapping as ORM;
use Infinito\Exception\NotDefinedException;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 *
 * @todo move to the logic level!
 */
class AndOperation extends AbstractOperation implements AndOperationInterface
{
    public function process(): void
    {
        if ($this->operands->isEmpty()) {
            throw new NotDefinedException('Operands must be defined!');
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
