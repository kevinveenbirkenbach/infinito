<?php

namespace Infinito\Domain\Action;

use Infinito\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface ActionHandlerServiceInterface
{
    /**
     * Process an action an returns the results.
     *
     * @todo Implement that also results can be returned
     *
     * @return EntityInterface|null
     */
    public function handle(): ?EntityInterface;
}
