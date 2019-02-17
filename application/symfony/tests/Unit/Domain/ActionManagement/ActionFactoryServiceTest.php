<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\ActionManagement\ActionFactoryServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryService;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
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
    /**
     * @var ActionFactoryServiceInterface
     */
    private $actionFactoryService;

    /**
     * @var ActionServiceInterface
     */
    private $actionService;

    /**
     * @var RequestedActionInterface
     */
    private $requestedAction;

    public function setUp(): void
    {
        $requestedRight = new RequestedRight();
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedUser = new RequestedUser($userSourceDirector, $requestedRight);
        $this->requestedAction = new RequestedAction($requestedUser);
        $this->actionService = $this->createMock(ActionServiceInterface::class);
        $this->actionService->method('getRequestedAction')->willReturn($this->requestedAction);
        $this->actionFactoryService = new ActionFactoryService($this->actionService);
    }

    public function testCreate(): void
    {
        foreach (LayerActionMap::LAYER_ACTION_MAP as $layer => $actions) {
            foreach ($actions as $action) {
                $this->requestedAction->setLayer($layer);
                $this->requestedAction->setActionType($action);
                $result = $this->actionFactoryService->create();
                $this->assertInstanceOf(ActionInterface::class, $result);
            }
        }
    }
}
