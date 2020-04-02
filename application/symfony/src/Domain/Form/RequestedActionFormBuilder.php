<?php

namespace Infinito\Domain\Form;

use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Exception\Attribut\UndefinedAttributException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilder implements RequestedActionFormBuilderInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormClassNameServiceInterface
     */
    private $formClassNameService;

    /**
     * @throws UndefinedAttributException If the requested action can't be processed
     */
    private function validateRequestedAction(RequestedActionInterface $requestedAction): void
    {
        if (!$requestedAction->hasRequestedEntity()) {
            throw new UndefinedAttributException('The <<requested entity>> attribut of a <<requested action>> must be set, to be processed by '.__CLASS__.'!');
        }
    }

    public function __construct(FormFactoryInterface $formFactory, FormClassNameServiceInterface $formClassNameService)
    {
        $this->formFactory = $formFactory;
        $this->formClassNameService = $formClassNameService;
    }

    public function create(RequestedActionInterface $requestedAction): FormBuilderInterface
    {
        $this->validateRequestedAction($requestedAction);
        $requestedEntity = $requestedAction->getRequestedEntity();
        $actionType = $requestedAction->getActionType();
        $origineClass = $requestedEntity->getClass();
        $class = $this->formClassNameService->getClass($origineClass, $actionType);
        $entity = ($requestedEntity->hasIdentity()) ? $requestedEntity->getEntity() : null;
        $formBuilder = $this->formFactory->createBuilder($class, $entity);

        return $formBuilder;
    }
}
