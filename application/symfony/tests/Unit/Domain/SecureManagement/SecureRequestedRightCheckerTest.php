<?php

namespace tests\Unit\Domain\SecureManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Meta\Right;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerService;
use App\Domain\RightManagement\RightTransformerService;
use App\Domain\RequestManagement\Right\RequestedRightInterface;

/**
 * @author kevinfrantz
 */
class SecureRequestedRightCheckerServiceTest extends TestCase
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
        $secureEntityChecker = new SecureRequestedRightCheckerService($rightTransformerService);
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
        $secureEntityChecker = new SecureRequestedRightCheckerService($rightTransformerService);
        $result = $secureEntityChecker->check($requestedRight);
        $this->assertFalse($result);
    }

    public function testRightAppliesToAll(): void
    {
        $reciever = new class() extends AbstractSource {
        };
        $layer = LayerType::SOURCE;
        $crud = CRUDType::READ;
        $source = new class() extends AbstractSource {
        };
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getCrud')->willReturn($crud);
        $requestedRight->method('getLayer')->willReturn($layer);
        $requestedRight->method('getReciever')->willReturn($reciever);
        $requestedRight->method('getSource')->willReturn($source);
        $rightTransformerService = new RightTransformerService();
        $secureEntityChecker = new SecureRequestedRightCheckerService($rightTransformerService);
        $this->assertFalse($secureEntityChecker->check($requestedRight));
        $right = new Right();
        $right->setCrud($crud);
        $right->setLayer($layer);
        $right->setSource($source);
        $source->getLaw()->getRights()->add($right);
        $this->assertTrue($secureEntityChecker->check($requestedRight));
        $right->setReciever(new class() extends AbstractSource {
        });
        $this->assertFalse($secureEntityChecker->check($requestedRight));
    }
}
