<?php

namespace tests\Unit\Domain\Right\User;

use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Domain\Request\Right\RequestedRight;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Domain\Request\User\RequestedUser;
use Infinito\Domain\User\UserSourceDirector;
use Infinito\Domain\User\UserSourceDirectorInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\User;
use Infinito\Exception\Collection\NotPossibleSetElementException;
use Infinito\Exception\Core\NotCorrectInstanceCoreException;
use Infinito\Repository\Source\SourceRepositoryInterface;
use PHPUnit\Framework\TestCase;

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
        $requestedRight->method('getActionType')->willReturn($type);
        $requestedRight->method('getSource')->willReturn($source);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertEquals($layer, $requestedUserRightFacade->getLayer());
        $this->assertEquals($type, $requestedUserRightFacade->getActionType());
        $this->assertEquals($source, $requestedUserRightFacade->getSource());
        $this->assertEquals($reciever, $requestedUserRightFacade->getReciever());
    }

    public function testSetters(): void
    {
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $requestedEntitySource = $this->createMock(RequestedEntityInterface::class);
        $requestedEntitySource->method('getSlug')->willReturn(ImpressumFixtureSource::getSlug());
        $requestedEntitySource->method('hasSlug')->willReturn(true);
        $requestedEntitySource->method('hasIdentity')->willReturn(true);
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $requestedRight = new RequestedRight();
        $user = $this->createMock(User::class);
        $userSourceDirector = new UserSourceDirector($sourceRepository, $user);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertNull($requestedUserRightFacade->setLayer($layer));
        $this->assertNull($requestedUserRightFacade->setActionType($type));
        $this->assertNull($requestedUserRightFacade->setRequestedEntity($requestedEntitySource));
        $this->assertEquals($layer, $requestedRight->getLayer());
        $this->assertEquals($type, $requestedRight->getActionType());
        $this->expectException(NotCorrectInstanceCoreException::class);
        $this->assertNotInstanceOf(RequestedEntityInterface::class, $requestedRight->getSource());
    }

    public function testSetReciever(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->expectException(NotPossibleSetElementException::class);
        $requestedUserRightFacade->setReciever($reciever);
    }

    public function testGetUserDirector(): void
    {
        $userSourceDirector = $this->createMock(UserSourceDirectorInterface::class);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedUserRightFacade = new RequestedUser($userSourceDirector, $requestedRight);
        $this->assertEquals($userSourceDirector, $requestedUserRightFacade->getUserSourceDirector());
    }
}
