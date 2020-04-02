<?php

namespace tests\Unit\Domain\SecureCRUDManagement\CRUD\Read;

use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\Action\ActionDependenciesDAOServiceInterface;
use Infinito\Domain\Action\Read\ReadAction;
use Infinito\Domain\Action\Read\ReadActionInterface;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Exception\Permission\NoPermissionException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class ReadSourceActionTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ActionDependenciesDAOServiceInterface
     */
    private $actionService;

    /**
     * @var ReadActionInterface
     */
    private $sourceReadAction;

    /**
     * @var RequestedEntityInterface
     */
    private $requestedEntity;

    /**
     * @var SourceInterface
     */
    private $entity;

    public function setUp(): void
    {
        $this->entity = $this->createMock(SourceInterface::class);
        $this->requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $this->requestedEntity->method('getEntity')->willReturn($this->entity);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->requestedAction = $this->createMock(RequestedActionInterface::class);
        $this->requestedAction->method('getRequestedEntity')->willReturn($this->requestedEntity);
        $this->actionService = $this->createMock(ActionDependenciesDAOServiceInterface::class);
        $this->actionService->method('getEntityManager')->willReturn($this->entityManager);
        $this->actionService->method('getRequestedAction')->willReturn($this->requestedAction);
        $this->sourceReadAction = new ReadAction($this->actionService);
    }

    public function testNotSecureException(): void
    {
        $this->actionService->method('isRequestedActionSecure')->willReturn(false);
        $this->expectException(NoPermissionException::class);
        $this->sourceReadAction->execute();
    }

    public function testGranted(): void
    {
        $this->actionService->method('isRequestedActionSecure')->willReturn(true);
        $result = $this->sourceReadAction->execute();
        $this->assertEquals($this->entity, $result);
    }
}
