<?php

namespace tests\Unit\Domain\Form;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Domain\Form\RequestedActionFormBuilder;
use Infinito\Domain\Form\FormClassNameServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Infinito\Exception\Attribut\UndefinedAttributException;

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
        $this->expectException(UndefinedAttributException::class);
        $requestedActionFormBuilder->create($requestedAction);
    }
}
