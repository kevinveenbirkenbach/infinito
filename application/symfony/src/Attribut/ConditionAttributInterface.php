<?php

namespace Infinito\Attribut;

use Infinito\Logic\Operation\OperationInterface;

/**
 * @author kevinfrantz
 */
interface ConditionAttributInterface
{
    public function getCondition(): OperationInterface;

    public function setCondition(OperationInterface $operation): void;

    public function hasCondition(): bool;
}
