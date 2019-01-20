<?php

namespace tests\Unit\Domain\RequestManagement\Action;

use PHPUnit\Framework\TestCase;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\Domain\RequestManagement\Action\RequestedAction;
use App\DBAL\Types\ActionType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Repository\Source\SourceRepositoryInterface;

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
        $sourceRepository = $this->createMock(SourceRepositoryInterface::class);
        $this->requestedRight = new RequestedRight($sourceRepository);
        $this->action = new RequestedAction($this->requestedRight);
    }

    public function testList(): void
    {
        $list = ActionType::LIST;
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
}
