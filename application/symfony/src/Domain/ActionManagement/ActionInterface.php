<?php

namespace Infinito\Domain\ActionManagement;

use Infinito\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface ActionInterface
{
    /**
     * Executes the action.
     *
     * @return EntityInterface|null
     */
    public function execute(): ?EntityInterface;
}
