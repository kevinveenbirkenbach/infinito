<?php

namespace tests\Unit\Domain\RightManagement\User;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\User;
use Infinito\Domain\RequestManagement\User\RequestedUser;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Domain\UserManagement\UserSourceDirectorInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRight;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\RequestManagement\Right\AbstractRequestedRightFacade;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;
use Infinito\Exception\Collection\NotPossibleSetElementException;

/**
 * @author kevinfrantz
 */
class AbstractRequestedRightFacadeTest extends TestCase
{
    /**
     * @param RequestedRightInterface $requestedRight
     *
     * @return AbstractRequestedRightFacade
     */
    private function getRequestedRightFacade(RequestedRightInterface $requestedRight): AbstractRequestedRightFacade
    {
        return new class($requestedRight) extends AbstractRequestedRightFacade {
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
        $requestedRight->method('getActionType')->willReturn($type);
        $requestedRight->method('getSource')->willReturn($source);
        $requestedRight->method('getReciever')->willReturn($reciever);
        $requestedRight->method('getRequestedEntity')->willReturn($requestedEntity);
        $requestedRight->method('hasRequestedEntity')->willReturn(true);
        $requestedRight->method('hasReciever')->willReturn(true);
        $requestedRightFacade = $this->getRequestedRightFacade($requestedRight);
        $this->assertEquals($layer, $requestedRightFacade->getLayer());
        $this->assertEquals($type, $requestedRightFacade->getActionType());
        $this->assertEquals($source, $requestedRightFacade->getSource());
        $this->assertEquals($reciever, $requestedRightFacade->getReciever());
        $this->assertEquals($requestedEntity, $requestedRightFacade->getRequestedEntity());
        $this->assertTrue($requestedRightFacade->hasRequestedEntity());
        $this->assertTrue($requestedRightFacade->hasReciever());
    }

    public function testSetters(): void
    {
        $layer = LayerType::SOURCE;
        $type = CRUDType::READ;
        $reciever = $this->createMock(SourceInterface::class);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('getSlug')->willReturn(ImpressumFixtureSource::getSlug());
        $requestedEntity->method('hasSlug')->willReturn(true);
        $requestedRight = new RequestedRight();
        $requestedRightFacade = $this->getRequestedRightFacade($requestedRight);
        $this->assertNull($requestedRightFacade->setLayer($layer));
        $this->assertNull($requestedRightFacade->setActionType($type));
        $this->assertNull($requestedRightFacade->setRequestedEntity($requestedEntity));
        $this->assertNull($requestedRightFacade->setReciever($reciever));
        $this->assertEquals($layer, $requestedRight->getLayer());
        $this->assertEquals($type, $requestedRight->getActionType());
        $this->assertEquals($requestedEntity, $requestedRight->getRequestedEntity());
        $this->assertEquals($reciever, $requestedRight->getReciever());
        $this->assertTrue($requestedRight->hasReciever());
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
}
