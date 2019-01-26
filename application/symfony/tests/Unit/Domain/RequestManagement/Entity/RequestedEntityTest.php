<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Entity\RequestedEntity;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;

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
}
