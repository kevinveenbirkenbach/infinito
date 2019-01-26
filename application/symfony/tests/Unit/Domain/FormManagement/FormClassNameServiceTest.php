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
        $entity = new PureSource();
        $formNameService = new FormClassNameService();
        $entityForm = $formNameService->getName($entity);
        $this->assertEquals('App\\Form\\Source\\PureSourceType', $entityForm);
    }
}
