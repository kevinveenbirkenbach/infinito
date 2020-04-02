<?php

namespace Infinito\Domain\Action;

/**
 * Offers a function to create an action object by the RequestedActionService.
 *
 * @author kevinfrantz
 */
interface ActionFactoryServiceInterface
{
    public function create(): ActionInterface;
}
