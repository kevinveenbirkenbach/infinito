<?php

namespace tests\Unit\Domain\Form;

use Infinito\Domain\Form\FormClassNameServiceInterface;
use Infinito\Domain\Form\RequestedActionFormBuilder;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Exception\Attribut\UndefinedAttributException;
use PHPUnit\Framework\TestCase;
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
        $this->expectException(UndefinedAttributException::class);
        $requestedActionFormBuilder->create($requestedAction);
    }
}
