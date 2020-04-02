<?php

namespace tests\Unit\Domain\Request\Action;

use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Request\Action\RequestedAction;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Domain\Request\Right\RequestedRight;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Domain\Request\User\RequestedUser;
use Infinito\Domain\User\UserSourceDirector;
use Infinito\Entity\Source\Complex\UserSourceInterface;
use Infinito\Repository\Source\SourceRepositoryInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class RequestedActionTest extends TestCase
{
    /**
     * @var RequestedRightInterface
     */
    private $requestedRight;

    /**
     * @var RequestedActionInterface
     */
    private $action;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $userSource = $this->createMock(UserSourceInterface::class);
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $sourceRepository->method('findOneBySlug')->willReturn($userSource);
        $user = null;
        $userSourceDirector = new UserSourceDirector($sourceRepository, $user);
        $requestedRight = new RequestedRight();
        $this->requestedRight = new RequestedUser($userSourceDirector, $requestedRight);
        $this->action = new RequestedAction($this->requestedRight);
    }

    public function testList(): void
    {
        $list = ActionType::EXECUTE;
        $this->action->setActionType($list);
        $this->assertEquals($list, $this->action->getActionType());
        $this->assertEquals(ActionType::EXECUTE, $this->requestedRight->getActionType());
    }

    public function testCrud(): void
    {
        foreach (ActionType::getValues() as $crud) {
            $userSource = $this->createMock(UserSourceInterface::class);
            $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
            $sourceRepository->method('findOneBySlug')->willReturn($userSource);
            $user = null;
            $userSourceDirector = new UserSourceDirector($sourceRepository, $user);
            $requestedRight = new RequestedRight();
            $this->requestedRight = new RequestedUser($userSourceDirector, $requestedRight);
            $this->action = new RequestedAction($this->requestedRight);
            $this->action->setActionType($crud);
            $this->assertEquals($crud, $this->action->getActionType());
            $this->assertEquals($crud, $this->requestedRight->getActionType());
        }
    }

    public function testLayer(): void
    {
        foreach (LayerType::getValues() as $LayerType) {
            $this->action->setLayer($LayerType);
            $this->assertEquals($LayerType, $this->action->getLayer());
            $this->assertEquals($LayerType, $this->requestedRight->getLayer());
        }
    }
}
