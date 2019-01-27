<?php

namespace tests\Unit\Domain\SecureManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Meta\Right;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Domain\SecureManagement\SecureEntityChecker;
use App\Domain\RightManagement\RightTransformerService;

class SecureEntityCheckerTest extends TestCase
{
    public function testGranted(): void
    {
        $reciever = new class() extends AbstractSource {
        };
        $layer = LayerType::SOURCE;
        $crud = CRUDType::READ;
        $source = new class() extends AbstractSource {
        };
        $right = new Right();
        $right->setSource($source);
        $right->setLayer($layer);
        $right->setCrud($crud);
        $right->setReciever($reciever);
        $source->getLaw()->getRights()->add($right);
        $requestedRight = new RequestedRight();
        $requestedRight->setCrud($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setReciever($reciever);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasId')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($source);
        $requestedRight->setRequestedEntity($requestedEntity);
        $rightTransformerService = new RightTransformerService();
        $secureEntityChecker = new SecureEntityChecker($rightTransformerService);
        $result = $secureEntityChecker->check($requestedRight);
        $this->assertTrue($result);
    }

    public function testNotGranted(): void
    {
        $reciever = new class() extends AbstractSource {
        };
        $layer = LayerType::SOURCE;
        $crud = CRUDType::READ;
        $source = new class() extends AbstractSource {
        };
        $right = new Right();
        $right->setSource($source);
        $right->setLayer($layer);
        $right->setCrud(CRUDType::CREATE);
        $right->setReciever($reciever);
        $source->getLaw()->getRights()->add($right);
        $requestedRight = new RequestedRight();
        $requestedRight->setCrud($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setReciever($reciever);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasId')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($source);
        $requestedRight->setRequestedEntity($requestedEntity);
        $rightTransformerService = new RightTransformerService();
        $secureEntityChecker = new SecureEntityChecker($rightTransformerService);
        $result = $secureEntityChecker->check($requestedRight);
        $this->assertFalse($result);
    }
}
