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
use App\Domain\UserManagement\UserSourceDirector;
use App\Repository\Source\SourceRepositoryInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\DBAL\Types\SystemSlugType;
use App\Exception\SetNotPossibleException;
use App\Exception\NotCorrectInstanceException;

/**
 * @author kevinfrantz
 */
class RequestedUserTest extends TestCase
{
    public function testInterface(): void
    {
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertInstanceOf(RequestedRightInterface::class, $requestedUserRightFacade);
    }

    public function testGetters(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $user = $this->createMock(User::class);
        $user->method('getSource')->willReturn($reciever);
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $source = $this->createMock(AbstractSource::class);
        $reciever = $this->createMock(AbstractSource::class);
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $userSourceDirector->method('getUser')->willReturn($user);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn($layer);
        $requestedRight->method('getCrud')->willReturn($type);
        $requestedRight->method('getSource')->willReturn($source);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertEquals($layer, $requestedUserRightFacade->getLayer());
        $this->assertEquals($type, $requestedUserRightFacade->getCrud());
        $this->assertEquals($source, $requestedUserRightFacade->getSource());
        $this->assertEquals($reciever, $requestedUserRightFacade->getReciever());
    }

    public function testSetters(): void
    {
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $requestedSource = $this->createMock(RequestedEntityInterface::class);
        $requestedSource->method('getSlug')->willReturn(SystemSlugType::IMPRINT);
        $requestedSource->method('hasSlug')->willReturn(true);
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $requestedRight = new RequestedRight();
        $user = $this->createMock(User::class);
        $userSourceDirector = new UserSourceDirector($sourceRepository, $user);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertNull($requestedUserRightFacade->setLayer($layer));
        $this->assertNull($requestedUserRightFacade->setCrud($type));
        $this->assertNull($requestedUserRightFacade->setRequestedEntity($requestedSource));
        $this->assertEquals($layer, $requestedRight->getLayer());
        $this->assertEquals($type, $requestedRight->getCrud());
        $this->expectException(NotCorrectInstanceException::class);
        $this->assertNotInstanceOf(RequestedEntityInterface::class, $requestedRight->getSource());
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
