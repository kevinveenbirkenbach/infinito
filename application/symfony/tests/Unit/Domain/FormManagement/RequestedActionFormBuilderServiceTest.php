<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\FormManagement\FormClassNameServiceInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Entity\Source\PureSource;
use App\Domain\FormManagement\RequestedActionFormBuilderService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilderServiceTest extends TestCase
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
        $entity = new PureSource();
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('hasIdentity')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($entity);
        $requestedAction = $this->createMock(RequestedActionServiceInterface::class);
        $requestedAction->method('getRequestedEntity')->willReturn($requestedEntity);
        $entityFormBuilderService = new RequestedActionFormBuilderService($formBuilder, $formClassNameService, $requestedAction);
        $result = $entityFormBuilderService->create($requestedAction);
        $this->assertEquals($expectedResult, $result);
        $this->assertEquals($entityFormBuilderService->create($requestedAction), $entityFormBuilderService->createByService());
    }
}
