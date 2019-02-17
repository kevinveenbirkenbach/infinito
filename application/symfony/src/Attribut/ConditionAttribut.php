<?php

namespace Infinito\Attribut;

use Infinito\Logic\Operation\OperationInterface;

/**
 * @author kevinfrantz
 */
trait ConditionAttribut
{
    /**
     * @var OperationInterface
     */
    protected $condition;

    public function getCondition(): OperationInterface
    {
        return $this->condition;
    }

    public function setCondition(OperationInterface $condition): void
    {
        $this->condition = $condition;
    }

    public function hasCondition(): bool
    {
        return $this->condition instanceof OperationInterface;
    }
}
