<?php

namespace Infinito\Domain\ActionManagement;

/**
 * This class just containes the constructor
 * It is used by concrete actions and the factory.
 *
 * @author kevinfrantz
 */
abstract class AbstractActionConstructor
{
    /**
     * @var ActionDAOServiceInterface
     */
    protected $actionService;

    /**
     * @param ActionDAOServiceInterface $actionService
     */
    final public function __construct(ActionDAOServiceInterface $actionService)
    {
        $this->actionService = $actionService;
    }
}
