<?php

namespace Infinito\Logic\Operation;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface OperationInterface extends OperandInterface
{
    /**
     * Sets the Operators the operation has to deal with.
     *
     * @param Collection $operands | OperandInterface[]
     */
    public function setOperands(Collection $operands): void;

    /**
     * Process the logic.
     */
    public function process(): void;
}
