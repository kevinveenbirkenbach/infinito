<?php

namespace App\Logic\Operation;

use App\Logic\Result\ResultInterface;

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
