<?php

namespace Infinito\Logic\Operation;

use Infinito\Logic\Result\ResultInterface;

/**
 * @author kevinfrantz
 */
interface OperandInterface
{
    /**
     * Returns the result of the Operation.
     *
     * @return ResultInterface
     */
    public function getResult(): ResultInterface;
}
