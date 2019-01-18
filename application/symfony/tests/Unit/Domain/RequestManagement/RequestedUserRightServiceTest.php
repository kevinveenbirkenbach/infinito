<?php

namespace tests\Unit\Domain\RequestManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\RequestedUserRightService;
use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\Domain\RequestManagement\RequestedUserRightServiceInterface;
use App\Domain\RequestManagement\RequestedRightServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedUserRightServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $requestedRightService = $this->createMock(RequestedRightServiceInterface::class);
        $userSourceDirectorService = $this->createMock(UserSourceDirectorServiceInterface::class);
        $service = new RequestedUserRightService($userSourceDirectorService, $requestedRightService);
        $this->assertInstanceOf(RequestedUserRightServiceInterface::class, $service);
    }
}
