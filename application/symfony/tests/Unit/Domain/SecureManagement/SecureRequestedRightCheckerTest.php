<?php

namespace tests\Unit\Domain\SecureManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\AbstractSource;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Entity\Meta\Right;
use Infinito\Domain\RequestManagement\Right\RequestedRight;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerService;
use Infinito\Domain\RightManagement\RightTransformerService;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;

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
        $right->setActionType($crud);
        $right->setReciever($reciever);
        $source->getLaw()->getRights()->add($right);
        $requestedRight = new RequestedRight();
        $requestedRight->setActionType($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setReciever($reciever);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasId')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($source);
        $requestedEntity->method('hasIdentity')->willReturn(true);
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
        $right->setActionType(CRUDType::CREATE);
        $right->setReciever($reciever);
        $source->getLaw()->getRights()->add($right);
        $requestedRight = new RequestedRight();
        $requestedRight->setActionType($crud);
        $requestedRight->setLayer($layer);
        $requestedRight->setReciever($reciever);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasId')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($source);
        $requestedEntity->method('hasIdentity')->willReturn(true);
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
        $requestedRight->method('getActionType')->willReturn($crud);
        $requestedRight->method('getLayer')->willReturn($layer);
        $requestedRight->method('getReciever')->willReturn($reciever);
        $requestedRight->method('getSource')->willReturn($source);
        $rightTransformerService = new RightTransformerService();
        $secureEntityChecker = new SecureRequestedRightCheckerService($rightTransformerService);
        $this->assertFalse($secureEntityChecker->check($requestedRight));
        $right = new Right();
        $right->setActionType($crud);
        $right->setLayer($layer);
        $right->setSource($source);
        $source->getLaw()->getRights()->add($right);
        $this->assertTrue($secureEntityChecker->check($requestedRight));
        $right->setReciever(new class() extends AbstractSource {
        });
        $this->assertFalse($secureEntityChecker->check($requestedRight));
    }
}
