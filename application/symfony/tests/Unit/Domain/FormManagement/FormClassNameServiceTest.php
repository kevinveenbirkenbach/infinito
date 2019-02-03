<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\FormManagement\FormClassNameService;
use App\Entity\Source\PureSource;
use App\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class FormClassNameServiceTest extends TestCase
{
    public function testGetName(): void
    {
        $entityClass = PureSource::class;
        $formNameService = new FormClassNameService();
        $entityForm = $formNameService->getClass($entityClass);
        $this->assertEquals('App\\Form\\Source\\PureSourceType', $entityForm);
    }

    public function testWithType(): void
    {
        $entityClass = PureSource::class;
        $formNameService = new FormClassNameService();
        $entityForm = $formNameService->getClass($entityClass, ActionType::CREATE);
        $this->assertEquals('App\\Form\\Source\\PureSourceCreateType', $entityForm);
    }
}
