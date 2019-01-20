<?php

namespace tests\Unit\Domain\RightManagement\User;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Domain\RequestManagement\User\RequestedUser;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Source\AbstractSource;
use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Repository\Source\SourceRepositoryInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\DBAL\Types\SystemSlugType;
use App\Exception\SetNotPossibleException;
use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\Right\AbstractRequestedRightFacade;

/**
 * @author kevinfrantz
 */
class AbstractRequestedRightFacadeTest extends TestCase
{
    private function getRequestedRightFacade(RequestedRightInterface $requestedRight): AbstractRequestedRightFacade
    {
        return new class($requestedRight) extends AbstractRequestedRightFacade {
//             public function __construct(RequestedRightInterface $requestedRight){
//                 $this->requestedRight = $requestedRight;
//             }
        };
    }

    public function testGetters(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $user = $this->createMock(User::class);
        $user->method('getSource')->willReturn($reciever);
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $source = $this->createMock(AbstractSource::class);
        $reciever = $this->createMock(AbstractSource::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn($layer);
        $requestedRight->method('getCrud')->willReturn($type);
        $requestedRight->method('getSource')->willReturn($source);
        $requestedRight->method('getReciever')->willReturn($reciever);
        $requestedRight->method('getRequestedEntity')->willReturn($requestedEntity);
        $requestedRightFacade = $this->getRequestedRightFacade($requestedRight);
        $this->assertEquals($layer, $requestedRightFacade->getLayer());
        $this->assertEquals($type, $requestedRightFacade->getCrud());
        $this->assertEquals($source, $requestedRightFacade->getSource());
        $this->assertEquals($reciever, $requestedRightFacade->getReciever());
        $this->assertEquals($requestedEntity, $requestedRightFacade->getRequestedEntity());
    }

    public function testSetters(): void
    {
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $reciever = $this->createMock(SourceInterface::class);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('getSlug')->willReturn(SystemSlugType::IMPRINT);
        $requestedEntity->method('hasSlug')->willReturn(true);
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $requestedRight = new RequestedRight($sourceRepository);
        $requestedRightFacade = $this->getRequestedRightFacade($requestedRight);
        $this->assertNull($requestedRightFacade->setLayer($layer));
        $this->assertNull($requestedRightFacade->setCrud($type));
        $this->assertNull($requestedRightFacade->setRequestedEntity($requestedEntity));
        $this->assertNull($requestedRightFacade->setReciever($reciever));
        $this->assertEquals($layer, $requestedRight->getLayer());
        $this->assertEquals($type, $requestedRight->getCrud());
        $this->assertEquals($requestedEntity, $requestedRight->getRequestedEntity());
        $this->assertEquals($reciever, $requestedRight->getReciever());
    }

    public function testSetReciever(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->expectException(SetNotPossibleException::class);
        $requestedUserRightFacade->setReciever($reciever);
    }
}
