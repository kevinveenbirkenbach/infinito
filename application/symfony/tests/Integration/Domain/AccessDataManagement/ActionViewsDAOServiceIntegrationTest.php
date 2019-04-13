<?php

namespace tests\Unit\Domain\TemplateManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Exception\NoValidChoiceException;
use Infinito\Exception\NotSetException;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\Domain\DataAccessManagement\ActionsViewsDAOServiceInterface;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOService;
use Infinito\Domain\DataAccessManagement\ActionsViewsDAOService;
use Infinito\Entity\EntityInterface;
use Infinito\Logic\Result\ResultInterface;

/**
 * @author kevinfrantz
 */
class ActionViewsDAOServiceIntegrationTest extends TestCase
{
    /**
     * @var ActionsViewsDAOServiceInterface
     */
    private $actionsViewsDAO;

    /**
     * @var ActionsResultsDAOService
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
        $this->actionsViewsDAO = new ActionsViewsDAOService($this->actionsResultsDAO);
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
        $this->actionsViewsDAO->getData('1231232N');
    }

    public function testNotSetGetException(): void
    {
        $this->expectException(NotSetException::class);
        $this->actionsViewsDAO->getData(ActionType::READ);
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

    /**
     * @todo implement test!
     *
     * @param string $actionType
     *
     * @return string
     */
    private function getActionTypeViewDataMock(string $actionType): string
    {
        switch (ActionType::class) {
            case ActionType::READ:
            case ActionType::CREATE:
            case ActionType::UPDATE:
            case ActionType::DELETE:
            case ActionType::EXECUTE:
        }
    }

    public function testAccessors(): void
    {
        foreach (ActionType::getValues() as $actionType) {
            $this->assertFalse($this->actionsViewsDAO->isDataStored($actionType));
            $resultData = $this->getActionTypeResultDataMock($actionType);
            $this->assertNull($this->actionsResultsDAO->setData($actionType, $resultData));
            $this->assertTrue($this->actionsViewsDAO->isDataStored($actionType));
//             $viewDataInterface = $this->getActionTypeViewDataMock($actionType);
//             $this->assertInstanceOf($viewDataInterface, $this->actionsViewsDAO->getData($actionType));
        }
        $this->expectException(AllreadySetException::class);
        $this->assertNull($this->actionsResultsDAO->setData($actionType, $resultData));
    }
}
