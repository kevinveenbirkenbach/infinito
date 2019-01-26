<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Entity\RequestedEntity;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Exception\NotSetException;
use App\Exception\NotCorrectInstanceException;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Repository\RepositoryInterface;
use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
class RequestedEntityTest extends TestCase
{
    public function testSetByIdentity(): void
    {
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $requestedEntity = new RequestedEntity($layerRepositoryFactoryService);
        $slug = 'test';
        $requestedEntity->setIdentity($slug);
        $this->assertEquals($slug, $requestedEntity->getSlug());
        $this->assertFalse($requestedEntity->hasId());
        $id = 123;
        $requestedEntity->setIdentity($id);
        $this->assertEquals($id, $requestedEntity->getId());
        $this->assertFalse($requestedEntity->hasSlug());
    }

    public function testNotSetExeptionIdSlug(): void
    {
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $requestedEntity = new RequestedEntity($layerRepositoryFactoryService);
        $this->expectException(NotSetException::class);
        $requestedEntity->getEntity();
    }

    public function testNotCorrectInstanceException(): void
    {
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $layerRepositoryFactoryService->method('getRepository')->willReturn($this->createMock(RepositoryInterface::class));
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn(LayerType::LAW);
        $requestedEntity = new RequestedEntity($layerRepositoryFactoryService);
        $requestedEntity->setSlug('abcd');
        $requestedEntity->setRequestedRight($requestedRight);
        $this->expectException(NotCorrectInstanceException::class);
        $requestedEntity->getEntity();
    }

    public function testLoadById(): void
    {
        $entityMock = $this->createMock(EntityInterface::class);
        $repository = $this->createMock(RepositoryInterface::class);
        $repository->method('find')->willReturn($entityMock);
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $layerRepositoryFactoryService->method('getRepository')->willReturn($repository);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn(LayerType::LAW);
        $requestedEntity = new RequestedEntity($layerRepositoryFactoryService);
        $requestedEntity->setId(123);
        $requestedEntity->setRequestedRight($requestedRight);
        $entityResult = $requestedEntity->getEntity();
        $this->assertEquals($entityMock, $entityResult);
    }
}
