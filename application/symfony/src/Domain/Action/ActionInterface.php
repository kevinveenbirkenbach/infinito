<?php

namespace Infinito\Domain\Action;

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
     */
    public function execute(): ?EntityInterface;
}
