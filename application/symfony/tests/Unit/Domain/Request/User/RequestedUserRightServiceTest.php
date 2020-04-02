<?php

namespace tests\Unit\Domain\Request\User;

use Infinito\Domain\Request\Right\RequestedRightServiceInterface;
use Infinito\Domain\Request\User\RequestedUserService;
use Infinito\Domain\Request\User\RequestedUserServiceInterface;
use Infinito\Domain\User\UserSourceDirectorServiceInterface;
use PHPUnit\Framework\TestCase;

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
