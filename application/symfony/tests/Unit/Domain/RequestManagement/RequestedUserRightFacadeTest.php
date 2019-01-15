<?php

namespace tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Domain\RequestManagement\RequestedUserRightFacade;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Source\AbstractSource;
use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Domain\RequestManagement\RequestedRightInterface;
use App\Domain\RequestManagement\RequestedRight;
use App\Domain\UserManagement\UserSourceDirector;
use App\Repository\Source\SourceRepositoryInterface;
use App\Domain\RequestManagement\RequestedSourceInterface;
use App\DBAL\Types\SystemSlugType;
use App\Exception\NotSetException;
use App\Exception\SetNotPossibleException;

/**
 * @author kevinfrantz
 */
class RequestedUserRightFacadeTest extends TestCase
{
    public function testInterface(): void
    {
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUserRightFacade($userSourceDirector, $requestedRight);
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
        $requestedRight->method('getType')->willReturn($type);
        $requestedRight->method('getSource')->willReturn($source);
        $requestedUserRightFacade = new RequestedUserRightFacade($userSourceDirector, $requestedRight);
        $this->assertEquals($layer, $requestedUserRightFacade->getLayer());
        $this->assertEquals($type, $requestedUserRightFacade->getType());
        $this->assertEquals($source, $requestedUserRightFacade->getSource());
        $this->assertEquals($reciever, $requestedUserRightFacade->getReciever());
    }

    public function testSetters(): void
    {
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $requestedSource = $this->createMock(RequestedSourceInterface::class);
        $requestedSource->method('getSlug')->willReturn(SystemSlugType::IMPRINT);
        $requestedSource->method('hasSlug')->willReturn(true);
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $requestedRight = new RequestedRight($sourceRepository);
        $user = $this->createMock(User::class);
        $userSourceDirector = new UserSourceDirector($sourceRepository, $user);
        $requestedUserRightFacade = new RequestedUserRightFacade($userSourceDirector, $requestedRight);
        $this->assertNull($requestedUserRightFacade->setLayer($layer));
        $this->assertNull($requestedUserRightFacade->setType($type));
        $this->assertNull($requestedUserRightFacade->setRequestedSource($requestedSource));
        $this->assertEquals($layer, $requestedRight->getLayer());
        $this->assertEquals($type, $requestedRight->getType());
        $this->expectException(NotSetException::class);
        $this->assertNotInstanceOf(RequestedSourceInterface::class, $requestedRight->getSource());
    }

    public function testSetReciever(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUserRightFacade($userSourceDirector, $requestedRight);
        $this->expectException(SetNotPossibleException::class);
        $requestedUserRightFacade->setReciever($reciever);
    }
}
