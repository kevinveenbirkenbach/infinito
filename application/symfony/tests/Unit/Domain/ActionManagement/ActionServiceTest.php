<?php

namespace tests\Unit\Domain\ActionManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionService;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\ActionManagement\ActionServiceInterface;
use App\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use PHPUnit\Framework\MockObject\MockObject;
use App\Entity\EntityInterface;
use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceTest extends TestCase
{
    /**
     * @var RequestedActionServiceInterface|MockObject
     */
    private $requestedActionService;

    /**
     * @var SecureRequestedRightCheckerInterface|MockObject
     */
    private $secureRequestedRightChecker;

    /**
     * @var RequestedActionFormBuilderServiceInterface|MockObject
     */
    private $requestedActionFormBuilderService;

    /**
     * @var RequestStack|MockObject
     */
    private $requestStack;

    /**
     * @var LayerRepositoryFactoryServiceInterface|MockObject
     */
    private $layerRepositoryFactoryService;

    /**
     * @var ActionServiceInterface
     */
    private $actionService;

    /**
     * @var EntityManagerInterface|MockObject
     */
    private $entityManager;

    /**
     * @var RequestedEntityInterface|MockObject
     */
    private $requestedEntity;

    /**
     * @var EntityInterface|MockObject
     */
    private $entity;

    public function setUp(): void
    {
        $this->entity = $this->createMock(EntityInterface::class);

        $this->requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $this->requestedEntity->method('getEntity')->willReturn($this->entity);

        $this->requestedActionService = $this->createMock(RequestedActionServiceInterface::class);
        $this->requestedActionService->method('getRequestedEntity')->willReturn($this->requestedEntity);

        $this->secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerInterface::class);
        $this->requestedActionFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->actionService = new ActionService($this->requestedActionService, $this->secureRequestedRightChecker, $this->requestStack, $this->layerRepositoryFactoryService, $this->requestedActionFormBuilderService, $this->entityManager);
    }

    public function testIsRequestedActionSecure(): void
    {
        $this->secureRequestedRightChecker->method('check')->willReturn(true);
        $this->assertTrue($this->actionService->isRequestedActionSecure());
    }

    public function testRequestedActionGetter(): void
    {
        $this->assertInstanceOf(RequestedActionInterface::class, $this->actionService->getRequestedAction());
    }

    public function testGetEntityManager(): void
    {
        $this->assertEquals($this->entityManager, $this->actionService->getEntityManager());
    }

    public function testGetRepository(): void
    {
        $repository = $this->createMock(RepositoryInterface::class);
        $this->layerRepositoryFactoryService->method('getRepository')->willReturn($repository);
        $result = $this->actionService->getRepository();
        $this->assertEquals($repository, $result);
    }

    public function testGetRequest(): void
    {
        $request = $this->createMock(Request::class);
        $this->requestStack->method('getCurrentRequest')->willReturn($request);
        $result = $this->actionService->getRequest();
        $this->assertEquals($request, $result);
    }

    public function testGetCurrentFormBuilder(): void
    {
        $form = $this->createMock(FormBuilderInterface::class);
        $this->requestedActionFormBuilderService->method('createByService')->willReturn($form);
        $result = $this->actionService->getCurrentFormBuilder();
        $this->assertEquals($form, $result);
    }
}
