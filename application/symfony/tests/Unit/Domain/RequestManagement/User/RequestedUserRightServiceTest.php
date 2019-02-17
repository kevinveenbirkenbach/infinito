<?php

namespace tests\Unit\Domain\RequestManagement\User;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\User\RequestedUserService;
use Infinito\Domain\UserManagement\UserSourceDirectorServiceInterface;
use Infinito\Domain\RequestManagement\User\RequestedUserServiceInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightServiceInterface;

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
