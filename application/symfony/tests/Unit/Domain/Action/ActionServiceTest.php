<?php

namespace tests\Unit\Domain\Action;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Action\ActionDependenciesDAOService;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;
use Infinito\Domain\Action\ActionDependenciesDAOServiceInterface;
use Infinito\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Infinito\Entity\EntityInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Infinito\Domain\Form\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Infinito\Domain\Secure\SecureRequestedRightCheckerServiceInterface;

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
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

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
     * @var ActionDependenciesDAOServiceInterface
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

        $this->secureRequestedRightCheckerService = $this->createMock(SecureRequestedRightCheckerServiceInterface::class);
        $this->requestedActionFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->actionService = new ActionDependenciesDAOService($this->requestedActionService, $this->secureRequestedRightCheckerService, $this->requestStack, $this->layerRepositoryFactoryService, $this->requestedActionFormBuilderService, $this->entityManager);
    }

    public function testIsRequestedActionSecure(): void
    {
        $this->secureRequestedRightCheckerService->method('check')->willReturn(true);
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
