<?php

namespace tests\Unit\Domain\Request\Action;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Request\Action\RequestedActionService;
use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Infinito\Domain\Request\User\RequestedUserServiceInterface;
use Infinito\Domain\User\UserSourceDirectorInterface;

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
