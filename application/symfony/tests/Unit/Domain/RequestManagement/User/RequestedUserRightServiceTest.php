<?php

namespace tests\Unit\Domain\RequestManagement\User;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\User\RequestedUserService;
use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\Domain\RequestManagement\User\RequestedUserServiceInterface;
use App\Domain\RequestManagement\Right\RequestedRightServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedUserServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $requestedRightService = $this->createMock(RequestedRightServiceInterface::class);
        $userSourceDirectorService = $this->createMock(UserSourceDirectorServiceInterface::class);
        $service = new RequestedUserService($userSourceDirectorService, $requestedRightService);
        $this->assertInstanceOf(RequestedUserServiceInterface::class, $service);
    }
}
