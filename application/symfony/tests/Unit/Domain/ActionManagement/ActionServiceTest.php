<?php

namespace tests\Unit\Domain\ActionManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionService;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\FormManagement\EntityFormBuilderServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\ActionManagement\ActionServiceInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceTest extends TestCase
{
    /**
     * @var RequestedActionInterface
     */
    private $requestedAction;

    /**
     * @var SecureRequestedRightCheckerInterface
     */
    private $secureRequestedRightChecker;

    /**
     * @var EntityFormBuilderServiceInterface
     */
    private $entityFormBuilderService;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * @var ActionServiceInterface
     */
    private $actionService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function setUp(): void
    {
        $this->requestedAction = $this->createMock(RequestedActionInterface::class);
        $this->secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerInterface::class);
        $this->entityFormBuilderService = $this->createMock(EntityFormBuilderServiceInterface::class);
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->actionService = new ActionService($this->requestedAction, $this->secureRequestedRightChecker, $this->requestStack, $this->layerRepositoryFactoryService, $this->entityFormBuilderService, $this->entityManager);
    }

    public function testIsRequestedActionSecure()
    {
        $this->secureRequestedRightChecker->method('check')->willReturn(true);
        $this->assertTrue($this->actionService->isRequestedActionSecure());
    }

    public function testRequestedActionGetter()
    {
        $this->assertInstanceOf(RequestedActionInterface::class, $this->actionService->getRequestedAction());
    }
}
