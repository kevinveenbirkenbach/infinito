<?php

namespace tests\Integration\Domain\AccessManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Exception\NoValidChoiceException;
use Infinito\Exception\NotSetException;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOService;
use Infinito\Entity\EntityInterface;
use Infinito\Logic\Result\ResultInterface;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOServiceInterface;

/**
 * @author kevinfrantz
 */
class ActionResultsDAOServiceTest extends TestCase
{
    /**
     * @var ActionsResultsDAOServiceInterface
     */
    private $actionsResultsDAO;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->actionsResultsDAO = new ActionsResultsDAOService();
    }

    public function testNotValidChoiceSetException(): void
    {
        $this->expectException(NoValidChoiceException::class);
        $this->actionsResultsDAO->setData('1231232N', ' ');
    }

    public function testNotCorrectInstanceSetException(): void
    {
        $this->expectException(NotCorrectInstanceException::class);
        $data = new class() {
        };
        $this->actionsResultsDAO->setData(ActionType::READ, $data);
    }

    public function testNotValidChoiceGetException(): void
    {
        $this->expectException(NoValidChoiceException::class);
        $this->actionsResultsDAO->getData('1231232N');
    }

    public function testNotSetGetException(): void
    {
        $this->expectException(NotSetException::class);
        $this->actionsResultsDAO->getData(ActionType::READ);
    }

    private function getActionTypeResultDataMock(string $actionType)
    {
        switch ($actionType) {
            case ActionType::READ:
            case ActionType::CREATE:
            case ActionType::UPDATE:
                return $this->createMock(EntityInterface::class);
            case ActionType::DELETE:
                return null;
            case ActionType::EXECUTE:
                return $this->createMock(ResultInterface::class);
        }
    }

    public function testAccessors(): void
    {
        foreach (ActionType::getValues() as $actionType) {
            $this->assertFalse($this->actionsResultsDAO->isDataStored($actionType));
            $resultData = $this->getActionTypeResultDataMock($actionType);
            $this->assertNull($this->actionsResultsDAO->setData($actionType, $resultData));
            $this->assertTrue($this->actionsResultsDAO->isDataStored($actionType));
            $this->assertEquals($resultData, $this->actionsResultsDAO->getData($actionType));
        }
        $this->expectException(AllreadySetException::class);
        $this->assertNull($this->actionsResultsDAO->setData($actionType, $resultData));
    }
}
