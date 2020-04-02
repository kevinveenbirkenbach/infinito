<?php

namespace tests\Unit\Domain\Right;

use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Domain\Request\Right\RequestedRight;
use Infinito\Domain\Right\RightTransformerService;
use Infinito\Entity\Source\SourceInterface;
use PHPUnit\Framework\TestCase;

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
        $requestedEntity->method('hasIdentity')->willReturn(true);
        $requestedEntity->method('hasRequestedRight')->willReturn(true);
        $requestedRight = new RequestedRight();
        $requestedRight->setActionType($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setRequestedEntity($requestedEntity);
        $requestedRight->setReciever($reciever);
        $transformer = new RightTransformerService();
        $right = $transformer->transform($requestedRight);
        $this->assertEquals($crud, $right->getActionType());
        $this->assertEquals($layer, $right->getLayer());
        $this->assertEquals($reciever, $right->getReciever());
        $this->assertEquals($source, $right->getSource());
    }
}
