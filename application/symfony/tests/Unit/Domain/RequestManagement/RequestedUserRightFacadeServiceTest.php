<?php

namespace tests\Unit\Domain\RequestManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\RequestedUserRightFacadeService;
use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\Domain\RequestManagement\RequestedUserRightFacadeServiceInterface;
use App\Domain\RequestManagement\RequestedRightServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedUserRightFacadeServiceTest extends TestCase
{
    public function testConstructorSet(): void
    {
        $requestedRightService = $this->createMock(RequestedRightServiceInterface::class);
        $userSourceDirectorService = $this->createMock(UserSourceDirectorServiceInterface::class);
        $service = new RequestedUserRightFacadeService($userSourceDirectorService, $requestedRightService);
        $this->assertInstanceOf(RequestedUserRightFacadeServiceInterface::class, $service);
    }
}
