<?php

namespace tests\Unit\Domain\ActionManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\ActionManagement\ActionFactoryService;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionInterface;
use Infinito\Domain\RequestManagement\Action\RequestedAction;
use Infinito\Domain\RequestManagement\Right\RequestedRight;
use Infinito\Domain\LayerManagement\LayerActionMap;
use Infinito\Domain\RequestManagement\User\RequestedUser;
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
                $actionService = $this->createMock(ActionServiceInterface::class);
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
