<?php

namespace tests\Unit\Domain\Form;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Form\FormClassNameService;
use Infinito\Entity\Source\PureSource;
use PHPUnit\Framework\TestCase;

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
        $this->assertEquals('Infinito\\Form\\Entity\\Source\\PureSourceType', $entityForm);
    }

    public function testWithType(): void
    {
        $entityClass = PureSource::class;
        $formNameService = new FormClassNameService();
        $entityForm = $formNameService->getClass($entityClass, ActionType::CREATE);
        $this->assertEquals('Infinito\\Form\\Entity\\Source\\PureSourceCreateType', $entityForm);
    }
}
