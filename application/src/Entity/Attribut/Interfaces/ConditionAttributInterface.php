<?php

namespace App\Entity\Attribut\Interfaces;

use App\Logic\Operation\OperationInterface;

/**
 * @author kevinfrantz
 */
interface ConditionAttributInterface
{
    public function getCondition(): OperationInterface;

    public function setCondition(OperationInterface $operation): void;

    public function hasCondition(): bool;
}
