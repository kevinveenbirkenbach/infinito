<?php

namespace App\Domain\ActionManagement;

/**
 * Offers a function to create an action object by the RequestedActionService.
 *
 * @author kevinfrantz
 */
interface ActionFactoryServiceInterface
{
    /**
     * @return ActionInterface
     */
    public function create(): ActionInterface;
}
