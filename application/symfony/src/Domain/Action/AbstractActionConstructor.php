<?php

namespace Infinito\Domain\Action;

/**
 * This class just containes the constructor
 * It is used by concrete actions and the factory.
 *
 * @author kevinfrantz
 */
abstract class AbstractActionConstructor
{
    /**
     * @var ActionDependenciesDAOServiceInterface
     */
    protected $actionService;

    /**
     * @param ActionDependenciesDAOServiceInterface $actionService
     */
    final public function __construct(ActionDependenciesDAOServiceInterface $actionService)
    {
        $this->actionService = $actionService;
    }
}
