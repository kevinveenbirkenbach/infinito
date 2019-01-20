<?php

namespace tests\Unit\Domain\RequestManagement\Action;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Right\RequestedRightServiceInterface;
use App\Domain\RequestManagement\Action\RequestedActionService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $requestedRightService = $this->createMock(RequestedRightServiceInterface::class);
        $service = new RequestedActionService($requestedRightService);
        $this->assertInstanceOf(RequestedActionServiceInterface::class, $service);
    }
}
