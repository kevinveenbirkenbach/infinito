<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionFactoryServiceInterface;
use App\Domain\ActionManagement\ActionFactoryService;
use App\Domain\ActionManagement\ActionServiceInterface;
use App\Domain\ActionManagement\ActionInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\RequestManagement\Action\RequestedAction;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Domain\LayerManagement\LayerActionMap;
use App\Domain\RequestManagement\User\RequestedUser;
use App\Domain\UserManagement\UserSourceDirectorInterface;

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
