<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Entity\RequestedEntity;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Repository\RepositoryInterface;
use Infinito\Entity\EntityInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Exception\Attribut\UndefinedAttributException;
use Infinito\Exception\Core\NoIdentityCoreException;
use Infinito\Exception\Attribut\AllreadyDefinedAttributException;
use Infinito\Exception\Core\NotCorrectInstanceCoreException;

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
        $this->expectException(NoIdentityCoreException::class);
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
        $this->expectException(NotCorrectInstanceCoreException::class);
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
        $this->expectException(AllreadyDefinedAttributException::class);
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
        $this->expectException(AllreadyDefinedAttributException::class);
        $requestedEntity->setIdentity('123343');
    }

    public function testValidateLayerRepositoryFactoryService(): void
    {
        $requestedEntity = new RequestedEntity();
        $requestedEntity->setSlug('ABABEBA');
        $this->expectException(UndefinedAttributException::class);
        $requestedEntity->getEntity();
    }
}
