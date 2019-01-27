<?php

namespace tests\Unit\Domain\ActionManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionService;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceTest extends TestCase
{
    public function testIsRequestedActionSecure()
    {
        $requestedAction = $this->createMock(RequestedActionInterface::class);
        $secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerInterface::class);
        $secureRequestedRightChecker->method('check')->willReturn(true);
        $actionService = new ActionService($requestedAction, $secureRequestedRightChecker);
        $this->assertTrue($actionService->isRequestedActionSecure());
    }

    public function testRequestedActionGetter()
    {
        $requestedAction = $this->createMock(RequestedActionInterface::class);
        $secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerInterface::class);
        $actionService = new ActionService($requestedAction, $secureRequestedRightChecker);
        $this->assertInstanceOf(RequestedActionInterface::class, $actionService->getRequestedAction());
    }
}
