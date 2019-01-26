<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Entity\RequestedEntity;

/**
 * @author kevinfrantz
 */
class RequestedEntityTest extends TestCase
{
    public function testSetByIdentity(): void
    {
        $requestedEntity = new RequestedEntity();
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
