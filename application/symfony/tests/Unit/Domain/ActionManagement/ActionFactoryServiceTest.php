<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use App\DBAL\Types\Meta\Right\LayerType;
use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionFactoryServiceInterface;
use App\Domain\ActionManagement\ActionFactoryService;
use App\Domain\ActionManagement\ActionServiceInterface;
use App\DBAL\Types\ActionType;
use App\Domain\ActionManagement\ActionInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

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
        $this->requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $this->requestedAction = $this->createMock(RequestedActionInterface::class);
        $this->actionService = $this->createMock(ActionServiceInterface::class);
        $this->actionService->method('getRequestedAction')->willReturn($this->requestedAction);
        $this->actionFactoryService = new ActionFactoryService($this->actionService);
    }

    public function testCreate(): void
    {
        foreach (ActionType::getChoices() as $action) {
            foreach (LayerType::getChoices() as $layer) {
                $this->requestedAction->method('getLayer')->willReturn($layer);
                $this->requestedAction->method('getActionType')->willReturn($action);
                $action = $this->actionFactoryService->create();
                $this->assertInstanceOf(ActionInterface::class, $action);
            }
        }
    }
}
