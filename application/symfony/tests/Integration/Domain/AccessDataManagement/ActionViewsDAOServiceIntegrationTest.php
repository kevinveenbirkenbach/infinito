<?php

namespace tests\Unit\Domain\AccessDataManagement;

use PHPUnit\Framework\TestCase;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\DataAccessManagement\ActionsViewsDAOServiceInterface;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOService;
use Infinito\Domain\DataAccessManagement\ActionsViewsDAOService;
use Infinito\Entity\EntityInterface;
use Infinito\Logic\Result\ResultInterface;
use Infinito\Domain\Form\RequestedActionFormBuilderServiceInterface;
use Infinito\Exception\Type\InvalidChoiceTypeException;
use Infinito\Exception\Collection\NotSetElementException;
use Infinito\Exception\Collection\ContainsElementException;
use Infinito\Exception\Validation\ValueInvalidException;

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
     * @var RequestedActionFormBuilderServiceInterface
     */
    private $requestedActionFormBuilderService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->requestedActionFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
        $this->actionsResultsDAO = new ActionsResultsDAOService();
        $this->actionsViewsDAO = new ActionsViewsDAOService($this->actionsResultsDAO, $this->requestedActionFormBuilderService);
    }

    public function testNotValidChoiceSetException(): void
    {
        $this->expectException(InvalidChoiceTypeException::class);
        $this->actionsResultsDAO->setData('1231232N', ' ');
    }

    public function testNotCorrectInstanceSetException(): void
    {
        $this->expectException(ValueInvalidException::class);
        $data = new class() {
        };
        $this->actionsResultsDAO->setData(ActionType::READ, $data);
    }

    public function testNotValidChoiceGetException(): void
    {
        $this->expectException(InvalidChoiceTypeException::class);
        $this->actionsViewsDAO->getData('1231232N');
    }

    public function testNotSetGetException(): void
    {
        $this->expectException(NotSetElementException::class);
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
        $this->expectException(ContainsElementException::class);
        $this->assertNull($this->actionsResultsDAO->setData($actionType, $resultData));
    }
}
