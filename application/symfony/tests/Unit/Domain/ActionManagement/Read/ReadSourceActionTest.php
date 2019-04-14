<?php

namespace tests\Unit\Domain\SecureCRUDManagement\CRUD\Read;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Infinito\Domain\ActionManagement\Read\ReadAction;
use Infinito\Domain\ActionManagement\ActionDAOServiceInterface;
use Infinito\Domain\ActionManagement\Read\ReadActionInterface;
use Infinito\Exception\NotSecureException;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;

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
     * @var ActionDAOServiceInterface
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
        $this->actionService = $this->createMock(ActionDAOServiceInterface::class);
        $this->actionService->method('getEntityManager')->willReturn($this->entityManager);
        $this->actionService->method('getRequestedAction')->willReturn($this->requestedAction);
        $this->sourceReadAction = new ReadAction($this->actionService);
    }

    public function testNotSecureException(): void
    {
        $this->actionService->method('isRequestedActionSecure')->willReturn(false);
        $this->expectException(NotSecureException::class);
        $this->sourceReadAction->execute();
    }

    public function testGranted(): void
    {
        $this->actionService->method('isRequestedActionSecure')->willReturn(true);
        $result = $this->sourceReadAction->execute();
        $this->assertEquals($this->entity, $result);
    }
}
