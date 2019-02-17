<?php

namespace tests\Unit\Domain\RequestManagement\Action;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Action\RequestedActionService;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\RequestManagement\User\RequestedUserServiceInterface;
use Infinito\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedUserService = $this->createMock(RequestedUserServiceInterface::class);
        $requestedUserService->method('getUserSourceDirector')->willReturn($userSourceDirector);
        $service = new RequestedActionService($requestedUserService);
        $this->assertInstanceOf(RequestedActionServiceInterface::class, $service);
    }
}
