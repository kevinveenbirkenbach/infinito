<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\FormManagement\EntityFormBuilderService;
use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\FormManagement\FormClassNameServiceInterface;
use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
class EntityFormBuilderServiceTest extends TestCase
{
    /**
     * Could be that this test includes a bit to much mocking -.-.
     */
    public function testCreate(): void
    {
        $expectedResult = $this->createMock(FormBuilderInterface::class);
        $formBuilder = $this->createMock(FormBuilderInterface::class);
        $formBuilder->method('create')->willReturn($expectedResult);
        $formClassNameService = $this->createMock(FormClassNameServiceInterface::class);
        $formClassNameService->method('getName')->willReturn('dummyNamespace');
        $entityFormBuilderService = new EntityFormBuilderService($formBuilder, $formClassNameService);
        $entity = $this->createMock(EntityInterface::class);
        $result = $entityFormBuilderService->create($entity);
        $this->assertEquals($expectedResult, $result);
    }
}
