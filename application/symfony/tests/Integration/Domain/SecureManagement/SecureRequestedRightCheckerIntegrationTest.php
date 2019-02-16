<?php

namespace tests\Integration\Domain\SecureManagement;

use App\Entity\Source\AbstractSource;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Meta\Right;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;

/**
 * @author kevinfrantz
 */
class SecureRequestedRightCheckerServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

    public function setUp(): void
    {
        self::bootKernel();
        $this->secureRequestedRightCheckerService = self::$container->get(SecureRequestedRightCheckerServiceInterface::class);
    }

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
        $result = $this->secureRequestedRightCheckerService->check($requestedRight);
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
        $result = $this->secureRequestedRightCheckerService->check($requestedRight);
        $this->assertFalse($result);
    }
}
