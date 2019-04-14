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
     * @todo Implement that also results can be returned
     *
     * @return EntityInterface|null
     */
    public function execute(): ?EntityInterface;
}
