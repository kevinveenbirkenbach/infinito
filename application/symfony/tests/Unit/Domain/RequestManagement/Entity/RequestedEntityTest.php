<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Entity\RequestedEntity;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Infinito\Exception\NotSetException;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Repository\RepositoryInterface;
use Infinito\Entity\EntityInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Exception\AllreadyDefinedException;

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
        $this->assertEquals(get_class($entityMock), $requestedEntity->getClass());
        $this->expectException(AllreadyDefinedException::class);
        $requestedEntity->setClass(AbstractSource::class);
    }

    public function testSetClass(): void
    {
        $class = AbstractSource::class;
        $entityMock = $this->createMock(EntityInterface::class);
        $repository = $this->createMock(RepositoryInterface::class);
        $repository->method('find')->willReturn($entityMock);
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $layerRepositoryFactoryService->method('getRepository')->willReturn($repository);
        $requestedEntity = new RequestedEntity($layerRepositoryFactoryService);
        $this->assertFalse($requestedEntity->hasClass());
        $this->assertNull($requestedEntity->setClass($class));
        $this->assertTrue($requestedEntity->hasClass());
        $this->assertEquals($class, $requestedEntity->getClass());
        $this->expectException(AllreadyDefinedException::class);
        $requestedEntity->setIdentity('123343');
    }

    public function testValidateLayerRepositoryFactoryService(): void
    {
        $requestedEntity = new RequestedEntity();
        $requestedEntity->setSlug('ABABEBA');
        $this->expectException(NotSetException::class);
        $requestedEntity->getEntity();
    }
}
