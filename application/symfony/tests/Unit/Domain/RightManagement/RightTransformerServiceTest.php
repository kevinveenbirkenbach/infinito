<?php

namespace tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Right\RequestedRight;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\RightManagement\RightTransformerService;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;

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
