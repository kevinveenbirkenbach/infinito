<?php

namespace App\Domain\ActionManagement;

/**
 * This class just containes the constructor
 * It is used by concrete actions and the factory.
 *
 * @author kevinfrantz
 */
abstract class AbstractActionConstructor
{
    /**
     * @var ActionServiceInterface
     */
    protected $actionService;

    /**
     * @param ActionServiceInterface $actionService
     */
    final public function __construct(ActionServiceInterface $actionService)
    {
        $this->actionService = $actionService;
    }
}
