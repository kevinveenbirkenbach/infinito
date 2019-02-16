<?php

namespace App\Domain\ActionManagement;

use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface ActionInterface
{
    /**
     * Executes the action.
     *
     * @return EntityInterface|EntityInterface[]|null
     */
    public function execute();
}
