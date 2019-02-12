<?php

namespace tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Exception\NotSetException;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\FormManagement\RequestedActionFormBuilder;
use App\Domain\FormManagement\FormClassNameServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilderTest extends TestCase
{
    public function testRequestedActionNotValid(): void
    {
        $requestedAction = $this->createMock(RequestedActionInterface::class);
        $requestedAction->method('hasRequestedEntity')->willReturn(false);
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $formClassNameService = $this->createMock(FormClassNameServiceInterface::class);
        $requestedActionFormBuilder = new RequestedActionFormBuilder($formFactory, $formClassNameService);
        $this->expectException(NotSetException::class);
        $requestedActionFormBuilder->create($requestedAction);
    }
}
