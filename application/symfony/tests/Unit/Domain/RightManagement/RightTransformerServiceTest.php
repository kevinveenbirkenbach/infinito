<?php

namespace tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Entity\Source\SourceInterface;
use App\Domain\RightManagement\RightTransformerService;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
class RightTransformerServiceTest extends TestCase
{
    public function testTransformation(): void
    {
        $source = $this->createMock(SourceInterface::class);
        $crud = CRUDType::READ;
        $layer = LayerType::SOURCE;
        $reciever = $this->createMock(SourceInterface::class);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasId')->willReturn(123);
        $requestedEntity->method('getEntity')->willReturn($source);
        $requestedEntity->method('hasRequestedRight')->willReturn(true);
        $requestedRight = new RequestedRight();
        $requestedRight->setCrud($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setRequestedEntity($requestedEntity);
        $requestedRight->setReciever($reciever);
        $transformer = new RightTransformerService();
        $right = $transformer->transform($requestedRight);
        $this->assertEquals($crud, $right->getCrud());
        $this->assertEquals($layer, $right->getLayer());
        $this->assertEquals($reciever, $right->getReciever());
        $this->assertEquals($source, $right->getSource());
    }
}
