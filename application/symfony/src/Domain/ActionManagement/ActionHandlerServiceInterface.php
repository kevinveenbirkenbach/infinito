<?php

namespace Infinito\Domain\ActionManagement;

use Infinito\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface ActionHandlerServiceInterface
{
    /**
     * Process an action an returns the results.
     *
     * @return EntityInterface|EntityInterface[]
     */
    public function handle();
}
