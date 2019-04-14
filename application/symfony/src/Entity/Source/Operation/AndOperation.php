<?php

namespace Infinito\Entity\Source\Operation;

use Infinito\Logic\Result\Result;
use Doctrine\ORM\Mapping as ORM;
use Infinito\Exception\Attribut\UndefinedAttributException;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 *
 * @deprecated
 *
 * @todo move to the logic level!
 * @todo check out what can be recycled
 */
class AndOperation extends AbstractOperation implements AndOperationInterface
{
    public function process(): void
    {
        if ($this->operands->isEmpty()) {
            throw new UndefinedAttributException('Operands must be defined!');
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
