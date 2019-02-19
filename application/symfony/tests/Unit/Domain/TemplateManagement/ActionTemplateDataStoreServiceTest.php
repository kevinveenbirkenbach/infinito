<?php

namespace tests\Unit\Domain\TemplateManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreService;
use Infinito\Exception\NoValidChoiceException;
use Infinito\Exception\NotSetException;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\NotCorrectInstanceException;

/**
 * @author kevinfrantz
 */
class ActionTemplateDataStoreServiceTest extends TestCase
{
    /**
     * @var ActionTemplateDataStoreServiceInterface
     */
    private $actionTemplateDataStoreService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->actionTemplateDataStoreService = new ActionTemplateDataStoreService();
    }

    public function testNotValidChoiceSetException(): void
    {
        $this->expectException(NoValidChoiceException::class);
        $this->actionTemplateDataStoreService->setData('1231232N', ' ');
    }

    public function testNotCorrectInstanceSetException(): void
    {
        $this->expectException(NotCorrectInstanceException::class);
        $data = new class() {
        };
        $this->actionTemplateDataStoreService->setData(ActionType::READ, $data);
    }

    public function testNotValidChoiceGetException(): void
    {
        $this->expectException(NoValidChoiceException::class);
        $this->actionTemplateDataStoreService->getData('1231232N');
    }

    public function testNotSetGetException(): void
    {
        $this->expectException(NotSetException::class);
        $this->actionTemplateDataStoreService->getData(ActionType::READ);
    }

    public function testAccessors(): void
    {
        foreach (ActionType::getChoices() as $actionType) {
            $instance = ActionTemplateDataStoreService::ACTION_DATA_MAPPING[$actionType];
            $data = $this->createMock($instance);
            $this->assertFalse($this->actionTemplateDataStoreService->isDataStored($actionType));
            $this->assertNull($this->actionTemplateDataStoreService->setData($actionType, $data));
            $this->assertTrue($this->actionTemplateDataStoreService->isDataStored($actionType));
            $this->assertEquals($data, $this->actionTemplateDataStoreService->getData($actionType));
        }
        $this->expectException(AllreadySetException::class);
        $this->assertNull($this->actionTemplateDataStoreService->setData($actionType, $data));
    }
}
