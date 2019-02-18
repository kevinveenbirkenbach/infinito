<?php

namespace tests\Unit\Domain\RequestManagement\Action;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRight;
use Infinito\Domain\RequestManagement\Action\RequestedAction;
use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Repository\Source\SourceRepositoryInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\UserManagement\UserSourceDirector;
use Infinito\Domain\RequestManagement\User\RequestedUser;
use Infinito\Entity\Source\Complex\UserSourceInterface;

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
        $this->assertEquals(CRUDType::READ, $this->requestedRight->getCrud());
    }

    public function testCrud(): void
    {
        foreach (CRUDType::getChoices() as $crud) {
            $this->action->setActionType($crud);
            $this->assertEquals($crud, $this->action->getActionType());
            $this->assertEquals($crud, $this->requestedRight->getCrud());
        }
    }

    public function testLayer(): void
    {
        foreach (LayerType::getChoices() as $LayerType) {
            $this->action->setLayer($LayerType);
            $this->assertEquals($LayerType, $this->action->getLayer());
            $this->assertEquals($LayerType, $this->requestedRight->getLayer());
        }
    }
}
