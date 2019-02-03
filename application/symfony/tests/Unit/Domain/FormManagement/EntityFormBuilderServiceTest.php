<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\FormManagement\FormClassNameServiceInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Entity\Source\PureSource;
use App\Domain\FormManagement\RequestedEntityFormBuilderService;

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
        $formClassNameService->method('getClass')->willReturn('dummyNamespace');
        $entityFormBuilderService = new RequestedEntityFormBuilderService($formBuilder, $formClassNameService);
        $entity = new PureSource();
        $entityRequested = $this->createMock(RequestedEntityInterface::class);
        $entityRequested->method('hasIdentity')->willReturn(true);
        $entityRequested->method('getEntity')->willReturn($entity);
        $result = $entityFormBuilderService->create($entityRequested);
        $this->assertEquals($expectedResult, $result);
    }
}
