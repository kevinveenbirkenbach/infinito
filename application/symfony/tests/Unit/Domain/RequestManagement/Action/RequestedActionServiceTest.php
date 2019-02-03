<?php

namespace tests\Unit\Domain\RequestManagement\Action;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Action\RequestedActionService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\Domain\RequestManagement\User\RequestedUserServiceInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedUserService = $this->createMock(RequestedUserServiceInterface::class);
        $service = new RequestedActionService($userSourceDirector, $requestedUserService);
        $this->assertInstanceOf(RequestedActionServiceInterface::class, $service);
    }
}
