<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\FormManagement\FormClassNameService;
use App\Entity\Source\PureSource;

/**
 * @author kevinfrantz
 */
class FormClassNameServiceTest extends TestCase
{
    public function testGetName()
    {
        $entityClass = PureSource::class;
        $formNameService = new FormClassNameService();
        $entityForm = $formNameService->getClass($entityClass);
        $this->assertEquals('App\\Form\\Source\\PureSourceType', $entityForm);
    }
}
