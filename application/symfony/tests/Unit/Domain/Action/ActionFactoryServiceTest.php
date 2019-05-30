<?php

namespace tests\Unit\Domain\Action;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Action\ActionFactoryService;
use Infinito\Domain\Action\ActionDependenciesDAOServiceInterface;
use Infinito\Domain\Action\ActionInterface;
use Infinito\Domain\Request\Action\RequestedAction;
use Infinito\Domain\Request\Right\RequestedRight;
use Infinito\Domain\Layer\LayerActionMap;
use Infinito\Domain\Request\User\RequestedUser;
use Infinito\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 */
class ActionFactoryServiceTest extends TestCase
{
    public function testCreate(): void
    {
        foreach (LayerActionMap::LAYER_ACTION_MAP as $layer => $actions) {
            foreach ($actions as $action) {
                $requestedRight = new RequestedRight();
                $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
                $requestedUser = new RequestedUser($userSourceDirector, $requestedRight);
                $requestedAction = new RequestedAction($requestedUser);
                $actionService = $this->createMock(ActionDependenciesDAOServiceInterface::class);
                $actionService->method('getRequestedAction')->willReturn($requestedAction);
                $actionFactoryService = new ActionFactoryService($actionService);
                $requestedAction->setLayer($layer);
                $requestedAction->setActionType($action);
                $result = $actionFactoryService->create();
                $this->assertInstanceOf(ActionInterface::class, $result);
            }
        }
    }
}
